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

$query = $db->prepare ('SELECT `brand`, `name`, `color`, `base`, `quantity_left`, `purchase_date` FROM `paints`');

$result = $query->execute();

if (!$result) {
    echo 'error with result';
} else {
    $table = $query->fetchAll();
    /*
    echo '<pre>';
    var_dump($table);
    echo '</pre>';
    */
}
?>
<?php
function populateTable (array $table) {
    foreach ($table as $key => $value) {
        echo '<tr>';
        echo "<td>{$value['brand']}</td>";
        echo "<td>{$value['name']}</td>";
        echo "<td>{$value['color']}</td>";
        echo "<td>{$value['base']}</td>";
        echo "<td>{$value['quantity_left']}</td>";
        echo "<td>{$value['purchase_date']}</td>";
        echo '</tr>';
    }
}
?>
