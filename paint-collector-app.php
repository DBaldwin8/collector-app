<?php

$db = new PDO (
    'mysql:host=DB;dbname=collector_app',
    'root',
    'password'
);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$query = $db->prepare ('SELECT * FROM `paints`');

$result = $query->execute();

if (!isset($result)) {
    echo 'You broke it';
} else {
    $table = $query->fetchAll();
}
