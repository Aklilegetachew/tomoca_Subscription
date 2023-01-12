<?php
require '../vendor/autoload.php';


$options = array(
    'cluster' => 'us2',
    'useTLS' => true
);
$pusher = new Pusher\Pusher(
    'e5fe60b6bb6d56b8b93e',
    '7c3c66b3fafa7887ded8',
    '1385315',
    $options
);


// pusher
$data['message'] = 'New delivery order arrived';
$data['shop'] = "Historical";
$data['name'] = "Aklile";
$data['Orderdate'] = date("M Y,d");
$pusher->trigger('my-channel', 'my-eventC', $data);
