<?php

require_once 'rif-collector-app.php';
$db = returnDb();

addToDatabase($_POST, $db);

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
                    <tr>
                        <th class="entry" colspan="8">Add Entry</th>
                    </tr>
                    <form action="index.php" method="POST">
                        <tr>
                            <th class="entry">
                                <label for="make">Make:</label>
                            </th>
                            <th class="entry">
                                <label for="model">Model:</label>
                            </th>
                            <th class="entry">
                                <label for="type">Type:</label>
                            </th>
                            <th class="entry">
                                <label for="color">Color:</label>
                            </th>
                            <th class="entry">
                                <label for="mags">Mags:</label>
                            </th>
                            <th class="entry">
                                <label for="power">Power:</label>
                            </th>
                            <th class="entry">
                                <label for="sites">Sites Visited:</label>
                            </th>
                            <th class="entry">
                                <label for="purchased">Purchased Date:</label>
                            </th>
                        </tr>
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
                                <input class="shrink" type="number" name="mags" id="mags">
                            </td>
                            <td class="input">
                                <input class="shrink" type="text" name="power" id="power">
                            </td>
                            <td class="input">
                                <input class="shrink" type="number" name="sites" id="sites">
                            </td>
                            <td class="input">
                                <input class="shrink" type="date" name="purchased" id="purchased">
                            </td>
                        </tr>
                        <tr class="">
                            <td colspan="8">
                                <input class="shrink submit" type="submit" value="Add To Table">
                            </td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    <?php
    var_dump($_POST);
    ?>
    </body>
</html>