<?php

require_once 'paint-collector-app.php';
$db = returnDb();

function retrieveAllQuery($db) {
    $query = $db->prepare('SELECT `brand`, `name`, `color`, `base`, `quantity_left`, `purchase_date` FROM `paints`');
    $result = $query->execute();
    return $query->fetchAll();
}

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
        <div class="container">
            <h1>Paint Leftover</h1>
            <table class="table">
                <tr>
                    <th class="heading">Brand</th>
                    <th class="heading">Name</th>
                    <th class="heading">Color</th>
                    <th class="heading">Base</th>
                    <th class="heading">Quantity Remaining (L)</th>
                    <th class="heading">Purchase Date</th>
                </tr>
                <?php
                    echo populateTable(retrieveAllQuery($db));
                ?>
            </table>
        </div>
    </body>
</html>