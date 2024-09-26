<?php

function returnDb()
{
    $db = new PDO (
        'mysql:host=DB;dbname=collector_app',
        'root',
        'password'
    );
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
}

function populateTable (array $table) {
    $row = '';
    foreach ($table as $value) {
        $row .= "<tr>".
        "<td class='entry make-entry'>{$value['make']}</td>".
        "<td class='entry model-entry'>{$value['model']}</td>".
        "<td class='entry type-entry'>{$value['type']}</td>".
        "<td class='entry color-entry'>{$value['color']}</td>".
        "<td class='entry mags-entry'>{$value['mags_owned']}</td>".
        "<td class='entry power-entry'>{$value['power_source']}</td>".
        "<td class='entry sites-entry'>{$value['sites_visited']}</td>".
        "<td class='entry purchase-entry'>{$value['purchase_date']}</td>".
        "</tr>";
    }
    return $row;
}

function retrieveAllQuery($db) {
    $query = $db->prepare("SELECT `rifs`.`make`, `rifs`.`model`, `rifs`.`type`, `colors`.`color`, `rifs`.`mags_owned`, `rifs`.`power_source`, `rifs`.`sites_visited`, `rifs`.`purchase_date` FROM `rifs` JOIN `colors` ON `rifs`.`color` = `colors`.`id`;");
    $result = $query->execute();
    return $query->fetchAll();
}

function addToDatabase(array &$entryToAdd, object $db) {

    $message = '' ;

    $dateRegex = '~^\d{4}-\d{2}-\d{2}$~';

    //or could use trow new exception below?

    if (!is_string($entryToAdd['make'])){
        return $message = "Error with your 'Make' input";
    } if (!is_string($entryToAdd['model'])){
        return $message = "Error with your 'Model' input";
    } if (!is_string($entryToAdd['type'])){
        return $message = "Error with your 'Type' input";
    }  if (!is_string($entryToAdd['color'])){
        return $message = "Error with your 'Color' input";
    } if (!filter_var($entryToAdd['mags'], FILTER_VALIDATE_INT)){
        return $message = "Error with your 'Mags' input";
    } if (!is_string($entryToAdd['power'])){
        return $message = "Error with your 'Power' input";
    } if (!filter_var($entryToAdd['sites'], FILTER_VALIDATE_INT)){
        return $message = "Error with your 'Sites Visited' input";
    } if (!preg_match($dateRegex, $entryToAdd['purchased'])){
        // could add validation to date before today's date by converting to unix?
        return $message = "Error with your 'Purchased Date' input";
    } else {

        //////////// Set color id entry

        $color = filter_var($entryToAdd['color'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $color = strtolower($color);

        if ($color === 'white') {
            $color = 3;
        } elseif ($entryToAdd['color'] === 'black') {
            $color = 2;
        } elseif ($entryToAdd['color'] === 'tan') {
            $color = 1;
        } else{
            return $message = "This option has not been added to the database.";
        }

        /////////// SANITIZATION

        $make = filter_var($entryToAdd['make'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $model = filter_var($entryToAdd['model'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $type = filter_var($entryToAdd['type'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mags = filter_var($entryToAdd['mags'], FILTER_SANITIZE_NUMBER_INT);
        $power = filter_var($entryToAdd['power'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sites = filter_var($entryToAdd['sites'], FILTER_SANITIZE_NUMBER_INT);
        $purchased = filter_var($entryToAdd['purchased'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $addQuery = $db->prepare("INSERT INTO `rifs` (`make`, `model`, `type`, `color`, `mags_owned`, `power_source`, `sites_visited`, `purchase_date`) VALUES (:make, :model, :type, :color, :mags, :power, :sites, :purchased) ");
        $result = $addQuery->execute([
            'make' => $make,
            'model' => $model,
            'type' => $type,
            'color' => $color,
            'mags' => $mags,
            'power' => $power,
            'sites' => $sites,
            'purchased' => $purchased,
        ]);

        return $message = 'Entry Added successfully';
    }

}

?>
