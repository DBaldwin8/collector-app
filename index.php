<?php
// TASK 2
//  1) Retrieve table to for each loop just to echo first

require_once 'paint-collector-app.php';
$db = returnDb();

$query = $db->prepare ('SELECT `brand`, `name`, `color`, `base`, `quantity_left`, `purchase_date` FROM `paints`');
$result = $query->execute();
$table = $query->fetchAll();

?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Leftover paint - collector app</title>
        <link rel="stylesheet" href="modern-normalize.css">
        <link rel="stylesheet" href="styles.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
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
                echo populateTable($table);
            ?>
        </table>
    </body>
</html>