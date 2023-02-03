<?php



$input = file_get_contents('php://input');
$updated = json_decode($input, true);

function setAmount($amount, $chat_id, $user_id, $message_id)
{
  $userIdDb = getUserID($user_id);
  $userRow = getUserInput($userIdDb);
  $cartId = getCartID($userIdDb);
  $selectedItem = $userRow['userProductid'];
  $ID = intval($selectedItem);
  $selection = GetSelection($ID);
  $selected_price = $selection['price'];
  $quanitiy = intval($amount);

  $res = setqunti($userIdDb, $quanitiy, $selected_price, $cartId, $selectedItem, $chat_id, $message_id);
}


function setBack($amount, $chat_id, $user_id, $message_id)
{
  $userIdDb = getUserID($user_id);
  $userRow = getUserInput($userIdDb);
  $cartId = getCartID($userIdDb);
  $selectedItem = $userRow['userProductid'];
  $ID = intval($selectedItem);
  $selection = GetSelection($ID);
  $selected_price = $selection['price'];
  $quanitiy = intval($amount);

  $res = setbackqunti($userIdDb, $quanitiy, $selected_price, $selectedItem, $chat_id);
}

function nextNotify($chat_id)
{

  $markup  = array('keyboard' => array(array('Next')), 'resize_keyboard' => true, 'selective' => true, 'one_time_keyboard' => true);
  $markupjs = json_encode($markup);
  $ret = message($chat_id, "Press Next to confirm", $markupjs);
}

function setQuantity($num)
{
  $userupdate = $GLOBALS['updated'];
  $message_id = $userupdate['message']['message_id'];
  $chat_id = $userupdate['message']['chat']['id'];
  $user_id = $userupdate['message']['from']['id'];
  $text = $userupdate['message']['text'];



  $markup  = array('inline_keyboard' => array(array(array('text' => $num,  'callback_data' => '0')), array(array('text' => '1',  'callback_data' => '1'), array('text' => '2',  'callback_data' => '2'), array('text' => '3',  'callback_data' => '3')), array(array('text' => '4',  'callback_data' => '4'), array('text' => '5',  'callback_data' => '5'), array('text' => '6',  'callback_data' => '6')), array(array('text' => '7',  'callback_data' => '7'), array('text' => '8',  'callback_data' => '8'), array('text' => '9',  'callback_data' => '9')), array(array('text' => 'Clear',  'callback_data' => 'Clear'), array('text' => '0',  'callback_data' => '0'), array('text' => 'Submit',  'callback_data' => 'submit')), array(array('text' => 'Cancel order',  'callback_data' => 'Cancel'))));

  $markupjs = json_encode($markup);

  $ret = message($chat_id, "Enter Quantity [ ብዛት ያስገቡ ]", $markupjs);
  return $userupdate['message']['message_id'];
}

function sharePhone($chat_id)
{

  $markup  = array('keyboard' => array(array(array('text' => 'Phone Number', 'request_contact' => true)), array(array('text' => 'Back'), array('text' => 'Cancel'))), 'resize_keyboard' => true, 'one_time_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  $msg = urlencode("Please share your Phone Number\nስልክ ቁጥሮን ያስገቡ");
  $ret = message($chat_id, $msg, $markupjs);
  return;
}

function KindOfOrder($chat_id)
{
  $markup  = array('keyboard' => array(array(array('text' => 'Personal Order')), array(array('text' => 'Business Order')), array(array('text' => 'Back'), array('text' => 'Cancel'))), 'resize_keyboard' => true, 'one_time_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  $msg = urlencode("Choose receipt type\nደረሰኝ አይነት ይምረጡ");
  $ret = message($chat_id, $msg, $markupjs);
  return;
}


function BusinessName($chat_id)
{
  $markup  = array('keyboard' => array(array(array('text' => 'Back'), array('text' => 'Cancel'))), 'resize_keyboard' => true, 'one_time_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  $msg = urlencode("Insert business name\nየድርጅቶን ስም ያስገቡ");
  $ret = message($chat_id, $msg, $markupjs);
  return;
}

function BusinessTin($chat_id)
{
  $markup  = array('keyboard' => array(array(array('text' => 'Back'), array('text' => 'Cancel'))), 'resize_keyboard' => true, 'one_time_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  $msg = urlencode("Insert your business Tin number\nቲን ቁጥሮን ያስገቡ");
  $ret = message($chat_id, $msg, $markupjs);
  return;
}




function shareLocation()
{
  $userupdate = $GLOBALS['updated'];
  $chat_id = $userupdate['message']['chat']['id'];
  $user_id = $userupdate['message']['from']['id'];
  $text = $userupdate['message']['text'];
  $markup  = array('keyboard' => array(array(array('text' => 'Current Location', 'request_location' => true)), array(array('text' => 'Back'), array('text' => 'Cancel'))), 'resize_keyboard' => true, 'one_time_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);

  $msg = urlencode("Share your location\nአድራሻዎት ያስገቡ");
  $ret = message($chat_id, $msg, $markupjs);
  return;
}

function orderType()
{
  $userupdate = $GLOBALS['updated'];
  $chat_id = $userupdate['message']['chat']['id'];
  $user_id = $userupdate['message']['from']['id'];
  $text = $userupdate['message']['text'];
  //for Future use

  // array(array('text' => 'Pickup Order')),  
  $markup  = array('keyboard' => array(array(array('text' => 'Pickup Order')), array(array('text' => 'Delivery Order')), array(array('text' => 'Back'), array('text' => 'Cancel Order'))), 'resize_keyboard' => true, 'one_time_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  $msg = urlencode("Select order type\nትዕዛዝ አይነት ይምረጡ");

  $ret = message($chat_id, $msg, $markupjs);
  return;
}

function AddCart($chat_id, $user_id)
{


  $markup  = array('inline_keyboard' => array(array(array('text' => 'Add more products',  'callback_data' => 'Yes')), array(array('text' => 'Continue to order', 'callback_data' => 'Next')), array(array('text' => 'Cancel previous order', 'callback_data' => 'Cancel'))));
  $markupjs = json_encode($markup);
  $msg = urlencode("Do you want to add more to your cart?\nመጨመር ይፈልጋሉ?");

  $ret = message($chat_id, $msg, $markupjs);
  return;
}

function ChooseProvider($data)
{
  $userupdate = $GLOBALS['updated'];
  $chat_id = $data['message']['chat']['id'];
  $user_id = $data['message']['from']['id'];
  $message_id = $data['message']['message_id'];
  $message_idnum = intval($message_id) + 1;

  // botDemo.versavvymedia.com
  $UserId = getUserID($user_id);
  $urlStr = base64_encode(urlencode($UserId));
  // $tempop = 'https://a627-196-188-123-12.ngrok.io/TomocaBot2/OrderingTele/index.php?UserId=' . $urlStr;
  // $paramansiy = 'https://a627-196-188-123-12.ngrok.io/TomocaBot2/orderingPage/index.php?UserId=' . $urlStr;
  // $parampaypal = 'https://versavvymedia.com/tomocaBot/OrderingPaypal/index.php?UserId=' . $urlStr;
  $paramTel = 'https://versavvymedia.com/TomocaAdminBack/OrderingTele/index.php?UserId=' . $urlStr;
  $markup  = array('inline_keyboard' => array(array(array('text' => 'telebirr',  'url' => $paramTel)), array(array('text' => 'Cancel Order', 'callback_data' => 'Cancel Order'))));
  $markupjs = json_encode($markup);
  // $markup2  = array('keyboard' => array(array('Cancel Order')), 'resize_keyboard' => true, 'selective' => true);
  // $markupj2s = json_encode($markup);
  $ret = message($chat_id, "Choose payment provider to continue ", $markupjs);
  $userIdDb = getUserID($user_id);
  setLastMsg($userIdDb, $message_idnum);
  return;
}

function ChooseProviderPK($chat_id, $user_id)
{

  $UserId = getUserID($user_id);

  $urlStr = base64_encode(urlencode($UserId));
  $tempop = 'https://a627-196-188-123-12.ngrok.io/TomocaBot2/OrderingTele/index.php?UserId=' . $urlStr;
  // https://a86d-196-188-123-12.ngrok.io/TomocaBot2
  $Absyniaurl = 'https://a86d-196-188-123-12.ngrok.io/TomocaBot2/orderingPage/index.php?UserId=' . $urlStr;
  $paypalurl = 'https://versavvymedia.com/tomocaBot/OrderingPaypal/index.php?UserId=' . $urlStr;
  // $paramTel = 'https://versavvymedia.com/tomocaBot/OrderingTele/index.php?UserId=' . $urlStr;
  $paramTel = 'https://versavvymedia.com/TomocaAdminBack/OrderingTele/index.php?UserId=' . $urlStr;

  $markup  = array('inline_keyboard' => array(array(array('text' => 'telebirr',  'url' => $paramTel)),  array(array('text' => 'Cancel Order', 'callback_data' => 'Cancel Order'))));
  $markupjs = json_encode($markup);
  $ret = message($chat_id, "Choose payment provider to continue ", $markupjs);
  return $ret;
}





function showdetail($UIDS, $chat_id, $user_id, $message_id)
{
  global $db;
  $detail = getUserInput($UIDS);
  $ChartStart = intval($detail['CartStart']);
  $ChartEnd = intval($detail['CartEnd']);
  $arryDetail = array();
  $i = 1;

  if ($ChartStart > $ChartEnd) {
    $ret = message($chat_id, "The Cart is empty", null);
    setStep($user_id, "");
    $UID = getUserID($user_id);
    ClearQuan($UID);
  } else {
    for ($x = $ChartStart; $x <= $ChartEnd; $x++) {
      $query = "SELECT * From cart WHERE cartId=$x";;
      $res = mysqli_query($db, $query);
      $res = mysqli_fetch_assoc($res);
      $selectedItem = GetSelection($res['ProductId']);

      $Ch_title = $selectedItem['Title'];
      $Ch_quan = $res['Quantity'];
      $Ch_prc = $selectedItem['price'];
      $Ch_amn = $res['Amount'];
      $Ch_Update = $res['Updated'];

      if ($Ch_Update == "Updated") {
        $detailText = urlencode("❕ Updated product\n\nProduct Number:" . $i  . "\n\nProduct: " . $Ch_title . "\n\n" . "Quantity: " . $Ch_quan . "\n\n" . "Price/Package:" . $Ch_prc . "birr" . "\n\n"  . "Total Amount:" . $Ch_amn . "birr" . "\n\n");
      } else {
        $detailText = urlencode("\n\nProduct Number:" . $i  . "\n\nProduct: " . $Ch_title . "\n\n" . "Quantity: " . $Ch_quan . "\n\n" . "Price/Package:" . $Ch_prc . "birr" . "\n\n"  . "Total Amount:" . $Ch_amn . "birr" . "\n\n");
      }


      $markup  = array('keyboard' => array(array('Next'), array('Go Back', 'Cancel')), 'resize_keyboard' => true, 'selective' => true, 'one_time_keyboard' => true);
      $markupjs = json_encode($markup);
      $ret = message($chat_id, $detailText, $markupjs);
      $i++;
    }
  }
}

function showSubscriptionDetail($UIDS, $chat_id, $message_id, $selectedItem)
{


  $Ch_title = $selectedItem['Title'];
  $Ch_quan = $selectedItem['size'];
  $Ch_prc = $selectedItem['price'];
  $Ch_amn = $selectedItem['subscription_period'];
  $Ch_Update = "Subscription Type";
  $detailText = urlencode("\n\nSubscription: " . $Ch_title . "\n\n" . "Total Size: " . $Ch_quan . "\n\n" . "Subscription Total:" . $Ch_prc . "birr" . "\n\n"  . "Subscription Period:" . $Ch_amn . "" . "\n\n");


  $markup  = array('keyboard' => array(array('Next'), array('Go Back', 'Cancel')), 'resize_keyboard' => true, 'selective' => true, 'one_time_keyboard' => true);
  $markupjs = json_encode($markup);
  $ret = message($chat_id, $detailText, $markupjs);
}

function showMembershipDetail($UIDS, $chat_id, $message_id, $selectedItem)
{


  $Ch_title = $selectedItem['Title'];
  $Ch_quan = $selectedItem['size'];
  $Ch_prc = $selectedItem['price'];
  $Ch_amn = $selectedItem['subscription_period'];
  $Ch_Update = "Membership Type";
  $detailText = urlencode("\n\Membership: " . $Ch_title . "\n\n" . "Discount: " . $Ch_quan . "\n\n" . "Membership Total:" . $Ch_prc . "birr" . "\n\n"  . "Membership Period:" . $Ch_amn . "" . "\n\n");


  $markup  = array('keyboard' => array(array('Next'), array('Go Back', 'Cancel')), 'resize_keyboard' => true, 'selective' => true, 'one_time_keyboard' => true);
  $markupjs = json_encode($markup);
  $ret = message($chat_id, $detailText, $markupjs);
}

function showTotalDetail($UIDS, $chat_id, $user_id)
{
  global $db;
  $detail = getUserInput($UIDS);
  $ChartStart = intval($detail['CartStart']);
  $ChartEnd = intval($detail['CartEnd']);
  $totalSum = 0;
  if ($ChartStart > $ChartEnd) {
    $ret = message($chat_id, "The Cart is empty", null);
    setStep($user_id, "");
    $UID = getUserID($user_id);
    ClearQuan($UID);
  } else {
    for ($x = $ChartStart; $x <= $ChartEnd; $x++) {
      $query = "SELECT * From cart WHERE cartId=$x";;
      $res = mysqli_query($db, $query);
      $res = mysqli_fetch_assoc($res);
      $Ch_quan = intval($res['Quantity']);
      $totalSum = $totalSum + $Ch_quan;
    }
  }

  $detailText = urlencode("Order Summary\n\nNumber of product type:" . $detail['NumProducts']  . "\n\nTotal number of bag: " . $totalSum . "\n\n" . "Discount: 15% \n\n" . "Total Cost:" . $detail['TotalAmount'] . "birr" . "\n\n");
  // $markup  = array('keyboard' => array(array('Next'), array('Go Back', 'Cancel')), 'resize_keyboard' => true, 'selective' => true, 'one_time_keyboard' => true);
  // $markupjs = json_encode($markup);
  $ret = message($chat_id, $detailText, null);
}


function DetailTextMem($chat_id)
{
  $markup  = array('keyboard' => array(array('Next'), array('Go Back', 'Cancel')), 'resize_keyboard' => true, 'selective' => true, 'one_time_keyboard' => true);
  $markupjs = json_encode($markup);
  $ret = message($chat_id, "💳  Membership Detail ዝርዝር ", $markupjs);
}



function DetailText($chat_id)
{
  $markup  = array('keyboard' => array(array('Next'), array('Go Back', 'Cancel')), 'resize_keyboard' => true, 'selective' => true, 'one_time_keyboard' => true);
  $markupjs = json_encode($markup);
  $ret = message($chat_id, "🛒 Subscription Detail ዝርዝር ", $markupjs);
}
function SaveandShowSelection($selection, $update)
{
  $product_title = $selection['Title'];
  $product_image = $selection['photo'];
  $product_price = $selection['price'];
  $product_Desc = $selection['Description'];
  $product_Id = $selection['productId'];
}

function CancelNotifyer($data)
{
  $markup  = array('inline_keyboard' => array(array(array('text' => 'Back to Channel',  'url' => 'https://t.me/TomTomChan'))));
  $markupjs = json_encode($markup);
  $chat_id = $data['callback_query']['message']['chat']['id'];
  message($chat_id, "Order canceled!  Select Item again", $markupjs);
}

function CancelNotifyerUser($chat_id)
{
  $markup  = array('inline_keyboard' => array(array(array('text' => 'Back to Channel',  'url' => 'https://t.me/TomTomChan'))));
  $markupjs = json_encode($markup);

  message($chat_id, "Order canceled!  Select Item again", $markupjs);
}

function addProductLess($chat_id)
{

  $markup  = array('inline_keyboard' => array(array(array('text' => 'Add more product',  'url' => 'https://t.me/TomTomChan'))));
  $markupjs = json_encode($markup);
  $msg = urlencode("The cart quantity total should be between 5 and 100.\nብዛት ከ 5 - 100 ይወሰናል");

  message($chat_id, $msg, $markupjs);
}

function AddNotifyerUser($chat_id)
{
  $markup  = array('inline_keyboard' => array(array(array('text' => 'Back to Channel',  'url' => 'https://t.me/TomTomChan'))));
  $markupjs = json_encode($markup);

  message($chat_id, "To add more product to your 🛒 go back to the channel", $markupjs);
}

function CancelNotifyerWeb($UserID)
{
  $markup  = array('inline_keyboard' => array(array(array('text' => 'Back to Channel',  'url' => 'https://t.me/TomTomChan'))));
  $markupjs = json_encode($markup);
  // $chat_id = $data['message']['chat']['id'];
  message($UserID, "Order canceled!  Select Item again", $markupjs);
}


function BackNotif($data)
{
  $chat_id = $data['message']['chat']['id'];
  message($chat_id, "Going back!");
}

function BackNotifUser($chat_id)
{

  message($chat_id, "Going back!");
}

function CancelKey($data)
{
  $chat_id = $data['message']['chat']['id'];
  $markup  = array('keyboard' => array(array('Cancel Order')), 'resize_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  message($chat_id, null, $markupjs);
}

function DeletRequest($userIdDb)
{
  DeletRow($userIdDb);
}


function ChooseShop($chat_id)
{

  $markup  = array('inline_keyboard' => array(
    array(array('text' => ' Piassa Cathedral ',  'callback_data' => 'To.Historical'), array('text' => ' Piassa Saron Building ',  'callback_data' => 'To.Office Bar')),
    array(array('text' => 'Sar bet infront of Fantu supermarket',  'callback_data' => 'To.Galleria'), array('text' => 'Welo sefer mulugeta real state',  'callback_data' => 'To.Meet up')),
    array(array('text' => 'Bole Medehanilm Kategna',  'callback_data' => 'To.Roastery'), array('text' => ' Atlas infront of Safari ',  'callback_data' => 'To.Camera')),
    array(array('text' => 'Around 22 yelma Butcher Shops ',  'callback_data' => 'To.Village'), array('text' => 'Meskel flower aster plaza',  'callback_data' => 'To.Blue')),
    array(array('text' => 'Bole kelela building',  'callback_data' => 'To.Sip and Create'), array('text' => 'Dembel',  'callback_data' => 'To.Black and white')),




  ));

  $markupjs = json_encode($markup);
  $msg = urlencode("Choose Pickup Location\nሱቅ አድራሻ ይምረጡ");
  $ret = message($chat_id, $msg, $markupjs);
}

function GetBestDistance($userid, $longtiude, $latitude)
{


  $latitudeTo = floatval($latitude);
  $longitudeTo = floatval($longtiude);

  $distanceTable = array();
  $distanceTable[0] = twopoints_on_earth(9.03112, 38.75077, $latitudeTo, $longitudeTo);
  $distanceTable[1] = twopoints_on_earth(9.04537, 38.74997, $latitudeTo, $longitudeTo);
  $distanceTable[2] = twopoints_on_earth(8.99632, 38.73574, $latitudeTo, $longitudeTo);
  $distanceTable[3] = twopoints_on_earth(8.99368, 38.77676, $latitudeTo, $longitudeTo);
  $distanceTable[4] = twopoints_on_earth(8.9959, 38.79035, $latitudeTo, $longitudeTo);
  $distanceTable[5] = twopoints_on_earth(9.00174, 38.78339, $latitudeTo, $longitudeTo);
  $distanceTable[6] = twopoints_on_earth(9.00756, 38.78393, $latitudeTo, $longitudeTo);
  $distanceTable[7] = twopoints_on_earth(8.98966, 38.76544, $latitudeTo, $longitudeTo);
  $distanceTable[8] = twopoints_on_earth(9.01979, 38.76826, $latitudeTo, $longitudeTo);
  $distanceTable[9] = twopoints_on_earth(9.00524, 38.76733, $latitudeTo, $longitudeTo);



  $maxIndex = array_search(min($distanceTable), $distanceTable);
  $TomocaNum = $maxIndex + 1;

  switch ($TomocaNum) {
    case 1: {
        $ShopLocationText = "To.Historical";
        setShop($userid, $ShopLocationText);
      }
      break;
    case 2: {
        $ShopLocationText = "To.Office Bar";
        setShop($userid, $ShopLocationText);
      }
      break;
    case 3: {
        $ShopLocationText = "To.Galleria";
        setShop($userid, $ShopLocationText);
      }
      break;
    case 4: {
        $ShopLocationText = "To.Meet up";
        setShop($userid, $ShopLocationText);
      }
      break;
    case 5: {
        $ShopLocationText = "To.Roastery";
        setShop($userid, $ShopLocationText);
      }
      break;
    case 6: {
        $ShopLocationText = "To.Camera";
        setShop($userid, $ShopLocationText);
      }
      break;
    case 7: {
        $ShopLocationText = "To.Village";
        setShop($userid, $ShopLocationText);
      }
      break;
    case 8: {
        $ShopLocationText = "To.Blue";
        setShop($userid, $ShopLocationText);
      }
      break;
    case 9: {
        $ShopLocationText = "To.Sip and Create";
        setShop($userid, $ShopLocationText);
      }
      break;
    case 10: {
        $ShopLocationText = "To.Black and white";
        setShop($userid, $ShopLocationText);
      }
      break;

    default:
  }
}
