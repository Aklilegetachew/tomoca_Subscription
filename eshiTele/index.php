<?php

include '../functions.php';
include '../paymproc.php';
include './eshiFunction.php';


$content = file_get_contents('php://input');

$publicKey = $_ENV['TELE_PUBLICKEY_PROD'];

function makeApiSignup($userInfo)
{


	$userName = $userInfo['member_name'];
	$PhoneNumber = $userInfo['member_phone'];
	$passwordGen = $userInfo['member_GenPassword'];
	$total_price = $userInfo['total_price'];
	$emails = $userInfo['email'];
	$fullName = $userInfo['full_name'];

	// API endpoint URL
	$url = 'https://example.com/api/data';

	// Data to be sent in the POST request
	$data = [
		'userName' => $userName,
		'email' => $emails,
		'fullName' => $fullName,
		'phoneNumber' => $PhoneNumber,
		'password' => $passwordGen
	];

	// Initialize cURL
	$ch = curl_init($url);

	// Set cURL options
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Execute the cURL request
	$response = curl_exec($ch);

	// Check for cURL errors
	if (curl_errno($ch)) {
		// Handle errors
	}

	// Close cURL session
	curl_close($ch);

	// Decode the JSON response
	$result = json_decode($response, true);

	// Use the result as needed

}

function returnid(array $CHARS)
{
	return implode('', array_slice($CHARS, 10));
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


$jsonnofityData['outTradeNo'] = "jsif77jf8M";

// $userId = returnid($tansactionchars);
file_put_contents("Lemlem1.txt", $userId . PHP_EOL . PHP_EOL, FILE_APPEND);

$output = implode('', array_slice(str_split($jsonnofityData['outTradeNo']), 10));

if (strpos($output, 'M') !== false) {
	echo "Output1 contains M";
	$userId = preg_replace('/[^0-9]/', '', $output);
	$UserInfos = getUserInputMem($userId);
	$OrderType = "Membership";
	$UserTgId = $UserInfo['telegramID'];
	$userNames = $UserInfo['member_name'];
	$password = $UserInfo['member_GenPassword'];
} else {
	$userId = $output;
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
}



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
	// $respo = makeApiSignup($UserInfos);
	// Get the current date in the format 'Y-m-d'
	echo "Here.." . $OrderType;
	date_default_timezone_set("Africa/Addis_Ababa");
	$MembershipDate = date('Y-m-d');

	// Add one year to the current date to get the expiration date
	$expirationDate = date('Y-m-d', strtotime('+1 year'));
	setMemberCompleted($userId, $MembershipDate, $expirationDate);
	SendCompletedMembership($UserTgId, $userNames, $orderNumber, $MembershipDate, $password, $expirationDate);
	// SendNotificationMsg($UserInfo, 'New Membership');
}


// $output1 = implode('', $userId);
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
