<?php

$db = new PDO (
    'mysql:host=DB;dbname=collector_app',
    'root',
    'password'
);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

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
