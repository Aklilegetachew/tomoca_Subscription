<?php
//   curl -i -H "Accept: application/json" -H "Content-Type: application/json" 'http://hostname/resource';
header('Content-Type:application/json; charset=utf-8');
$received = json_decode(file_get_contents('php://input'));
file_put_contents("result10.txt", $received . PHP_EOL . PHP_EOL, FILE_APPEND);
file_put_contents("result10.json", "hello niga" . PHP_EOL . PHP_EOL, FILE_APPEND);
// echo $received;
print_r($received);
echo "you are here boi";
