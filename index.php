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
                </table>
            </div>
        </div>
            <div class="add-form">
                <form class="form-container" action="index.php" method="GET">
                    <div class="input-container">
                        <label for="make">Make: </label>
                        <input type="text" name="make" id="make">
                    </div>
                    <div class="input-container">
                        <label for="make">Model: </label>
                        <input type="text" name="model" id="model">
                    </div>
                    <div class="input-container">
                        <label for="type">Type: </label>
                        <input type="text" name="type" id="type">
                    </div>
                    <div class="input-container">
                        <label for="colour">Colour: </label>
                        <input type="text" name="colour" id="colour">
                    </div>
                    <div class="input-container">
                        <label for="mags">Mags: </label>
                        <input type="text" name="mags" id="mags">
                    </div>
                    <div class="input-container">
                        <label for="power">Power: </label>
                        <input type="text" name="power" id="power">
                    </div>
                    <div class="input-container">
                        <label for="sites">Sites visited: </label>
                        <input type="text" name="sites" id="sites">
                    </div>
                    <div class="input-container">
                        <label for="purchased">Purchased date: </label>
                        <input type="text" name="purchased" id="purchased">
                    </div>


                </form>
            </div>
    </body>
</html>