<?php
require('vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//////////////////////////CONNECT TO DATABASE ////////////////////
$db = mysqli_connect('localhost', $_ENV['DATABASELOCALHOST'], '', 'tomocainfo');

// $db = mysqli_connect('localhost', 'versavvymediacom_sample_bot', $_ENV['DATABASE_PASSWORD'], 'versavvymediacom_sampleBot');

if (!$db) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
