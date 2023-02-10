<?php


use JetBrains\PhpStorm\ArrayShape;


include 'functions.php';
include 'Admin.php';
include 'paymproc.php';
$input = file_get_contents('php://input');
$update = json_decode($input, true);

// ======================= update data ==============================
if (array_key_exists('message', $update)) {
  $username = $update['message']['from']['username'];
  $user_id = $update['message']['from']['id'];
  $chat_id = $update['message']['chat']['id'];
  $message_id = $update['message']['message_id'];
  $first_name = $update['message']['from']['first_name'];
  $Last_name = $update['message']['from']['last_name'];
  $text = $update['message']['text'];
  $photo = $update['message']['photo'][2]['file_id'];
  $audio = $update['message']['audio']['file_id'];
  $voice = $update['message']['voice']['file_id'];
  $video = $update['message']['video']['file_id'];
  $caption = $update['message']['caption'];
  $voice = $update['message']['voice']['file_id'];
  $latitude = $update['message']['location']['latitude'];
  $longtiude = $update['message']['location']['longitude'];
  $Contact = $update['message']['contact']['phone_number'];
} elseif (array_key_exists('callback_query', $update)) {
  $callback = $update['callback_query']['id'];
  $username = $update['callback_query']['from']['username'];
  $user_id = $update['callback_query']['from']['id'];
  $chat_id = $update['callback_query']['message']['chat']['id'];
  $message_id = $update['callback_query']['message']['message_id'];
  $first_name = $update['callback_query']['from']['first_name'];
  $Last_name = $update['callback_query']['from']['last_name'];
  $text = $update['callback_query']['data'];
  $callBackdata = null;
  $callBackdata = $text;
  $keyPad = $text;
}

$step = getStep($user_id);
$stepMem = getStepMem($user_id);
$adminstep = getAdminStep($user_id);


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





