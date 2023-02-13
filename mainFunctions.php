<?php

require __DIR__ . '/vendor/autoload.php';

// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();


// $API_TOKEN = $_ENV['API_TOKEN'];
require_once 'config.php';

require_once 'PolygonCheck.php';
// define('API_TOKEN', '5270072990:AAFYNg9m3lZ1IXITw9s9rB5ExLxfr1ypjzo');

function bot($data)
{
    return json_decode(file_get_contents("https://api.telegram.org/bot" . $_ENV['BOTAPI_KEY'] . "/" . $data), true);
}
function message($chat_id, $msg, $markup = null)
{
    if ($markup != null) {
        return json_encode(bot("sendMessage?chat_id=" . $chat_id . "&text=" . $msg . "&reply_markup=" . $markup));
    } else {
        return json_encode(bot("sendMessage?chat_id=" . $chat_id . "&text=" . $msg));
    }
}


function senLocationMsg($chat_id, $lat, $longt)
{
    return json_encode(bot("sendLocation?chat_id=" . $chat_id . "&latitude=" . $lat . "&longitude=" . $longt));
}

function forwardMessage($user_id, $message_id, $from_chat_id)
{
    bot("forwardMessage?chat_id=" . $user_id . "&from_chat_id=" . $from_chat_id . "&message_id=" . $message_id);
}

function editMessage($chat_id, $message_id, $msg)
{

    $markup  = array('inline_keyboard' => array(array(array('text' => $msg,  'callback_data' => '1')), array(array('text' => '1',  'callback_data' => '1'), array('text' => '2',  'callback_data' => '2'), array('text' => '3',  'callback_data' => '3')), array(array('text' => '4',  'callback_data' => '4'), array('text' => '5',  'callback_data' => '5'), array('text' => '6',  'callback_data' => '6')), array(array('text' => '7',  'callback_data' => '7'), array('text' => '8',  'callback_data' => '8'), array('text' => '9',  'callback_data' => '9')), array(array('text' => 'Clear',  'callback_data' => 'Clear'), array('text' => '0',  'callback_data' => '0'), array('text' => 'Submit',  'callback_data' => 'submit')), array(array('text' => 'Cancel order',  'callback_data' => 'Cancel'))));
    $markupjs = json_encode($markup);
    bot("editMessageReplyMarkup?chat_id=" . $chat_id . "&message_id=" . $message_id . "&reply_markup=" . $markupjs);
    return $msg;
}

function deleteMessage($chat_id, $message_id, $startId)
{
    $startIdNum = intval($startId);
    $endIdNum = intval($message_id);
    for ($x = $startIdNum; $x <= $endIdNum; $x++) {
        bot("deleteMessage?chat_id=" . $chat_id . "&message_id=" . $x);
    }
}


function photo($chat_id, $photo_link, $caption = null)
{
    bot("sendPhoto?chat_id=" . $chat_id . "&photo=" . $photo_link . "&caption=" . $caption);
}
function video($chat_id, $video_link, $caption = null)
{
    bot("sendVideo?chat_id=" . $chat_id . "&video=" . $video_link . "&caption=" . $caption);
}


function receiveText($user_id, $textConfirm)
{
    return bot("sendMessage?chat_id=" . $user_id . "&text=" . $textConfirm);
}

function send_file($chat_id, $file_id, $caption = null)
{
    bot("sendDocument?chat_id=" . $chat_id . "&document=" . $file_id . "&caption=" . $caption);
}

function setLastMsg($user_id, $Message)
{
    global $db;
    $query = "UPDATE users SET LastMsg = '$Message' WHERE UserId=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function action($chat_id, $action)
{
    bot("sendChatAction?chat_id=" . $chat_id . "&action=" . $action);
}

function answer_query($query_id, $text, $show_alert = false)
{
    bot("answerCallbackQuery?callback_query_id=" . $query_id . "&text=" . $text . "&show_alert=" . $show_alert);
}

function getStep($user_id)
{
    global $db;
    $query = "SELECT step From users WHERE UserId=$user_id";
    $res = mysqli_query($db, $query);
    $res2 = mysqli_fetch_assoc($res);
    return $res2['step'];
}


function getStepMem($user_id)
{
    global $db;
    $query = "SELECT step From membership WHERE telegramID=$user_id";
    $res = mysqli_query($db, $query);
    $res2 = mysqli_fetch_assoc($res);
    return $res2['step'];
}

function setStep($user_id, $step)
{
    global $db;
    $query = "UPDATE users SET step = '$step' WHERE UserId=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function setStepMem($user_id, $step)
{
    global $db;
    $query = "UPDATE membership SET step = '$step' WHERE telegramID=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function setStepPayed($user_id, $step)
{
    global $db;
    $query = "UPDATE users SET step = '$step' WHERE Id=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function setPhase($user_id, $phase)
{
    global $db;
    $query = "UPDATE users SET phase = '$phase' WHERE Id=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function getMisc($user_id)
{
    global $db;
    $query = "SELECT misc From users WHERE UserId=$user_id";
    $res = mysqli_query($db, $query);
    $res2 = mysqli_fetch_assoc($res);
    return $res2['misc'];
}

function getAdminStep($user_id)
{
    global $db;
    $query = "SELECT step From products WHERE UserId=$user_id";
    $res = mysqli_query($db, $query);
    $res2 = mysqli_fetch_assoc($res);
    return $res2['step'];
}

function getquantity($user_id)
{
    global $db;
    $query = "SELECT quantityHolder From users WHERE Id=$user_id";
    $res = mysqli_query($db, $query);
    $res2 = mysqli_fetch_assoc($res);
    return $res2['quantityHolder'];
}

function setAdminStep($user_id, $step)
{
    global $db;
    $query = "UPDATE products SET step = '$step' WHERE UserId=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function setmisc($user_id)
{
    global $db;
    $query = "UPDATE users SET misc = 1 WHERE UserId=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function setCartStart($user_id, $CartId)
{
    global $db;
    $query = "UPDATE users SET CartStart = '$CartId' WHERE Id=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function setCartend($user_id, $CartId)
{
    global $db;
    $query = "UPDATE users SET CartEnd = '$CartId' WHERE Id=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function setAdminPrice($user_id, $product_price)
{
    global $db;
    $query = "UPDATE products SET price = '$product_price' WHERE productId=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function setProductDesc($user_id, $product_desc)
{
    global $db;
    $query = "UPDATE products SET Description = '$product_desc' WHERE productId=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}
function appendQuantity($text, $user_id)
{
    global $db;
    $query = "UPDATE users set quantityHolder = CONCAT(quantityHolder,'$text') WHERE Id=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function makePickupOrder($data)
{
    global $db;
    $FirstName = $data['sub_name'];
    $phoneNumber = $data['sub_phone'];
    $productID = $data['product_id'];
    $totalAmn = $data['payment_Total'];
    $tnxNumber = $data['transaction_number'];
    $shopLocation = $data['ShopLocation'];
    $UserId = $data['telegramId'];



    $query = "INSERT INTO pickuppayed(UserID, FirstName, LastName, NumProduct, TotalAmount, TransactionID, PhoneNumber, ShopLocation, Pickstatus, product_id)
    VALUES ('$UserId', '$FirstName', '$FirstName', '$productID', '$totalAmn', '$tnxNumber', '$phoneNumber', '$shopLocation', 'NEW', '$productID')";
    $res = mysqli_query($db, $query);
    return $res;
}


function makeDeliveryOrder($data, $PickUpLink, $deliveryLink, $jobId)
{
    global $db;
    $FirstName = $data['sub_name'];
    $phoneNumber = $data['sub_phone'];
    $productID = $data['product_id'];
    $totalAmn = $data['payment_Total'];
    $tnxNumber = $data['transaction_number'];
    $shopLocation = $data['ShopLocation'];
    $UserId = $data['telegramId'];
    $userLocation = $data['localtion'];
    $tin_num = $data['tin_num'];
    $tin_name = $data['tin_name'];

    $today = new DateTime();


    $query = "INSERT INTO deliveryorders(FirstName, LastName, PhoneNumber, OrderNumber, Total, Status, ShopLocation, TinName, TinNumber, orderDate, orderTime, DeliveryID, DeliveryUrl)
    VALUES ('$FirstName', '$FirstName', '$phoneNumber', '$tnxNumber', '$totalAmn', 'NEW', '$shopLocation', '$tin_name', '$tin_num' ,'$today', '$today', '$jobId', '$deliveryLink')";
    $res = mysqli_query($db, $query);
    return $res;
}



function setqunti($user_id, $quan, $price, $cartId, $productID, $chat_id, $message_id)
{
    global $db;

    $query = "SELECT * FROM cart WHERE ProductId='$productID' AND UserID ='$user_id' ";;
    $res1 = mysqli_query($db, $query);
    $res2 = mysqli_fetch_assoc($res1);

    if ($res2['Quantity'] == "") {

        $query = "UPDATE cart SET Quantity = '$quan' WHERE cartId=$cartId";;
        $res = mysqli_query($db, $query);

        $pricenum = intval($price);
        $Amount = $quan * $pricenum;

        $query = "UPDATE cart SET Amount = '$Amount' WHERE cartId=$cartId";;
        $res = mysqli_query($db, $query);
    } else {
        $newQuan = intval($res2['Quantity']);
        $totalQuan = $newQuan + $quan;

        if ($totalQuan > 100) {
            message($chat_id, "❌ Can not update quantity! you are exceeding the limit ");
            $UID = getUserID($user_id);
            ClearQuan($UID);
            setStep($user_id, "Keypad");
            // editMessage($user_id, $message_id, "0");
            $retu = setQuantity("0");
        } else {
            $query = "UPDATE cart SET Quantity = '$totalQuan' WHERE ProductId= $productID AND UserID = $user_id ;";
            $res = mysqli_query($db, $query);

            $pricenum = intval($price);
            $Amount = $totalQuan * $pricenum;

            $query = "UPDATE cart SET Amount = '$Amount' WHERE ProductId= $productID AND UserID = $user_id ;";
            $res = mysqli_query($db, $query);

            $query = "UPDATE cart SET Updated = 'Updated' WHERE ProductId= $productID AND UserID = $user_id ;";
            $res = mysqli_query($db, $query);
        }
    }

    // if ($res == 0) {

    //     $query = "INSERT INTO cart(ProductId, UserID ) VALUES ('$productId', '$user_id')";
    //     $res = mysqli_query($db, $query);
    //     return $res;
    // } elseif ($res == 1) {
    //     return;
    // } else {
    //     echo "something is wromg";
    // }




    return $res;
}


function setbackqunti($user_id, $quan, $price, $productID, $chat_id)
{
    global $db;

    $query = "SELECT * FROM cart WHERE ProductId='$productID' AND UserID ='$user_id' ";;
    $res1 = mysqli_query($db, $query);
    $res2 = mysqli_fetch_assoc($res1);

    $newQuan = intval($res2['Quantity']);
    $totalQuan = $newQuan - $quan;

    if ($totalQuan > 100) {
        message($chat_id, "❌ Can not update quantity! you are exceeding the limit ");
        $UID = getUserID($user_id);
        ClearQuan($UID);
        setStep($user_id, "Keypad");
        // editMessage($user_id, $message_id, "0");
        $retu = setQuantity("0");
    } else {
        $query = "UPDATE cart SET Quantity = '$totalQuan' WHERE ProductId= $productID AND UserID = $user_id ;";
        $res = mysqli_query($db, $query);

        $pricenum = intval($price);
        $Amount = $totalQuan * $pricenum;

        $query = "UPDATE cart SET Amount = '$Amount' WHERE ProductId= $productID AND UserID = $user_id ;";
        $res = mysqli_query($db, $query);

        $query = "UPDATE cart SET Updated = 'Updated' WHERE ProductId= $productID AND UserID = $user_id ;";
        $res = mysqli_query($db, $query);
    }


    return $res;
}


function getCartID($userIdDb)
{

    global $db;
    $query = "SELECT MAX(cartId) FROM cart WHERE UserID=$userIdDb";;
    $res = mysqli_query($db, $query);
    $respo = mysqli_fetch_assoc($res);
    return $respo['MAX(cartId)'];
}

function sendNotificationToUser($detail)
{

    $UserID = $detail['UserID'];
    $FirstName = $detail['FirstName'];
    $LastName = $detail['LastName'];
    $CartStart = $detail['CartStart'];
    $CartEnd = $detail['CartEnd'];
    $TotalAmount = $detail['Total'];
    $NumProduct = $detail['Quantity'];
    $TransactionID = $detail['OrderNumber'];
    $PhoneNumber = $detail['PhoneNumber'];
    $ShopLocation = $detail['ShopLocation'];
    $pickupurl = $detail['Pickupurl'];
    $Deliveryurl = $detail['DeliveryUrl'];
    $UserTGID = $detail['UserTGID'];

    $YesMessage = 'YES' . $TransactionID;
    $NoMessage = "NO" . $TransactionID;

    $markup  = array('inline_keyboard' => array(array(array('text' => 'Yes',  'callback_data' => $YesMessage), array('text' => 'No', 'callback_data' => $NoMessage))));

    $markupjs = json_encode($markup);

    message($UserTGID, "Dear customer your order is on it's way please confirm only once your order is completed", $markupjs);
}



function ClearQuan($user_id)
{
    global $db;
    $query = "UPDATE users SET quantityHolder = '' WHERE Id=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function SetCompletedPickup($UserInfo, $auth_amount, $transactionID, $ProductInfo, $Payment)
{
    global $db;
    $PhoneNum = $UserInfo['PhoneNum'];
    $UserTgId = $UserInfo['UserId'];
    $UserName  = $UserInfo['UserName'] . $UserInfo['LastName'];
    $NumProducts = $UserInfo['NumProducts'];
    $ShopLocation = $UserInfo['ShopLocation'];
    $BusinessName = $UserInfo['TinName'];
    $TinNumber = $UserInfo['TinNumber'];
    $orderType = $UserInfo['orderType'];
    $bagSize = $UserInfo['quantityHolder'];
    $productId = $UserInfo['userProductid'];
    $selectedFirstDate = $UserInfo['selectedDate'];
    $sub_Month = $ProductInfo['subscription_period'];
    $monthsToAdd = number_format($sub_Month);
    $UserTgId = $UserInfo['UserId'];
    date_default_timezone_set("Africa/Addis_Ababa");
    $currentDate = date('Y-m-d');
    $expirationDate = date('Y-m-d', strtotime("+$monthsToAdd months"));
    // $newDate = $currentDate->modify("+$monthsToAdd months");
    // $newDateString = $newDate->format('Y-m-d');

    $query = "INSERT INTO subscriptionlist(sub_name, sub_phone, sub_startingDate, sub_endDate, next_orderDate, orderType, product_id, payment_Total, payment_status, transaction_number, ShopLocation, sub_status, telegramId) VALUES ('$UserName', '$PhoneNum', '$currentDate', '$expirationDate', '$selectedFirstDate', '$orderType', '$productId', '$auth_amount', '$Payment', '$transactionID', '$ShopLocation', 'Online', '$UserTgId')";
    $res = mysqli_query($db, $query);
    if (!$res) {
        die('query failed' . mysqli_error($db));
    }
}

function SetCompletedDelivery($UserInfo, $auth_amount, $transactionID, $ProductInfo, $Payment)
{
    global $db;
    $PhoneNum = $UserInfo['PhoneNum'];
    $UserTgId = $UserInfo['UserId'];
    $UserName  = $UserInfo['UserName'] . $UserInfo['LastName'];
    $NumProducts = $UserInfo['NumProducts'];
    $ShopLocation = $UserInfo['ShopLocation'];
    $BusinessName = $UserInfo['TinName'];
    $TinNumber = $UserInfo['TinNumber'];
    $orderType = $UserInfo['orderType'];
    $bagSize = $UserInfo['quantityHolder'];
    $productId = $UserInfo['userProductid'];
    $selectedFirstDate = $UserInfo['selectedDate'];
    $sub_Month = $ProductInfo['subscription_period'];
    $monthsToAdd = number_format($sub_Month);
    $UserTgId = $UserInfo['UserId'];
    date_default_timezone_set("Africa/Addis_Ababa");
    $currentDate = date('Y-m-d');
    $expirationDate = date('Y-m-d', strtotime("+$monthsToAdd months"));
    $lat = $UserInfo["lat"];
    $longtidue = $UserInfo["longtiud"];
    $location = $UserInfo["location"];


    $query = "INSERT INTO subscriptionlist(sub_name, sub_phone, sub_startingDate, sub_endDate, next_orderDate, orderType, product_id, payment_Total, payment_status, transaction_number, ShopLocation, sub_status, telegramId, tin_num, tin_name, longt, lat, localtion) VALUES ('$UserName', '$PhoneNum', '$currentDate', '$expirationDate', '$selectedFirstDate', '$orderType', '$productId', '$auth_amount', '$Payment', '$transactionID', '$ShopLocation', 'Online', '$UserTgId', '$TinNumber', '$BusinessName' , '$longtidue', '$lat', '$location')";
    $res = mysqli_query($db, $query);
    if (!$res) {
        die('query failed' . mysqli_error($db));
    }
}

function CheckQuantity($userIdDb, $startCart, $cartEnd)
{
    global $db;
    $$totalAmount = 0;

    $start = intval($startCart);
    $end = intval($cartEnd);
    for ($x = $start; $x <= $end; $x++) {
        $query = "SELECT Quantity From cart WHERE cartId=$x";;
        $res = mysqli_query($db, $query);
        $res = mysqli_fetch_assoc($res);
        $Tempo = intval($res['Quantity']);
        $totalAmount += $Tempo;
    }

    if ($totalAmount >= 5 && $totalAmount < 101) {
        return true;
    } else {
        return false;
    }
}


function setTotalAmount($user_id, $startnum, $endnum)
{
    global $db;

    $query = "UPDATE users SET CartEnd = '$endnum' WHERE Id=$user_id";;
    $res = mysqli_query($db, $query);



    $totalAmount = 0.00;
    $start = intval($startnum);
    $end = intval($endnum);
    $totalProduct = ($end - $start) + 1;

    $query = "UPDATE users SET NumProducts = '$totalProduct' WHERE Id=$user_id";;
    $res = mysqli_query($db, $query);

    for ($x = $start; $x <= $end; $x++) {
        $query = "SELECT Amount From cart WHERE cartId=$x";;
        $res = mysqli_query($db, $query);
        $res = mysqli_fetch_assoc($res);
        $Tempo = intval($res['Amount']);
        $totalAmount += $Tempo;
    }

    $discount = ($totalAmount / 1.15);
    $TotalAmountWithDiscount = round($discount, 2);
    global $db;
    $query = "UPDATE users SET TotalAmount = '$TotalAmountWithDiscount' WHERE Id=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function setprice($user_id, $quan, $price)
{
    $TotalAmount = $quan * $price;
    global $db;
    $query = "UPDATE cart SET Amount = '$TotalAmount' WHERE Id=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}


function setcomment($user_id, $Comment)
{

    global $db;
    $query = "UPDATE users SET AdressComment = '$Comment' WHERE Id=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function setphoto($user_id, $file_id)
{
    global $db;
    $query = "UPDATE products SET photo = '$file_id' WHERE productId=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function SetPhotoUrl($user_id, $photoId)
{
    $res = bot("getFile?file_id=" . $photoId);
    $path = $res['result']['file_path'];
    $urlPath = "https://api.telegram.org/file/bot" . $_ENV['BOTAPI_KEY'] . "/" . $path;
    $img = 'productImage.jpg';

    file_put_contents($img, file_get_contents($urlPath));

    global $db;
    $query = "UPDATE products SET PhotoPath = '$urlPath' WHERE productId=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function getPhoto($user_id)
{
    global $db;
    $query = "SELECT photo From products WHERE productId=$user_id";;
    $res = mysqli_query($db, $query);
    $res = mysqli_fetch_assoc($res);
    return $res['photo'];
}

function PostToChannel($channelName, $product_title, $product_image, $product_price, $product_Desc, $productId, $data, $product_size, $Product_roast)
{
    $chat_id = $data['message']['chat']['id'];
    $message_id = $data['message']['message_id'];
    $caption = urlencode("*Subscription:*" . $product_title . "\n\n" . "*Subscription Detail:* " . $product_Desc . "\n\n" . "*Subscription period:* " . $Product_roast . "\n\n" . "*Size:* " . $product_size . "\n\n" . "*Price:* " . $product_price . "ETB" . "\n");

    $markup  = array('inline_keyboard' => array(array(array('text' => 'Buy now', 'url' => 'https://t.me/tomocatestbot?start=' . $productId, 'callback_data' => 'Buynow',))));

    $res = bot("sendPhoto?chat_id=" . $channelName . "&photo=" . $product_image . "&caption=" . $caption . "&reply_markup=" . json_encode($markup) . "&parse_mode=markdown");
}

function getAdminInput()
{
    global $db;
    $query = "SELECT * FROM products ORDER BY productId DESC LIMIT 1";;
    $res = mysqli_query($db, $query);
    $respo = mysqli_fetch_assoc($res);
    return $respo;
}

function getUserInput($UserID)
{
    global $db;
    $query = "SELECT * FROM users WHERE Id=$UserID";;
    $res = mysqli_query($db, $query);
    $respo = mysqli_fetch_assoc($res);
    return $respo;
}

function getUserInputMem($UserID)
{
    global $db;
    $query = "SELECT * FROM membership WHERE id=$UserID";;
    $res = mysqli_query($db, $query);
    $respo = mysqli_fetch_assoc($res);
    return $respo;
}

function checkMembership($UserID)
{
    global $db;
    $query = "SELECT * FROM membership WHERE id=$UserID AND step = 'MEMBER'";;
    $result = mysqli_query($db, $query);


    if (mysqli_num_rows($result) > 0) {
        // The record exists
        return false;
        echo "The record exists.";
    } else {
        return true;
        // The record does not exist
        echo "The record does not exist.";
    }
}

function getProductInfo($PID)
{
    global $db;
    $query = "SELECT * FROM products WHERE productId=$PID";;
    $res = mysqli_query($db, $query);
    $respo = mysqli_fetch_assoc($res);
    return $respo;
}

function getUserID($user_id)
{
    global $db;
    $query = "SELECT MAX(Id) FROM users WHERE UserId=$user_id";;
    $res = mysqli_query($db, $query);
    $respo = mysqli_fetch_assoc($res);
    return $respo['MAX(Id)'];
}

function getUserIDMem($user_id)
{
    global $db;
    $query = "SELECT MAX(id) FROM membership WHERE telegramID=$user_id";;
    $res = mysqli_query($db, $query);
    $respo = mysqli_fetch_assoc($res);
    return $respo['MAX(id)'];
}


function getCartIDstart($user_id)
{
    global $db;
    $query = "SELECT MIN(cartId) FROM cart WHERE UserID=$user_id";;
    $res = mysqli_query($db, $query);
    $respo = mysqli_fetch_assoc($res);
    return $respo['MIN(cartId)'];
}


function getCartIDend($user_id)
{
    global $db;
    $query = "SELECT MAX(cartId) FROM cart WHERE UserID=$user_id";;
    $res = mysqli_query($db, $query);
    $respo = mysqli_fetch_assoc($res);
    return $respo['MAX(cartId)'];
}


function getAdminID($user_id)
{
    global $db;
    $query = "SELECT MAX(productId) FROM products WHERE UserId=$user_id";;
    $res = mysqli_query($db, $query);
    $respo = mysqli_fetch_assoc($res);
    return $respo['MAX(productId)'];
}


function setphone($user_id, $phonenum)
{
    global $db;
    $query = "UPDATE users SET PhoneNum = '$phonenum' WHERE UserId=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}
function setphoneMem($user_id, $phonenum)
{
    global $db;
    $query = "UPDATE membership SET member_phone = '$phonenum' WHERE telegramID=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function SetCompletedInDB($userId, $reqtransaction_id, $Msg)
{
    global $db;
    $query1 = "UPDATE users SET TransactionId = '$reqtransaction_id' WHERE Id=$userId";;
    $query2 = "UPDATE users SET Payment = '$Msg' WHERE Id=$userId";;

    $res1 = mysqli_query($db, $query1);
    $res2 = mysqli_query($db, $query2);

    return $res2;
}

function setShop($UID, $shopLocation)
{
    $ShopName = substr($shopLocation, 3);
    global $db;
    $query = "UPDATE users SET ShopLocation = '$ShopName' WHERE UserId=$UID";;
    $res1 = mysqli_query($db, $query);
    return $res1;
}


function SendCompletedMsg($UserTgId, $userId, $reqtransaction_id, $MSG, $NextDate)
{


    $ShopInfo = GetShopLocation($MSG);

    $ShopLocationText = "TO.MO.CA. " . $MSG;

    $detailText = urlencode("
    ✅ successfully subscribed\n\nOrder Number:" . $reqtransaction_id  . "\n\nPick Up Location:" . $ShopLocationText . "\n\nUpcomming Pick up date: " . $NextDate . "\n\n" . "We appreciate you being a subscriber. " . "\n\n");

    message($UserTgId, $detailText);
}

function SendCompletedDelivery($UserTgId, $Userlocation, $reqtransaction_id, $MSG, $NextDate)
{


    $ShopInfo = GetShopLocation($MSG);

    $ShopLocationText = "TO.MO.CA. " . $MSG;

    $detailText = urlencode("
    ✅ successfully subscribed\n\nOrder Number:" . $reqtransaction_id  . "\n\nPicked Up Location:" . $ShopLocationText . "\n\nDelivery Location:" . $Userlocation . "\n\nUpcomming Delivery date: " . $NextDate . "\n\n" . "We appreciate you being a subscriber. " . "\n\n");

    message($UserTgId, $detailText);
}

function SendCompletedMembership($UserTgId, $userNames, $reqtransaction_id, $MembDate, $Passwords, $ExpDate)
{
    $detailText = urlencode("
    ✅ successfully enrolled as a member\n\nOrder Number:" . $reqtransaction_id  . "\n\nApp user name:" . $userNames . "\n\nApp temporary password:" . $Passwords . "\n\nMembership date: " . $MembDate . "\n\n" . "\n\n Expire date: " . $ExpDate . "\n\n" . "We appreciate you being a Member. " . "\n\n");

    message($UserTgId, $detailText);
}


function SendCompletedMsgDelivery($UserTgId, $reqtransaction_id, $DeliveryLink, $jobID)
{

    $detailText = urlencode("
    ✅ Order Completed Successfully\n\nOrder Number:" . $reqtransaction_id  . "\n\ndelivery tracing link:" . $DeliveryLink . "\n\nJob ID:" . $jobID . "\n\nThank you for shopping with us " . "\n\n");

    message($UserTgId, $detailText);
}

function SendNotificationMsg($UserInfo, $msg)
{
    $adminID = [5102867263, 379252630, 569205478, 2137520677];
    $linktoAdmin = "";
    $Fullname = $UserInfo['UserName'] . $UserInfo['LastName'];
    $phoneNumber = $UserInfo['PhoneNum'];
    $TotalAmount = $UserInfo['TotalAmount'];

    $shopLocation = $UserInfo['ShopLocation'];

    date_default_timezone_set("Africa/Addis_Ababa");
    $timeOrder = date("h:i");
    $dateOrder = date("Y-m-d");
    // $ShopInfo = GetShopLocation($MSG);

    // $ShopLocationText = "TO.MO.CA. " . $MSG;

    $detailText = urlencode("
    🔔" . $msg . "\n\nCustomer Name:" . $Fullname  . "\n\nPhone Number:" . $phoneNumber . "\n\nTotal Amount:" . $TotalAmount . "ETB" . "\n\n");

    message(5102867263, $detailText);

    // $Lat = floatval($ShopInfo['Lat']);
    // $longt = floatval($ShopInfo['Longt']);
    // senLocationMsg($UserTgId, $Lat, $longt);
}

function SendNotificationCustomer($UserInfo, $msg)
{
    $shopLocation = $UserInfo['ShopLocation'];
    $userID = $UserInfo['telegramId'];
    date_default_timezone_set("Africa/Addis_Ababa");


    $detailText = urlencode("
    🔔" . $msg . "\n\nShop Name:" . $shopLocation .  "\n\n");

    message($userID, $detailText);
}

function UpdateExpDate($data)
{
    $UID = $data['id'];

    global $db;
    $query = "UPDATE subscriptionlist SET sub_status = 'Ended' WHERE id=$UID";;
    $res = mysqli_query($db, $query);
    return $res;
}

function DiscardMembership($data)
{
    $UID = $data['id'];

    global $db;
    $query = "UPDATE membership SET step = 'Expired' WHERE id=$UID";;
    $res = mysqli_query($db, $query);
    return $res;
}

function sendNotificationAdmin($UserInfo, $msg)
{
    $shopLocation = $UserInfo['ShopLocation'];
    $userName = $UserInfo['sub_name'];

    date_default_timezone_set("Africa/Addis_Ababa");


    $detailText = urlencode("
    🔔" . $msg . "\n\nShop Name:" . $shopLocation .  "\n\n" . "Customer Name:" . $userName .  "\n\n");

    message(5102867263, $detailText);
}

function sendExpiredMessage($data)
{

    $detailText = urlencode("
    🔔" . "Your Membership Has Expired" . "\n\n Please update your membership" . "\n\n");

    message($data['telegramID'], $detailText);
}

function sendNoticeExpiration($data)
{

    $detailText = urlencode("
    🔔" . "Your membership expires in three days." . "\n\n Please update your membership" . "\n\n");

    message($data['telegramID'], $detailText);
}

function UpdateNextPickupdate($data)
{

    $productId = $data['product_id'];
    $MonthToAdd = '';
    global $connection;
    $query = "SELECT * FROM products WHERE 	productId= $productId";
    $res = mysqli_query($connection, $query);
    $respo = mysqli_fetch_assoc($res);

    if ($respo['delivery_option'] == 1) {
        $MonthToAdd = "+1 Weeks";
    } else if ($respo['delivery_option'] == 2) {
        $MonthToAdd = "+2 Week";
    } else if ($respo['delivery_option'] == 3) {
        $MonthToAdd = "+1 Month";
    }

    date_default_timezone_set("Africa/Addis_Ababa");
    $Today = date('Y-m-d');
    $nextDate = date('Y-m-d', strtotime($MonthToAdd));
    $query = "UPDATE subscriptionlist SET next_orderDate = '$nextDate' WHERE productId=$productId";;
    $res = mysqli_query($connection, $query);
}


function setMemberCompleted($UID, $curDate, $ExpDate)
{
    global $db;
    $query = "UPDATE membership SET Signup_Date = '$curDate', Exp_date = '$ExpDate', step = 'MEMBER'  WHERE id=$UID";;
    $res = mysqli_query($db, $query);
    return $res;
}


function setStat($userInfo)
{
    global $db;
    $cartStart = intval($userInfo['CartStart']);
    $cartEnd = intval($userInfo['CartEnd']);
    $orderNum = 0;
    $TotalCash = 0;
    $BAR = 0;
    $FAM = 0;
    $Tur = 0;
    $Beans = 0;
    $Ground = 0;

    $currentDate = date('d');
    $currentMonth = date('M');
    $currentYear = date('Y');

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

    $queryFordate = "SELECT * From dashboardstat WHERE CurrentMonth='$currentMonth' AND Currentyear='$currentYear'";;
    $response = mysqli_query($db, $queryFordate);
    $result = mysqli_fetch_assoc($response);

    if (mysqli_num_rows($response) > 0) {

        $orderNum = intval($result['OrderNum']);
        $TotalCash = intval($result['TotalCash']);
        $BAR = intval($result['BAR']);
        $FAM = intval($result['Famila']);
        $Tur = intval($result['Turkish']);
        $Beans = intval($result['Beans']);
        $Ground = intval($result['Ground']);
        $ShopLoca = json_decode($result['ShopLocation'], true);


        for ($x = $cartStart; $x <= $cartEnd; $x++) {
            $query = "SELECT * From cart WHERE cartId=$x";;
            $res = mysqli_query($db, $query);
            $res2 = mysqli_fetch_assoc($res);
            $selectedItem = GetSelection($res2['ProductId']);

            if (str_contains($selectedItem["Description"], "Beans")) {
                $Beans += intval($res2["Quantity"]);
            } elseif (str_contains($selectedItem["Description"], "Ground")) {
                $Ground += intval($res2["Quantity"]);
            }

            if (str_contains($selectedItem["Roast"], "FAMIGLIA")) {
                $FAM += intval($res2["Quantity"]);
            } elseif (str_contains($selectedItem["Roast"], "BAR")) {
                $BAR += intval($res2["Quantity"]);
            } elseif (str_contains($selectedItem["Roast"], "Turkish")) {
                $Tur += intval($res2["Quantity"]);
            }
            $orderNum += intval($res2["Quantity"]);
        }

        $TotalCash += $userInfo["TotalAmount"];
        $ShopLoca[$userInfo["ShopLocation"]] += 1;
        $ShopNum = json_encode($ShopLoca);


        $queryforUpdate = "UPDATE dashboardstat SET OrderNum = '$orderNum', TotalCash= '$TotalCash', BAR = '$BAR', Famila = '$FAM', Turkish = '$Tur', Beans = '$Beans', Ground = '$Ground', ShopLocation = '$ShopNum' WHERE CurrentMonth= '$currentMonth' AND Currentyear= '$currentYear'";;
        $response = mysqli_query($db, $queryforUpdate);
    } else {


        for ($x = $cartStart; $x <= $cartEnd; $x++) {
            $query = "SELECT * From cart WHERE cartId=$x";;
            $res = mysqli_query($db, $query);
            $res2 = mysqli_fetch_assoc($res);
            $selectedItem = GetSelection($res2['ProductId']);

            if (str_contains($selectedItem["Description"], "Beans")) {
                $Beans += intval($res2["Quantity"]);
            } elseif (str_contains($selectedItem["Description"], "Ground")) {
                $Ground += intval($res2["Quantity"]);
            }

            if (str_contains($selectedItem["Roast"], "FAMIGLIA")) {
                $FAM += intval($res2["Quantity"]);
            } elseif (str_contains($selectedItem["Roast"], "BAR")) {
                $BAR += intval($res2["Quantity"]);
            } elseif (str_contains($selectedItem["Roast"], "Turkish")) {
                $Tur += intval($res2["Quantity"]);
            }


            $orderNum += 1;
        }
        $ShopJson = '{ "Historical" : 0,
            "Office Bar": 0,
            "Galleria": 0,
            "Meet up": 0,
            "Roastery": 0,
            "Camera": 0,
            "Village": 0,
            "Blue": 0,
            "Sip and Create": 0,
            "Black and white": 0}';

        $TotalCash += $userInfo["TotalAmount"];
        $queryNewMonth  = "INSERT INTO dashboardstat(StartDate, CurrentMonth, Currentyear, OrderNum, TotalCash, BAR, Famila, Turkish, Beans, Ground, ShopLocation) VALUES ('$currentDate', '$currentMonth', '$currentYear', '$orderNum', '$TotalCash', '$BAR', '$FAM', '$Tur', '$Beans', '$Ground', '$ShopJson')";
        $response = mysqli_query($db, $queryNewMonth);
        $data = "Update State";

        $pusher->trigger('my-channel', 'Stat-Update', $data);
    }
    $data = "Update State";
    $pusher->trigger('my-channel', 'Stat-Update', $data);
}


function setProductId($user_id, $productId)
{

    global $db;
    $query = "SELECT * FROM cart WHERE ProductId='$productId' AND UserID='$user_id'";;
    $res = mysqli_query($db, $query);
    $respon = mysqli_num_rows($res);

    if (empty($respon)) {

        $query = "INSERT INTO cart(ProductId, UserID ) VALUES ('$productId', '$user_id')";
        $res = mysqli_query($db, $query);
        return $res;
    } else {
        return;
    }
}


function CheckInAddis2($latitude, $longtiude)
{

    $pointLocation = new pointLocation();
    $points = "$latitude $longtiude";
    $polygon = array(
        "9.0891421 38.8233642",
        "9.0749633 38.8265921",
        "9.0693576 38.8340498",
        "9.0750183 38.8402274",
        "9.0714460 38.8574246",
        "9.0767769 38.8745661",
        "9.0767220 38.8856413",
        "9.0470987 38.8902606",
        "9.0277516 38.9045081",
        "9.0168684 38.9047864",
        "9.0063146 38.9118545",
        "8.9687969 38.9110197",
        "8.9514959 38.8886688",
        "8.9455375 38.8701818",
        "8.9006665 38.8446245",
        "8.8848113 38.8323114",
        "8.8746838 38.8243362",
        "8.8668857 38.8206216",
        "8.8491473 38.8097590",
        "8.8449905 38.7986897",
        "8.8374493 38.7840174",
        "8.8480846 38.7726874",
        "8.8577019 38.7617049",
        "8.8666282 38.7562530",
        "8.8728774 38.7554422",
        "8.8798416 38.7503998",
        "8.8813374 38.7344948",
        "8.8883342 38.7295144",
        "8.8974682 38.7099735",
        "8.9156256 38.6973604",
        "8.9379539 38.6896995",
        "8.9442590 38.6840490",
        "8.9588956 38.6763509",
        "8.9615147 38.6700179",
        "8.9631818 38.6644915",
        "8.9664138 38.6626673",
        "8.9693639 38.6610292",
        "8.9804673 38.6666942",
        "8.9876012 38.6658432",
        "8.9945269 38.6603082",
        "9.0028553 38.6610220",
        "9.0086875 38.6646740",
        "9.0105444 38.6658984",
        "9.0173671 38.6737744",
        "9.0233756 38.6798537",
        "9.0271835 38.6837383",
        "9.0343151 38.6844061",
        "9.0382176 38.6870358",
        "9.0432192 38.6953978",
        "9.0489040 38.6960391",
        "9.0605042 38.6917804",
        "9.0668357 38.6938162",
        "9.0781561 38.7183852",
        "9.0744003 38.7253589",
        "9.0778330 38.7344999",
        "9.0765934 38.7427826",
        "9.0799512 38.7563468",
        "9.0863254 38.7635359",
        "9.0904518 38.7716308",
        "9.0915748 38.7791088",
        "9.0859599 38.7882391",
        "9.0710703 38.7906802",
        "9.0665146 38.7986840",
        "9.0813014 38.8154422",
        "9.0868036 38.8188742",
        "9.0891421 38.8233642",

    );


    $responsMsg = $pointLocation->pointInPolygon($points, $polygon);
    return $responsMsg;
}

function CheckInAddis($chat_id, $longtiude, $latitude)
{
    $addisEnd = "8.974497, 38.874520";
    $radius = 0.093660955;
    $form = "LAt, Long";
    $centerofaddisLat = 8.979597;
    $centerofaddisLong = 38.780998;
    $inputLong = floatval($longtiude);
    $inputLat = floatval($latitude);
    $x = $centerofaddisLat - $inputLat;
    $y = $centerofaddisLong - $inputLong;
    $xPow = pow($x, 2);
    $ypow = pow($y, 2);
    $val = $ypow + $xPow;
    $newRadius = sqrt($val);
    $RoundedRadius = round($newRadius, 6);

    if ($radius < $RoundedRadius) {
        $radius = 0.035407;
        $centerofaddisLat = 9.034369;
        $centerofaddisLong = 38.862393;
        $inputLong = floatval($longtiude);
        $inputLat = floatval($latitude);
        $x = $centerofaddisLat - $inputLat;
        $y = $centerofaddisLong - $inputLong;
        $xPow = pow($x, 2);
        $ypow = pow($y, 2);
        $val = $ypow + $xPow;
        $newRadius = sqrt($val);
        $RoundedRadius = round($newRadius, 6);
        if ($radius < $RoundedRadius) {
            $radius = 0.018843;
            $centerofaddisLat = 9.054946;
            $centerofaddisLong = 38.717919;
            $inputLong = floatval($longtiude);
            $inputLat = floatval($latitude);
            $x = $centerofaddisLat - $inputLat;
            $y = $centerofaddisLong - $inputLong;
            $xPow = pow($x, 2);
            $ypow = pow($y, 2);
            $val = $ypow + $xPow;
            $newRadius = sqrt($val);
            $RoundedRadius = round($newRadius, 6);
            if ($radius < $RoundedRadius) {
                message($chat_id, "Dear customer our service is not available in your location", null);
                return false;
            } elseif ($radius >= $RoundedRadius) {
                // message($chat_id, "you good to go", null);
                return true;
            }
        } elseif ($radius >= $RoundedRadius) {
            //  message($chat_id, "you good to go", null);
            return true;
        }
    } elseif ($radius >= $RoundedRadius) {
        //message($chat_id, "you good to go", null);
        return true;
    } else {
        message($chat_id, "something is wrong with your location", null);
    }
}

function setLocation($user_id, $longtiude, $latitude)
{
    global $db;

    $query1 = "UPDATE users SET longtiud = '$longtiude' WHERE UserId=$user_id";;
    $query2 = "UPDATE users SET lat = '$latitude' WHERE UserId=$user_id";;
    $res = mysqli_query($db, $query1);
    $res = mysqli_query($db, $query2);
    GetBestDistance($user_id, $longtiude, $latitude);

    // Geofence using multi polygon

    return $res;
}

function setOrder($user_id, $orderTyp)
{
    global $db;

    $query1 = "UPDATE users SET orderType = '$orderTyp' WHERE UserId=$user_id";;
    $res = mysqli_query($db, $query1);

    return $res;
}

function setTitle($user_id, $PTitle)
{
    global $db;
    $query = "UPDATE products SET Title = '$PTitle', package_Type = 'PROD' WHERE productId=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function generate_membership_id()
{
    return "TOM-" . uniqid();
}


function addMember($first_name, $Last_name, $user_id, $product_Id, $MSGID, $selectedItem)
{

    $full_name = $first_name . $Last_name;
    $selectedPrice = $selectedItem['price'];
    $genId = generate_membership_id();
    $genPassword = substr($genId, 0, 10);



    date_default_timezone_set('Africa/Addis_Ababa');
    $currentDate = new DateTime();
    $today  = $currentDate->format('Y-m-d H:i:s');
    $exp = $currentDate->modify('+6 months');
    $expDate = $exp->format('Y-m-d H:i:s');

    global $db;
    $query = "SELECT * From membership WHERE telegramID=$user_id";;
    $res = mysqli_query($db, $query);
    $res2 = mysqli_fetch_assoc($res);

    if (empty($res2)) {
        $query = "INSERT INTO membership(member_name, member_GenPassword, telegramID, total_price, product_Id) VALUES ('$full_name', '$genPassword','$user_id', '$selectedPrice', '$product_Id')";
        $res = mysqli_query($db, $query);
        if (!$res) {
            die('query failed' . mysqli_error($db));
        }
        return true;
    } else {


        // Retrieve the expiredate from the database
        $result = mysqli_query($db, "SELECT Exp_date FROM membership WHERE telegramID = $user_id AND step = 'MEMBER'");
        $row = mysqli_fetch_assoc($result);
        $expiredate = new DateTime($row['Exp_date']);

        // Get the current date
        $currentDate = new DateTime();

        // Compare the expiredate with the current date
        if ($currentDate > $expiredate) {

            $result = mysqli_query($db, "DELETE FROM membership WHERE telegramID = $user_id");
            $row = mysqli_fetch_assoc($result);
            $query = "INSERT INTO membership(member_name, member_GenPassword, telegramID, total_price, product_Id) VALUES ('$full_name', '$genPassword','$user_id', '$selectedPrice', '$product_Id')";
            $res = mysqli_query($db, $query);
            if (!$res) {
                die('query failed' . mysqli_error($db));
            }
            return true;
        } else {

            return false;
        }
    }
}

function adduser($first_name, $Last_name, $user_id, $product_Id, $MSGID, $selectedItem, $selectedType)
{
    $first_name = preg_replace('/[^a-z]/i', '', $first_name);
    $first_name == "" ? $first_name = "customer" : $first_name;
    $Last_name = preg_replace('/[^a-z]/i', '', $Last_name);
    $Last_name == "" ? $Last_name = "Unknown" : $Last_name;
    $totalSubscription = floatval($selectedItem['price']);
    $subscriptionKg = $selectedItem['size'];


    global $db;
    $query = "SELECT * From users WHERE UserId=$user_id";;
    $res = mysqli_query($db, $query);

    $res2 = mysqli_fetch_assoc($res);

    if (empty($res2)) {
        $query = "INSERT INTO users(UserName, UserId, userProductid, LastName, StartID, phase, TotalAmount, quantityHolder, createdType) VALUES ('$first_name', '$user_id', '$product_Id', '$Last_name', '$MSGID', 'true', '$totalSubscription', '$subscriptionKg', '$selectedType')";
        $res = mysqli_query($db, $query);
        if (!$res) {
            die('query failed' . mysqli_error($db));
        }
    } else {

        if ($res2['phase'] == 'true' && $res2['createdType'] == $selectedType) {
            $IdDb = $res2['Id'];
            $query = "UPDATE users SET userProductid = '$product_Id' WHERE Id=$IdDb";;
            $res = mysqli_query($db, $query);
        } else {
            $query = "INSERT INTO users(UserName, UserId, userProductid, LastName, StartID, phase, createdType) VALUES ('$first_name', '$user_id', '$product_Id', '$Last_name', '$MSGID', 'true', '$selectedType')";
            $res = mysqli_query($db, $query);
            if (!$res) {
                die('query failed' . mysqli_error($db));
            }
        }
    }
}

function adduserPurchase($first_name, $Last_name, $user_id, $product_Id, $MSGID, $selectedType)
{
    $first_name = preg_replace('/[^a-z]/i', '', $first_name);
    $first_name == "" ? $first_name = "customer" : $first_name;
    $Last_name = preg_replace('/[^a-z]/i', '', $Last_name);
    $Last_name == "" ? $Last_name = "Unknown" : $Last_name;


    global $db;
    $query = "SELECT * From users WHERE UserId=$user_id";;
    $res = mysqli_query($db, $query);

    $res2 = mysqli_fetch_assoc($res);

    if (empty($res2)) {
        $query = "INSERT INTO users(UserName, UserId, userProductid, LastName, StartID, phase, createdType) VALUES ('$first_name', '$user_id', '$product_Id', '$Last_name', '$MSGID', 'true', '$selectedType')";
        $res = mysqli_query($db, $query);
        if (!$res) {
            die('query failed' . mysqli_error($db));
        }
    } else {

        if ($res2['phase'] == 'true' && $res2['createdType'] == $selectedType) {
            $IdDb = $res2['Id'];
            $query = "UPDATE users SET userProductid = '$product_Id' WHERE Id=$IdDb";;
            $res = mysqli_query($db, $query);
        } else {
            $query = "INSERT INTO users(UserName, UserId, userProductid, LastName, StartID, phase, createdType) VALUES ('$first_name', '$user_id', '$product_Id', '$Last_name', '$MSGID', 'true', '$selectedType')";
            $res = mysqli_query($db, $query);
            if (!$res) {
                die('query failed' . mysqli_error($db));
            }
        }
    }
}

function addAdmin($user_id)
{
    global $db;
    $query = "INSERT INTO products(UserId ) VALUES ('$user_id')";
    $res = mysqli_query($db, $query);
    if (!$res) {
        die('query failed' . mysqli_error($db));
    }
}


function getSearch($user_id)
{
    global $db;
    $query = "select last_search from users WHERE user_id=" . $user_id;
    $res = mysqli_query($db, $query);
    $res = mysqli_fetch_assoc($res);
    return $res['last_search'];
}

function GetfulluserInfo($UserId)
{
    // geting user info 
    $UserInfo = getUserInput($UserId);

    // users info from DB
    $UserTgId = base64_encode(urlencode($UserInfo['UserId']));
    $UserPhoneNum = base64_encode(urlencode($UserInfo['PhoneNum']));
    $UserProductTitle = base64_encode(urlencode($UserInfo['Orders']));
    $UserProductID = base64_encode(urlencode($UserInfo['userProductid']));
    $UserProductQuantity = base64_encode(urlencode($UserInfo['quantity']));
    $UserName = base64_encode(urlencode($UserInfo['UserName']));
    $UserProductPrice = base64_encode(urlencode($UserInfo['Price']));
    $UserTotalAmount = base64_encode(urlencode($UserInfo['TotalAmount']));
    $UserLati = base64_encode(urlencode($UserInfo['lat']));
    $UserLong = base64_encode(urlencode($UserInfo['longtiud']));

    // get user product selection on product id 
    $Product_info = GetSelection($UserProductID);
    $ProductPhoto = $Product_info['photo'];
    $ProductDesc =  base64_encode(urlencode($Product_info['Description']));
    $ProductSize =  base64_encode(urlencode($Product_info['size']));

    $url = 'username=' . $UserName .
        'quantity=' . $UserProductQuantity . 'productName=' . $UserProductTitle . 'productPrice=' . $UserProductPrice .
        'totalprice=' . $UserTotalAmount . 'locatioLat=' . $UserLati . 'locatioLog=' . $UserLong . 'productDesc=' . $ProductDesc . 'size=' . $ProductSize . '';
    return $url;
}


function inline_btn($i)
{
    $ar = array();
    $button = array();
    for ($c = 0; $c < count($i); $c = $c + 2) {
        $button[$c / 2 % 2] = array("text" => urlencode($i[$c]), "callback_data" => $i[$c + 1]);
        if ($c / 2 % 2) {
            array_push($ar, array($button[0], $button[1]));
            $button = array();
        } elseif (count($i) - $c <= 2) {
            array_push($ar, array($button[0]));
            $button = array();
        }
    }
    return "&reply_markup=" . json_encode(array("inline_keyboard" => $ar));
}

function isMember($user_id, $chat_id)
{
    $status = bot("getChatMember?chat_id=" . $chat_id . "&user_id=" . $user_id);
    return $status['result']['status'];
}

function getMemberCount()
{
    global $db;
    $query = "select * from users";
    $res = mysqli_query($db, $query);
    $res = mysqli_num_rows($res);
    return $res;
}

function GetSelection($ID)
{
    global $db;
    $query = "SELECT * From products WHERE productId=$ID";;
    $res = mysqli_query($db, $query);
    $res2 = mysqli_fetch_assoc($res);
    return $res2;
}

function DownloadPic($ID)
{
    $photourl = GetSelection($ID);
    $img = '/Product/img/';
    file_put_contents($img, file_get_contents($photourl['PhotoPath']));
}

function DeletRow($userIdDb)
{

    global $db;
    $query = "DELETE FROM users WHERE Id= $userIdDb";;
    $res = mysqli_query($db, $query);
    return $res;
}

function DeletRowMem($userIdDb)
{

    global $db;
    $query = "DELETE FROM membership WHERE id= $userIdDb";;
    $res = mysqli_query($db, $query);
    return $res;
}

function DeleteCart($userIdDb)
{

    global $db;
    $query = "DELETE FROM cart WHERE cartId= $userIdDb";;
    $res = mysqli_query($db, $query);
    return $res;
}

function setSize($user_id, $PSize)
{
    global $db;
    $query = "UPDATE products SET size = '$PSize' WHERE productId=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}

function setRoast($user_id, $RoastType)
{
    global $db;
    $query = "UPDATE products SET Roast = '$RoastType' WHERE productId=$user_id";;
    $res = mysqli_query($db, $query);
    return $res;
}


function twopoints_on_earth($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
{
    $long1 = deg2rad($longitudeFrom);
    $long2 = deg2rad($longitudeTo);
    $lat1 = deg2rad($latitudeFrom);
    $lat2 = deg2rad($latitudeTo);

    //Haversine Formula
    $dlong = $long2 - $long1;
    $dlati = $lat2 - $lat1;

    $val = pow(sin($dlati / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($dlong / 2), 2);

    $res = 2 * asin(sqrt($val));

    $radius = 3958.756;

    return ($res * $radius);
}

function GetShopLocation($Shopname)
{

    global $db;
    $query = "SELECT * FROM ShopAdmin WHERE Shopname like '$Shopname'";
    $res = mysqli_query($db, $query);
    $respo = mysqli_fetch_assoc($res);
    return $respo;
}

function confirm($result)
{

    global $connection;
    if (!$result) {
        die('QUERY FAILED ' . mysqli_error($connection));
    }
}

function setLocationComment($comment, $SelectedDate, $UID)
{
    $date = new DateTime($SelectedDate, new DateTimeZone('UTC'));
    $date->setTimezone(new DateTimeZone('Africa/Addis_Ababa'));
    $selectedDate = $date->format('Y-m-d');

    global $db;
    $query = "UPDATE users SET location = '$comment', selectedDate = '$selectedDate' WHERE Id=$UID";;
    $res = mysqli_query($db, $query);
    return $res;
}

function emailUpdater($comment, $fullName, $UID)
{
    global $db;
    $query = "UPDATE membership SET email = '$comment', full_name = '$fullName' WHERE id=$UID";
    $res = mysqli_query($db, $query);
    return $res;
}

function setDatePicker($SelectedDate, $UID)
{
    $date = new DateTime($SelectedDate, new DateTimeZone('UTC'));
    $date->setTimezone(new DateTimeZone('Africa/Addis_Ababa'));
    $selectedDate = $date->format('Y-m-d');


    global $db;
    $query = "UPDATE users SET selectedDate = '$selectedDate' WHERE Id=$UID";;
    $res = mysqli_query($db, $query);
    return $res;
}


function setBusinessName($text, $UID)
{
    global $db;
    $query = "UPDATE users SET TinName = '$text' WHERE Id=$UID";;
    $res = mysqli_query($db, $query);
    return $res;
}


function setBusinessTin($text, $UID)
{
    global $db;
    $query = "UPDATE users SET TinNumber = '$text' WHERE Id=$UID";;
    $res = mysqli_query($db, $query);
    return $res;
}
