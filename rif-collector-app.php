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

function populateTable(array $table) {
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

    // Need to be moved to be within their functions, and not passed by reference.
$message = "";
$validatedSanitizedArr = [];

function validateSanitizeEntry(array $entryToAdd, &$validatedSanitizedArr, &$message) {

    $dateRegex = '~^\d{4}-\d{2}-\d{2}$~';

    $make = htmlspecialchars($entryToAdd['make']);
    if (!$make) { // if make == ''
        return $message = "Error with your 'Make' input";
    }

    $model = htmlspecialchars($entryToAdd['model']);
    if (!$model) {
        return $message = "Error with your 'Model' input";
    }

    $type = htmlspecialchars($entryToAdd['type']);
    if ($type) {
        return $message = "Error with your 'Type' input";
    }
        // Need to strip white space or make it a dropdown in HTML.
    $color = htmlspecialchars($entryToAdd['color']);
    $color = strtolower($color);
    if ($color === 'white') {
        $color = 3;
    } elseif ($entryToAdd['color'] === 'black') {
        $color = 2;
    } elseif ($entryToAdd['color'] === 'tan') {
        $color = 1;
    } else {
        return $message = "only Black, White or Tan is an option";
    }

    $mags = htmlspecialchars($entryToAdd['mags']);
    if (!$mags) {
        return $message = "Error with your 'Mags' input";
    }

    $power = htmlspecialchars($entryToAdd['power']);
    if (!$power) {
        return $message = "Error with your 'Power' input";
    }

    if (!filter_var($entryToAdd['sites'], FILTER_VALIDATE_INT)) {
        return $message = "Error with your 'Sites Visited' input";
    }
    if (!preg_match($dateRegex, $entryToAdd['purchased'])) {
        return $message = "Error with your 'Purchased Date' input";
    } else {

        // Last 2 not updated, need work.
    return $validatedSanitizedArr = [
        'make' => $make,
        'model' => $model,
        'type' => $type,
        'color' => $color,
        'mags' => $mags,
        'power' => $power,
        'sites' => filter_var($entryToAdd['sites'], FILTER_SANITIZE_NUMBER_INT),
        'purchased' => ($entryToAdd['purchased']),
        ];
    }
}

function addToDatabase(array $valSanArr, object $db, string &$message) {

    $addQuery = $db->prepare("INSERT INTO `rifs` (`make`, `model`, `type`, `color`, `mags_owned`, `power_source`, `sites_visited`, `purchase_date`) VALUES (:make, :model, :type, :color, :mags, :power, :sites, :purchased) ");
    $result = $addQuery->execute([
        'make' => $valSanArr['make'],
        'model' => $valSanArr['model'],
        'type' => $valSanArr['type'],
        'color' => $valSanArr['color'],
        'mags' => $valSanArr['mags'],
        'power' => $valSanArr['power'],
        'sites' => $valSanArr['sites'],
        'purchased' => $valSanArr['purchased']
    ]);

    if (!$result) {
        return $message = "There has been an error in adding to database";
    } else {
        return $message = 'Entry Added successfully';
    }
}

?>