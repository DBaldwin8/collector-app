<?php
// TASK 2
//  1) Retrieve table to for each loop just to echo first
//  2) store outcome into variable?

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

        <?php
        echo '<pre>';
            var_dump($table);
        echo '</pre>'
        ?>

    </body>
</html>