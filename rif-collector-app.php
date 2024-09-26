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

    //or could use trow new exception?

    $dateRegex =

    if(!isset($entryToAdd['make']) && !is_string($entryToAdd['make'])){
        return $message = "Error with your 'Make' input";
    } if (!isset($entryToAdd['model']) && !is_string($entryToAdd['model'])){
        return $message = "Error with your 'Model' input";
    } if (!isset($entryToAdd['type']) && !is_string($entryToAdd['type'])){
        return $message = "Error with your 'Model' input";
    }  if (isset($entryToAdd['color']) && !is_string($entryToAdd['color'])){
        return $message = "Error with your 'Color' input";
    } if (isset($entryToAdd['mags']) && !filter_var($entryToAdd['mags'], FILTER_VALIDATE_INT)){
        return $message = "Error with your 'Mags' input";
    } if (isset($entryToAdd['power']) && !is_string($entryToAdd['power'])){
        return $message = "Error with your 'Power' input";
    } if (isset($entryToAdd['sites'])  && !filter_var($entryToAdd['sites'], FILTER_VALIDATE_INT)){
        return $message = "Error with your 'Sites Visited' input";
    } if (isset($entryToAdd['purchased']) && !preg_match($dateRegex, $entryToAdd['purchased'])){
        return $message = "Error with your 'Purchased Date' input";
    } else {

        strtolower($entryToAdd['color']);

        if ($entryToAdd['color'] === 'white') {
            $entryToAdd['color'] = 3;
        } elseif ($entryToAdd['color'] === 'black') {
            $entryToAdd['color'] = 2;
        } elseif ($entryToAdd['color'] === 'tan') {
            $entryToAdd['color'] = 1;
        }

        $addQuery = $db->prepare("INSERT INTO `rifs` (`make`, `model`, `type`, `color`, `mags_owned`, `power_source`, `sites_visited`, `purchased_date`) VALUES ({$entryToAdd['make']}, {$entryToAdd['model']}, {$entryToAdd['type']}, {$entryToAdd['color']}. {$entryToAdd['mags']}, {$entryToAdd['power']}, {$entryToAdd['sites']}, {$entryToAdd['purchased']}) ");

    }
}

?>
