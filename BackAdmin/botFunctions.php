<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/config/');
$dotenv->load();



require_once './config/db.php';

// define('API_TOKEN', '5270072990:AAFYNg9m3lZ1IXITw9s9rB5ExLxfr1ypjzo');

function bot($data)
{
    return json_decode(file_get_contents("https://api.telegram.org/bot" . $_ENV['BOTAPI_KEY'] . "/" . $data), true);
}
function sendMessage($chat_id, $msg, $markup = null)
{
    if ($markup != null) {
        return json_encode(bot("sendMessage?chat_id=" . $chat_id . "&text=" . $msg . "&reply_markup=" . $markup));
    } else {
        return json_encode(bot("sendMessage?chat_id=" . $chat_id . "&text=" . $msg));
    }
}

function Postphoto($PostItem)
{
    $subscription_title = $PostItem['Title'];
    $image_path = $PostItem['photo'];
    $subscription_price = $PostItem['price'];
    $subscription_size = $PostItem['size'];
    $subscription_Desc = $PostItem['Description'];
    $subscription_Id = $PostItem['productId'];
    $subscription_Period = $PostItem['subscription_period'];
    $deliveryMode = "";
    $delivery_option = $PostItem['delivery_option'];

    if ($delivery_option == "1") {
        $deliveryMode = "Per Week";
    } else if ($delivery_option == "2") {
        $deliveryMode = "Bi Week";
    } else {
        $deliveryMode = "Every Month";
    }


    $chat_id = $_ENV['ADMIN_CHAT_ID'];
    $channelName = $_ENV['CHANAEL_NAME'];

    $caption = urlencode("*Subscription:*" . $subscription_title . "\n\n" . "*Subscription Detail:* " . $subscription_Desc . "\n\n" . "*Subscription period:* " . $subscription_Period . " Months" . "\n\n" . "*Size:* " . $subscription_size . "*Delivery Mode:* " . $deliveryMode . "\n\n" . "*Price:* " . $subscription_price . "ETB" . "\n");

    $markup  = array('inline_keyboard' => array(array(array('text' => 'Buy now', 'url' => 'https://t.me/tomocatestbot?start=' . $subscription_Id, 'callback_data' => 'Buynow',))));

    $res = bot("sendPhoto?chat_id=" . $channelName . "&photo=" . $image_path . "&caption=" . $caption . "&reply_markup=" . json_encode($markup) . "&parse_mode=markdown");
}
