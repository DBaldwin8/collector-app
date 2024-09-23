<?php
// TASK 2
//  1) Retrieve table to for each loop just to echo first

require_once 'paint-collector-app.php';


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
        ?>
    </table>
    </body>
</html>