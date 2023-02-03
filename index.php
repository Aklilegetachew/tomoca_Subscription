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

// =============== Customer Response ======================

if (substr($text, 0, 3) == "YES" || substr($text, 0, 2) == "NO") {


  if (substr($text, 0, 3) == "YES") {

    date_default_timezone_set("Africa/Addis_Ababa");
    $timeOrder = date("h:i");
    $dateOrder = date("Y-m-d");


    $data['message'] = 'User confirmation';
    $data['Orderdate'] = $dateOrder;
    $data['OrderTime'] = $timeOrder;
    $data['OrderNumber'] = $text;
    $pusher->trigger('my-channel', 'my-eventConfirm', $data);
    message($chat_id, "Thank you for your confirmation");

    // editMessage($chat_id, intval($message_id) - 1, "Thank you for your confirmation");
  } else if (substr($text, 0, 2) == "NO") {

    date_default_timezone_set("Africa/Addis_Ababa");
    $timeOrder = date("h:i");
    $dateOrder = date("Y-m-d");

    $data['message'] = 'User confirmation';
    $data['Orderdate'] = $dateOrder;
    $data['OrderTime'] = $timeOrder;
    $data['OrderNumber'] = $text;
    $pusher->trigger('my-channel', 'my-eventConfirm', $data);

    message($chat_id, "Thank you for your response our staff will contact you soon");
    // editMessage($chat_id, $message_id, "Thank you for your response our staff will contact you soon");
  }

  exit;
}



// $selectedItem == '53' || $selectedItem == '54' || $selectedItem == '55' || $selectedItem == '61' || $selectedItem == '63' || $selectedItem == '64'

// ======================= function start ==================================

if (strcmp($text, '/start') == 0 && $user_id == '5102867263') {

  addAdmin($user_id);
  setAdminStep($user_id, "home");
  $markup  = array('keyboard' => array(array('Admin')), 'resize_keyboard' => true, 'one_time_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  $ret = message($chat_id, "Welcome to Tomoca bot", $markupjs);
}

date_default_timezone_set("Africa/Addis_Ababa");
$timestart = date('h:i a');
$sunrise = "7:00 am";
$sunset = "6:00 pm";

$date1 = DateTime::createFromFormat('h:i a', $timestart);
$date2 = DateTime::createFromFormat('h:i a', $sunrise);
$date3 = DateTime::createFromFormat('h:i a', $sunset);


if ($user_id !== 5102867263) {
  if (strcmp($text, '/start') !== 0 && $step == null || $step == "Payed") {
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
        $respo =  addMember($first_name, $Last_name, $user_id, $ID, $message_id, $selection);
        if ($respo) {
          setStepMem($user_id, "MembershipStart");
          DetailTextMem($chat_id);
          showMembershipDetail($UID, $chat_id, $message_id,  $selection);
        } else {
          $markup  = array('inline_keyboard' => array(array(array('text' => 'Back to Channel',  'url' => 'https://t.me/TomTomChan'))));
          $markupjs = json_encode($markup);
          message($chat_id, "You are currently a Member. ", $markupjs);
        }
      } else {

        adduser($first_name, $Last_name, $user_id, $ID, $message_id, $selection);
        setStep($user_id, "SubscriptionStart");
        DetailText($chat_id);
        showSubscriptionDetail($UID, $chat_id, $message_id,  $selection);
      }

      // showdetail($UID, $chat_id, $user_id, $message_id);
      // $res = setQuantity("0");
    }
  }
}

// ===================== detail response  =========================

if ($user_id !== 5102867263 && $stepMem == "MembershipStart") {
  if ($text == "Next") {
    sharePhone($chat_id);
    setStepMem($user_id, "MemberFinal");
  } elseif ($text == "Go Back") {
    BackNotif($update);
    // goto QUAN;
  } elseif ($text == "Cancel") {

    $userIdDb = getUserIDMem($user_id);
    $UserInfo = getUserInputMem($userIdDb);
    CancelNotifyerUser($chat_id);
    DeletRequestMem($userIdDb);
  } elseif ($text !== "Cancel" && $text !== "Go Back" && $text !== "Next" && $text !== "submit") {
    $markup  = array('keyboard' => array(array('Next'), array('Go Back', 'Cancel')), 'resize_keyboard' => true, 'selective' => true, 'one_time_keyboard' => true);
    $markupjs = json_encode($markup);
    $msg = urlencode("please choose only from the options provided. or cancel the previous order to empty your cart\nካሉት አማራጮች ብቻ ይምረጡ");

    message($chat_id, $msg, $markupjs);
  }
}

// =============================== Membership settingphone number ================================

if ($Contact && $stepMem == "MemberFinal") {
  setphone($user_id, $Contact);
  
} elseif ($text == "Back" && $stepMem == "MemberFinal") {
  $userIdDb = getUserIDMem($user_id);
  BackNotif($update);
  setStepMem($user_id, "MembershipStart");
} elseif ($step == "MemberFinal" && !is_numeric($text) && $text !== "Cancel") {
  $markup  = array('keyboard' => array(array(array('text' => 'Cancel'), array('text' => 'Phone Number', 'request_contact' => true))), 'resize_keyboard' => true, 'one_time_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  message($chat_id, "Please insert Phone number! or cancel previous order", $markupjs);
} elseif (is_numeric($text) && $stepMem == "MemberFinal") {
  setphone($user_id, $text);
  goto recape;
} elseif ($text == "Cancel"  && $stepMem == "MemberFinal") {
  $userIdDb = getUserIDMem($user_id);
  $UserInfo = getUserInputMem($userIdDb);
  CancelNotifyerUser($chat_id);
  DeletRequestMem($userIdDb);
}






// ===================== detail response  =========================

if ($user_id !== 5102867263 && $step == "SubscriptionStart") {
  if ($text == "Next") {
    sharePhone($chat_id);
    // AddCart($chat_id, $user_id);
    setStep($user_id, "Order Type");
  } elseif ($text == "Go Back") {
    BackNotif($update);
    // goto QUAN;
  } elseif ($text == "Cancel") {

    $userIdDb = getUserID($user_id);
    $UserInfo = getUserInput($userIdDb);
    $startMsg = $UserInfo['StartID'];
    deleteMessage($chat_id, $message_id, $startMsg);
    CancelNotifyerUser($chat_id);
    $userIdDb = getUserID($user_id);
    DeletRequest($userIdDb);
  } elseif ($text !== "Cancel" && $text !== "Go Back" && $text !== "Next" && $text !== "submit") {
    $markup  = array('keyboard' => array(array('Next'), array('Go Back', 'Cancel')), 'resize_keyboard' => true, 'selective' => true, 'one_time_keyboard' => true);
    $markupjs = json_encode($markup);
    $msg = urlencode("please choose only from the options provided. or cancel the previous order to empty your cart\nካሉት አማራጮች ብቻ ይምረጡ");

    message($chat_id, $msg, $markupjs);
  }
}


//==================================== phone number set up===================//

if ($Contact || $text == "Going back!" && $step == "Order Type") {

  setphone($user_id, $Contact);
  recape:
  switch ($step) {
    case "Order Type": {
        orderType();
        setStep($user_id, "Location");  // provider
      }
      break;
  }
} elseif ($text == "Back" && $step == "Order Type") {
  $userIdDb = getUserID($user_id);
  BackNotif($update);
  setPhase($userIdDb, "true");
  AddCart($chat_id, $user_id);
  setStep($user_id, "AddOrder");
} elseif ($step == "Order Type" && !is_numeric($text) && $text !== "Cancel") {
  $markup  = array('keyboard' => array(array(array('text' => 'Cancel'), array('text' => 'Phone Number', 'request_contact' => true))), 'resize_keyboard' => true, 'one_time_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  message($chat_id, "Please insert Phone number! or cancel previous order", $markupjs);
} elseif (is_numeric($text) && $step == "Order Type") {
  setphone($user_id, $text);
  goto recape;
} elseif ($text == "Cancel"  && $step == "Order Type") {

  $userIdDb = getUserID($user_id);
  $UserInfo = getUserInput($userIdDb);
  $startMsg = $UserInfo['StartID'];
  deleteMessage($chat_id, $message_id, $startMsg);
  CancelNotifyerUser($chat_id);
  $userIdDb = getUserID($user_id);
  DeletRequest($userIdDb);
}


//========================= pickup or delivery =======================//

if ($text == "Pickup Order" && $step == "Location") {
  setOrder($user_id, $text);
  ChooseShop($chat_id);
  setStep($user_id, "Shop");
} elseif ($text == "Delivery Order" && $step == "Location") {
  setOrder($user_id, $text);
  KindOfOrder($chat_id);
  setStep($user_id, "Tin");
} elseif ($text !== "Delivery Order" && $step == "Location" && $text !== "Pickup Order" && $text !== "Back" && $text !== "Cancel Order") {
  message($chat_id, "Please choose from the options only", null);
} elseif ($text == "Cancel Order" && $step == "Location") {
  $userIdDb = getUserID($user_id);
  $UserInfo = getUserInput($userIdDb);
  $startMsg = $UserInfo['StartID'];
  deleteMessage($chat_id, $message_id, $startMsg);
  CancelNotifyerUser($update);
  $userIdDb = getUserID($user_id);
  DeletRequest($userIdDb);
} elseif ($text == "Back" && $step == "Location") {
  setStep($user_id, "Order Type");
  BackNotif($update);
  sharePhone($chat_id);
}



// ======================== Tin number or not ==========================

if ($text == "Personal Order" && $step == "Tin") {
  shareLocation();
  setStep($user_id, "Provider");
} elseif ($text == "Business Order" && $step == "Tin") {
  BusinessName($chat_id);
  setStep($user_id, "Tin1");
} elseif ($text !== "Personal Order" && $step == "Tin" && $text !== "Business Order" && $text !== "Back" && $text !== "Cancel Order") {
  message($chat_id, "Please choose from the options only", null);
} elseif ($text == "Cancel Order" && $step == "Tin") {
  $userIdDb = getUserID($user_id);
  $UserInfo = getUserInput($userIdDb);
  $startMsg = $UserInfo['StartID'];
  deleteMessage($chat_id, $message_id, $startMsg);
  CancelNotifyerUser($update);
  $userIdDb = getUserID($user_id);
  DeletRequest($userIdDb);
} elseif ($text == "Back" && $step == "Tin") {
  setStep($user_id, "Location");
  BackNotif($update);
  sharePhone($chat_id);
}



// ======================== Business Name ===========================

if ($text !== "Submit Name" && $step == "Tin1" && $text !== "Back" && $text !== "Cancel") {
  $userIdDb = getUserID($user_id);
  setBusinessName($text, $userIdDb);
  BusinessTin($chat_id);
  setStep($user_id, "Tin2");
} elseif ($text == "Cancel" && $step == "Tin1") {
  $userIdDb = getUserID($user_id);
  $UserInfo = getUserInput($userIdDb);
  $startMsg = $UserInfo['StartID'];
  deleteMessage($chat_id, $message_id, $startMsg);
  CancelNotifyerUser($update);
  $userIdDb = getUserID($user_id);
  DeletRequest($userIdDb);
} elseif ($text == "Back" && $step == "Tin1") {
  setStep($user_id, "Tin");
  BackNotif($update);
  KindOfOrder($chat_id);
}

if ($step == "Tin2" && $text !== "Back" && $text !== "Cancel") {

  if (is_numeric($text) && strlen($text) == 10) {
    $userIdDb = getUserID($user_id);
    setBusinessTin($text, $userIdDb);
    shareLocation();
    setStep($user_id, "Provider");
  } else {
    message($chat_id, "Please insert valid tin number", null);
  }
} elseif ($text == "Cancel" && $step == "Tin2") {
  $userIdDb = getUserID($user_id);
  $UserInfo = getUserInput($userIdDb);
  $startMsg = $UserInfo['StartID'];
  deleteMessage($chat_id, $message_id, $startMsg);
  CancelNotifyerUser($update);
  $userIdDb = getUserID($user_id);
  DeletRequest($userIdDb);
} elseif ($text == "Back" && $step == "Tin2") {
  setStep($user_id, "Tin1");
  BackNotif($update);
  BusinessName($chat_id);
}

// ======================= Pick up Shop Location =============================

if (str_contains($text, "To.") && $step == "Shop") {
  setShop($user_id, $text);
  ChooseProviderPK($chat_id, $user_id);
  setStep($user_id, "LastOpt");
} elseif (!str_contains($text, "To.") && $step == "Shop") {
  message($chat_id, "please choose shop location", null);
}



// ======================= location setting ==========================

if ($longtiude && $latitude && $step == "Provider") {
  $check = CheckInAddis2($latitude, $longtiude);
  if ($check == "inside" || $check == "vertex") {
    setLocation($user_id, $longtiude, $latitude);
    GetBestDistance($user_id, $longtiude, $latitude);
    Locationrecap:
    switch ($step) {
      case "Provider": {
          message($chat_id, "Processing 🔁", null);
          ChooseProvider($update);
          setStep($user_id, "LastOpt");
          setLastMsg($user_id, $message_id);
        }
    }
  } else {
    message($chat_id, "Dear customers our service is not available in your area Choose diffrent location in Addis Ababa", null);
  }
} elseif ($text == "Back" && $step == "Provider") {
  BackNotif($update);
  orderType();
  setStep($user_id, "OrderType");
} elseif ($text !== "Back" && empty($longtiude) && $step == "Provider" && $text !== "Cancel") {
  $markup  = array('keyboard' => array(array(array('text' => 'Cancel'), array('text' => 'Current Location', 'request_location' => true))), 'resize_keyboard' => true, 'one_time_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  message($chat_id, "Please insert your Location! or cancel previous order", $markupjs);
} elseif ($text == "Cancel" && $step == "Provider") {
  $userIdDb = getUserID($user_id);
  $UserInfo = getUserInput($userIdDb);
  $startMsg = $UserInfo['StartID'];
  deleteMessage($chat_id, $message_id, $startMsg);
  CancelNotifyerUser($chat_id);
  $userIdDb = getUserID($user_id);
  DeletRequest($userIdDb);
}


// ======================== Last option payment provider ============================== 

if ($callBackdata == "Cancel Order" && $step == "LastOpt") {
  $userIdDb = getUserID($user_id);
  $UserInfo = getUserInput($userIdDb);
  $startMsg = $UserInfo['StartID'];
  deleteMessage($chat_id, $message_id, $startMsg);
  CancelNotifyerUser($chat_id);
  $userIdDb = getUserID($user_id);
  DeletRequest($userIdDb);
} elseif ($text == "Cancel" && $step == "LastOpt") {
  $userIdDb = getUserID($user_id);
  $UserInfo = getUserInput($userIdDb);
  $startMsg = $UserInfo['StartID'];
  deleteMessage($chat_id, $message_id, $startMsg);
  CancelNotifyerUser($chat_id);
  $userIdDb = getUserID($user_id);
  DeletRequest($userIdDb);
} elseif ($step == 'LastOpt' && $text !== "Cancel") {
  $markup  = array('keyboard' => array(array(array('text' => 'Cancel'))), 'resize_keyboard' => true, 'one_time_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  message($chat_id, "Please choose from the options only or cancel previous order", $markupjs);
}




//======================= Admin ====================================== //



if ($adminstep == "Admin" && $text == 'Create Post') {

  Createfunc($update);
}

if ($text != 'Create Post' && $adminstep == "Admin" && $text != 'Next') {
  $AdminID = getAdminID($user_id);
  setTitle($AdminID, $text);
  setAdminStep($user_id, "Create");
}


switch ($adminstep) {
  case "Create": {
      setAdminStep($user_id, "photo");
      getAdminPhoto($update);
    }
    break;
}

if ($adminstep == "photo" && $text != 'Next') {
  $AdminID = getAdminID($user_id);

  $photoId = $update['message']['photo'][1]['file_id'];
  SetPhotoUrl($AdminID, $photoId);
  setphoto($AdminID, $photoId);
  setAdminStep($user_id, "price");
  DownloadPic($AdminID);
} elseif ($text != 'Next' && $adminstep == "photo" && $text == 'Back') {
  setAdminStep($user_id, "Admin");
  Createfunc($update);
}


switch ($adminstep) {
  case "price": {
      setAdminStep($user_id, "desc");
      getAdminPrice($update);
    }
    break;
}

if ($adminstep == "desc" && $text != 'Next') {
  $AdminID = getAdminID($user_id);
  setAdminPrice($AdminID, $text);
  setAdminStep($user_id, "getprice");
}

switch ($adminstep) {
  case "getprice": {
      setAdminStep($user_id, "post");
      getproductPrice($update);
    }
    break;
}

if ($adminstep == "post" && $text != 'Next') {
  $AdminID = getAdminID($user_id);
  setProductDesc($AdminID, $text);
  setAdminStep($user_id, "size");
}


switch ($adminstep) {
  case "size": {
      setAdminStep($user_id, "done");
      SizeInput($update);
    }
    break;
}

if ($adminstep == "done" && $text != 'Next') {
  $AdminID = getAdminID($user_id);
  setSize($AdminID, $text);
  setAdminStep($user_id, "Post");
}

switch ($adminstep) {
  case "Post": {
      setAdminStep($user_id, "done2");
      RosteInput($update);
    }
    break;
}

if ($adminstep == "done2" && $text != 'Next') {
  $AdminID = getAdminID($user_id);
  setRoast($AdminID, $text);
  setAdminStep($user_id, "PostCh");
}


switch ($adminstep) {
  case "PostCh": {
      setAdminStep($user_id, "back");
      getpost($update);
    }
    break;
}
if ($adminstep == "back" & $text == "Post") {

  postProduct($update);
  setAdminStep($user_id, "Done2");
}
switch ($adminstep) {
  case "Done2": {
      goingBack($update);
      // setAdminStep($user_id, "Admin");
    }
    break;
}
