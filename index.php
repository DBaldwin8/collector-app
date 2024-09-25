<?php

require_once 'rif-collector-app.php';
$db = returnDb();

function retrieveAllQuery($db) {
    $query = $db->prepare("SELECT `rifs`.`make`, `rifs`.`model`, `rifs`.`type`, `colors`.`color` AS 'color', `rifs`.`power_source`, `rifs`.`site_visited`, `rifs`.`purchased_date` FROM `rifs` JOIN `colors` ON `rifs`.`color` = `colors`.`id`;");
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
                    <th class="heading">Make</th>
                    <th class="heading">Model</th>
                    <th class="heading">Type</th>
                    <th class="heading">Color</th>
                    <th class="heading">Power</th>
                    <th class="heading"># Sites visited</th>
                    <th class="heading">Purchase Date</th>
                </tr>
                <?php
                    echo populateTable(retrieveAllQuery($db));
                ?>
            </table>
        </div>
    </body>
</html>