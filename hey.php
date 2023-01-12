<?php
require __DIR__ . '/vendor/autoload.php';

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

$data['message'] = 'hello world';
$pusher->trigger('my-channel', 'my-eventConfirm', $data);
