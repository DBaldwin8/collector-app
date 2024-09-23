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
    echo 'You broke it';
} else {
    $table = $query->fetchAll();
    /*
    echo '<pre>';
    var_dump($table);
    echo '</pre>';
    */
}
?>
<table>
    <tr>
        <th>Brand</th>
        <th>Name</th>
        <th>Color</th>
        <th>Base</th>
        <th>Quantity Remaining</th>
        <th>Purchase Date</th>
    </tr>
<?php
foreach ($table as $key => $value) {
    echo '<tr>';
    echo "<td>{$value['brand']}<td>";
    echo "<td>{$value['name']}<td>";
    echo "<td>{$value['color']}<td>";
    echo "<td>{$value['base']}<td>";
    echo "<td>{$value['quantity_left']}<td>";
    echo "<td>{$value['purchase_date']}<td>";
    echo '</tr>';
}
?>
</table>
