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
        "<td>{$value['brand']}</td>".
        "<td>{$value['name']}</td>".
        "<td>{$value['color']}</td>".
        "<td>{$value['base']}</td>".
        "<td>{$value['quantity_left']}</td>".
        "<td>{$value['purchase_date']}</td>".
        "</tr>";
    }
    return $row;
}
?>
