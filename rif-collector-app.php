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

$message = "";

function addToDatabase(array $entryToAdd, object $db, string &$message) {

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
            return $message = "Color option not available in database.";
        }

        /////////// SANITIZATION
        /// Opted for strip_tags to removed tags as opposed to htmlspecialchars to convert tags,
        /// then added another if block so that empty strings don't get stored.

        $make = strip_tags($entryToAdd['make']);
        $model = strip_tags($entryToAdd['model']);
        $type = strip_tags($entryToAdd['type']);
        $mags = filter_var($entryToAdd['mags'], FILTER_SANITIZE_NUMBER_INT);
        $power = strip_tags($entryToAdd['power']);
        $sites = filter_var($entryToAdd['sites'], FILTER_SANITIZE_NUMBER_INT);
        $purchased = ($entryToAdd['purchased']); // Val and San handled by regex in first block.

        if ($make === "") {
            return $message = "Error with your 'Make' input";
        } if ($model === "") {
            return $message = "Error with your 'Model' input";
        } if ($type === "") {
            return $message = "Error with your 'Type' input";
        } if ($power === "") {
            return $message = "Error with your 'Power' input";
        } else {

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
        return $message;
    }
    return $message;
}

?>
