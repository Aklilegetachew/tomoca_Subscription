<?php

include '../functions.php';
include '../paymproc.php';
include './eshiFunction.php';


$content = file_get_contents('php://input');

$publicKey = $_ENV['TELE_PUBLICKEY_PROD'];



function returnid(array $CHARS)
{
	$IDfromUID = "";
	for ($x = 10; $x < sizeof($CHARS); $x++) {
		$IDfromUID .= $CHARS[$x];
	}
	return $IDfromUID;
}

function decryptRSA($source, $key)
{
	$pubPem = chunk_split($key, 64, "\n");
	$pubPem = "-----BEGIN PUBLIC KEY-----\n" . $pubPem . "-----END PUBLIC KEY-----\n";
	$public_key = openssl_pkey_get_public($pubPem);
	if (!$public_key) {
		die('invalid public key');
	}
	$decrypted = ''; //decode must be done before spliting for getting the binary String
	$data = str_split(base64_decode($source), 256);
	foreach ($data as $chunk) {
		$partial = ''; //be sure to match padding
		$decryptionOK = openssl_public_decrypt($chunk, $partial, $public_key, OPENSSL_PKCS1_PADDING);
		if ($decryptionOK === false) {
			die('fail');
		}
		$decrypted .= $partial;
	}
	return $decrypted;
}


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



$nofityData = decryptRSA($content, $publicKey);
$jsonnofityData = json_decode($nofityData, true);
file_put_contents("Lemlem.txt", $jsonnofityData['outTradeNo'] . PHP_EOL . PHP_EOL, FILE_APPEND);
echo '{"code":0,"msg":"success"}';

$tansactionchars = str_split($jsonnofityData['outTradeNo']);
$orderNumber = $jsonnofityData['transactionNo'];
$Amount = $jsonnofityData['totalAmount'];


$userId = returnid($tansactionchars);
file_put_contents("Lemlem1.txt", $userId . PHP_EOL . PHP_EOL, FILE_APPEND);

// $UserInfo = getUserInput($userId);
// $OrderType = $UserInfo['orderType'];
// $UserTgId = $UserInfo['UserId'];
// $MsgLast = $UserInfo['LastMsg'];
// $MsgStart = $UserInfo['StartID'];
// $PickUpLocation = $UserInfo['ShopLocation'];
// $Fullname = $UserInfo['UserName'] . $UserInfo['LastName'];

// if ($OrderType == "Pickup Order") {


// 	SetCompletedPickup($UserInfo, $Amount, $orderNumber, "payed");
// 	// deleteMessage($UserTgId, $MsgLast, $MsgStart);
// 	SendCompletedMsg($UserTgId, $userId, $orderNumber, $PickUpLocation);
// 	SendNotificationMsg($UserInfo, 'New pickup order');
// 	setStat($UserInfo);
// 	// pusher
// 	$data['message'] = 'New pickup order arrived';
// 	$data['shop'] = $PickUpLocation;
// 	$data['name'] = $Fullname;
// 	$data['Orderdate'] = date("M Y,d");
// 	$pusher->trigger('my-channel', 'my-event', $data);

// 	DeletRow($userId);
// } elseif ($OrderType == "Delivery Order") {
// 	$res = Eshiservice($userId, $UserInfo);
// 	$update = json_decode($res, true);
// 	SetCompletedDelivery($UserInfo, $Amount, $orderNumber, "payed", $update['data']['pickup_tracking_link'], $update['data']['delivery_tracing_link'], $update['data']['job_id']);
// 	SendCompletedMsgDelivery($UserTgId, $userId, $orderNumber, $update['data']['delivery_tracing_link'], $update['data']['job_id']);
// 	SendNotificationMsg($UserInfo, 'New delivery order');
// 	setStat($UserInfo);
// 	// pusher

// 	$data['message'] = 'New delivery order arrived';
// 	$data['shop'] = $PickUpLocation;
// 	$data['name'] = $Fullname;
// 	$data['Orderdate'] = date("M Y,d");
// 	$pusher->trigger('my-channel', 'my-event', $data);
// 	DeletRow($userId);
// }

// this is the subsceription edit 

$UserInfo = getUserInput($userId);
$OrderType = $UserInfo['orderType'];
$UserTgId = $UserInfo['UserId'];
$MsgLast = $UserInfo['LastMsg'];
$MsgStart = $UserInfo['StartID'];
$PickUpLocation = $UserInfo['ShopLocation'];
$Fullname = $UserInfo['UserName'] . $UserInfo['LastName'];
$productId = $UserInfo['userProductid'];
$productInfo = getProductInfo($productId);
$selectedFirstDate = $UserInfo['selectedDate'];
$Userlocation = $UserInfo['location'];

if ($OrderType == "Pickup Order") {

	SetCompletedPickup($UserInfo, $Amount, $orderNumber, $productInfo, "paid");
	deleteMessage($UserTgId, $MsgLast, $MsgStart);
	SendCompletedMsg($UserTgId, $userId, $orderNumber, $PickUpLocation, $selectedFirstDate);
	SendNotificationMsg($UserInfo, 'New Subscription');
	
} elseif ($OrderType == "Delivery Order") {
	SetCompletedDelivery($UserInfo, $Amount, $orderNumber, $productInfo, "paid");
	deleteMessage($UserTgId, $MsgLast, $MsgStart);
	SendCompletedDelivery($UserTgId, $Userlocation, $orderNumber, $PickUpLocation, $selectedFirstDate);
	SendNotificationMsg($UserInfo, 'New Subscription');
} elseif ($OrderType == "Membership") {


}
