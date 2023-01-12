<?php


include '../functions.php';
include '../paymproc.php';
include './eshiFunction.php';
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



$cybsResponse = $_REQUEST;
$Response = json_encode($cybsResponse);
// // $Response2 = json_decode($input);
$jsonl = json_decode($Response, true);
$decision = $jsonl["decision"];
$reason = $jsonl["reason_code"];
$orderCode = $jsonl["req_reference_number"];
$reqtransaction_id = $jsonl["req_transaction_uuid"];
$Amount = $jsonl["auth_amount"];
$tansactionchars = str_split($reqtransaction_id);

function returnid(array $CHARS)
{
    $IDfromUID = "";
    for ($x = 13; $x <= sizeof($CHARS); $x++) {
        $IDfromUID .= $CHARS[$x];
    }
    return $IDfromUID;
}

if ($decision == "ACCEPT" && $reason == "100") {
    echo "sucsses" . returnid($tansactionchars);
    $userId = returnid($tansactionchars);
    $UserInfo = getUserInput($userId);
    $OrderType = $UserInfo['orderType'];
    $Fullname = $UserInfo['UserName'] . $UserInfo['LastName'];
    $UserTgId = $UserInfo['UserId'];
    $MsgLast = $UserInfo['LastMsg'];
    $MsgStart = $UserInfo['StartID'];
    $PickUpLocation = $UserInfo['ShopLocation'];

    if ($OrderType == "Pickup Order") {

        SetCompletedPickup($UserInfo, $Amount, $orderCode, "payed");
        // deleteMessage($UserTgId, $MsgLast, $MsgStart);
        SendCompletedMsg($UserTgId, $userId, $orderCode, $PickUpLocation);
        SendNotificationMsg($UserInfo, 'New pickup order');
        // pusher
        $data['message'] = 'New pickup order arrived';
        $data['shop'] = $PickUpLocation;
        $data['name'] = $Fullname;
        $data['Orderdate'] = date("M Y,d");
        $pusher->trigger('my-channel', 'my-event', $data);

        DeletRow($userId);
    } elseif ($OrderType == "Delivery Order") {
        $res = Eshiservice($userId, $UserInfo);
        $update = json_decode($res, true);
        // deleteMessage($UserTgId, $MsgLast, $MsgStart);
        // SetCompletedPickup($UserInfo, $Amount, $orderCode, "payed");
        SetCompletedDelivery($UserInfo, $Amount, $orderCode, "payed", $update['data']['pickup_tracking_link'], $update['data']['delivery_tracing_link']);
        SendCompletedMsgDelivery($UserTgId, $userId, $reqtransaction_id, $update['data']['delivery_tracing_link']);
        SendNotificationMsg($UserInfo, 'New delivery order');
        // pusher
        $data['message'] = 'New delivery order arrived';
        $data['shop'] = $PickUpLocation;
        $data['name'] = $Fullname;
        $data['Orderdate'] = date("M Y,d");
        $pusher->trigger('my-channel', 'my-event', $data);
        DeletRow($userId);
    }
} elseif ($reason == "481") {
    echo "held";
} else {
    echo "operation failed";
}
