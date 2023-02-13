<?php


use JetBrains\PhpStorm\ArrayShape;


include 'mainFunctions.php';
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


if ($user_id !== 5102867263) {
  if (strcmp($text, '/start') !== 0 && $stepMem == null || $step == null || $step == "Payed") {
    FirstBack:
    $selectedItem = null;
    $selectedItem = substr($text, 7);
    if ($selectedItem == null) {
      $markup  = array('inline_keyboard' => array(array(array('text' => 'Back to Channel',  'url' => 'https://t.me/TomTomChan'))));
      $markupjs = json_encode($markup);
      message($chat_id, "please select Subscription from the channel", $markupjs);
    } else {

      $ID = intval($selectedItem);
      $selection = GetSelection($ID);

      if ($selection['package_Type'] == 'MEB') {
        adduser($first_name, $Last_name, $user_id, $ID, $message_id, $selection, "MEB");
      } else if ($selection['package_Type'] == 'SUB') {

        adduser($first_name, $Last_name, $user_id, $ID, $message_id, $selection, "SUB");
        setStep($user_id, "SubscriptionStart");
        DetailText($chat_id);
        showSubscriptionDetail($UID, $chat_id, $message_id,  $selection);
      } else if ($selection['package_Type'] == 'PROD') {

        if ($selectedItem == '61' || $selectedItem == '63' || $selectedItem == '64' || $selectedItem == '65' || $selectedItem == '66' || $selectedItem == '67' || $selectedItem == '53' || $selectedItem == '54' || $selectedItem == '55' || $selectedItem == '56' || $selectedItem == '57' || $selectedItem == '58' || $selectedItem == '60' || $selectedItem == '101' || $selectedItem == '102' || $selectedItem == '103' || $selectedItem == '104' || $selectedItem == '105') {
          $markup  = array('inline_keyboard' => array(array(array('text' => 'Back to Channel',  'url' => 'https://t.me/TomTomChan'))));
          $markupjs = json_encode($markup);
          message($chat_id, "250 grams is temporarily sold out. 350 and 500 grams coffee goods are available for purchase. Thank you for taking the time to read this.", $markupjs);
        } else {

          $ID = intval($selectedItem);
          $selection = GetSelection($ID);
          $IntPrice = intval($selected_price);
          adduserPurchase($first_name, $Last_name, $user_id, $ID, $message_id, 'PROD');
          $userIdDb = getUserID($user_id);
          setProductId($userIdDb, $ID);
          $cartStart = getCartIDstart($userIdDb);
          $cartend = getCartIDend($userIdDb);
          setCartStart($userIdDb, $cartStart);
          setCartend($userIdDb, $cartend);
          setStep($user_id, "Keypad");
          $res = setQuantity("0");
        }
      }

      // showdetail($UID, $chat_id, $user_id, $message_id);
      // $res = setQuantity("0");
    }
  }
}
