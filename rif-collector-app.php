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
        "<td class='entry'>{$value['make']}</td>".
        "<td class='entry'>{$value['model']}</td>".
        "<td class='entry'>{$value['type']}</td>".
        "<td class='entry'>{$value['color']}</td>".
        "<td class='entry'>{$value['power_source']}</td>".
        "<td class='entry'>{$value['sites_visited']}</td>".
        "<td class='entry'>{$value['purchase_date']}</td>".
        "</tr>";
    }
    return $row;
}
?>
