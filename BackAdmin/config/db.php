<?php


//include ($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .basename(dirname(dirname(dirname(__FILE__)))) . "/admin_config.php");

// $db_username = $_ENV['DB_USERNAME'];
// $db_pwd = $_ENV['DB_PASSWORD'];
// $db_name = $_ENV['DB_NAME'];
// $connection = mysqli_connect('localhost', 'versavvymediacom_tomocaUser', '+o,I+4RGg1IS', 'versavvymediacom_tomocaBot');
// $connection = mysqli_connect('localhost', 'versavvymediacom_demoBot', "N)3Uj(;c!Q@v", 'versavvymediacom_demoBot');
// $connection = mysqli_connect('localhost', 'versavvymediacom_sample_bot', $_ENV['DATABASE_PASSWORD'], 'versavvymediacom_sampleBot');


// if (!$connection) {
//     echo "Error: Unable to connect to MySQL." . PHP_EOL;
//     echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
//     echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
//     exit;
// }

require('../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$servername = $_ENV["SERV_DB_HOST"];
$username = $_ENV["SERV_DB_USERNAME"];
$password = $_ENV["SERV_DB_PASSWORD"];
$dbname = $_ENV["SERV_DB_NAME"];

$connection = mysqli_connect($servername, $username, $password, $dbname);
// $connection = mysqli_connect('localhost', 'root', '', 'tomocainfo');

if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
