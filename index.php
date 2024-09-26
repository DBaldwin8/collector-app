<?php

require_once 'rif-collector-app.php';
$db = returnDb();

?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>My RIFs - collector app</title>
        <link rel="stylesheet" href="modern-normalize.css">
        <link rel="stylesheet" href="styles.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container">
            <h1>My RIFs</h1>
            <div class="scrollable">
                <table class="table">
                    <tr>
                        <th class="heading">Make</th>
                        <th class="heading">Model</th>
                        <th class="heading">Type</th>
                        <th class="heading">Color</th>
                        <th class="heading">Mags</th>
                        <th class="heading">Power</th>
                        <th class="heading">Sites visited</th>
                        <th class="heading">Purchase Date</th>
                    </tr>
                    <?php
                        echo populateTable(retrieveAllQuery($db));
                    ?>
                    <form action="index.php" method="POST">
                        <tr>
                            <td class="input">
                                <input class="shrink" type="text" name="make" id="make">
                            </td>
                            <td class="input">
                                <input class="shrink" type="text" name="model" id="model">
                            </td>
                            <td class="input">
                                <input class="shrink" type="text" name="type" id="type">
                            </td>
                            <td class="input">
                                <input class="shrink" type="text" name="color" id="color">
                            </td>
                            <td class="input">
                                <input class="shrink" type="text" name="mags" id="mags">
                            </td>
                            <td class="input">
                                <input class="shrink" type="text" name="power" id="power">
                            </td>
                            <td class="input">
                                <input class="shrink" type="text" name="sites" id="sites">
                            </td>
                            <td class="input">
                                <input class="shrink" type="text" name="purchased" id="purchased">
                            </td>
                        </tr>
                        <tr class="">
                            <td colspan="8">
                                <input class="shrink" type="submit" value="Add To Table">
                            </td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </body>
</html>