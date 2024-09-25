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
    $query = $db->prepare("SELECT `rifs`.`make`, `rifs`.`model`, `rifs`.`type`, `colors`.`color` AS 'color', `rifs`.`mags_owned`, `rifs`.`power_source`, `rifs`.`sites_visited`, `rifs`.`purchase_date` FROM `rifs` JOIN `colors` ON `rifs`.`color` = `colors`.`id`;");
    $result = $query->execute();
    return $query->fetchAll();
}

?>
