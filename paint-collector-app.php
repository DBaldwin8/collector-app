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
        $quan = ($value['quantity_left']/1000);
        $row .= "<tr>".
        "<td class='entry'>{$value['brand']}</td>".
        "<td class='entry'>{$value['name']}</td>".
        "<td class='entry'>{$value['color']}</td>".
        "<td class='entry'>{$value['base']}</td>".
        "<td class='entry'>$quan</td>".
        "<td class='entry'>{$value['purchase_date']}</td>".
        "</tr>";
    }
    return $row;
}
?>
