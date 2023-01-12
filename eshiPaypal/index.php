<?php

include '../functions.php';
include '../paymproc.php';
include './eshiFunction.php';

require '../vendor/autoload.php';


$cybsResponse = $_REQUEST;
$Response = json_encode($cybsResponse);
file_put_contents("Request.txt", $cybsResponse['txn_id'] . PHP_EOL . PHP_EOL, FILE_APPEND);

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
// $jsonl = json_decode($Response, true);
// $decision = $jsonl["decision"];
// $reason = $jsonl["reason_code"];
// $orderCode = $jsonl["req_reference_number"];
// $reqtransaction_id = $jsonl["req_transaction_uuid"];
// $tansactionchars = str_split($reqtransaction_id);

function returnid(array $CHARS)
{
    $IDfromUID = "";
    for ($x = 13; $x <= sizeof($CHARS); $x++) {
        $IDfromUID .= $CHARS[$x];
    }
    return $IDfromUID;
}

if ($cybsResponse['payment_status'] == "Completed") {
    // echo "sucsses" . returnid($tansactionchars);
    $userId = $cybsResponse['item_number1'];
    $UserInfo = getUserInput($userId);
    $Fullname = $UserInfo['UserName'] . $UserInfo['LastName'];
    $OrderType = $UserInfo['orderType'];
    $UserTgId = $UserInfo['UserId'];
    $MsgLast = $UserInfo['LastMsg'];
    $MsgStart = $UserInfo['StartID'];
    $PickUpLocation = $UserInfo['ShopLocation'];
    $orderCode = $cybsResponse['txn_id'];
    $Amount = $cybsResponse['mc_gross'];

    if ($OrderType == "Pickup Order") {


        
        SetCompletedPickup($UserInfo, $Amount, $orderCode, "payed");
        // deleteMessage($UserTgId, $MsgLast, $MsgStart);
        SendCompletedMsg($UserTgId, $userId, $orderCode, $PickUpLocation);
        
        $data['message'] = 'new Pickup Order arrived';
        $data['shop'] = $PickUpLocation;
        $data['name'] = $Fullname;
        $data['Orderdate'] = date("M Y,d");
        $pusher->trigger('my-channel', 'my-event', $data);

        DeletRow($userId);
    } elseif ($OrderType == "Delivery Order") {
        $res = Eshiservice($userId, $UserInfo);
        deleteMessage($UserTgId, $MsgLast, $MsgStart);
        SendCompletedMsg($UserTgId, $userId, $res, "DONE");

        // Pusher Notification
        $data['message'] = 'new Pickup Order arrived';
        $data['shop'] = $PickUpLocation;
        $data['name'] = $Fullname;
        $data['Orderdate'] = date("M Y,d");
        $pusher->trigger('my-channel', 'my-event', $data);
    }
} else {
}


// elseif ($reason == "481") {
//     echo "held";
// } else {
//     echo "operation failed";
// }


// if ($Response['payment_status']== "Completed"){

// }