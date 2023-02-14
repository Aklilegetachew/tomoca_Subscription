<?php

include '../mainFunctions.php';
include '../paymproc.php';
header('Content-Type:application/json; charset=utf-8');
$received = json_decode(file_get_contents('php://input'));

function http_post_json($url, $jsonStr)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($jsonStr)
        )
    );
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array($httpCode, $response, $jsonStr);
}


function encryptRSA($data, $public)
{
    $pubPem = chunk_split($public, 64, "\n");
    $pubPem = "-----BEGIN PUBLIC KEY-----\n" . $pubPem . "-----END PUBLIC KEY-----\n";
    $public_key = openssl_pkey_get_public($pubPem);
    if (!$public_key) {
        die('invalid public key');
    }
    $crypto = '';
    foreach (str_split($data, 117) as $chunk) {
        $return = openssl_public_encrypt($chunk, $cryptoItem, $public_key);
        if (!$return) {
            return ('fail');
        }
        $crypto .= $cryptoItem;
    }
    $ussd = base64_encode($crypto);
    return $ussd;
}

function getName($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

function getTime()
{

    $milliseconds = round(microtime(true) / 1000);
    return $milliseconds;
}
//'http://196.188.123.12:8080/TomocaBot2/eshiTele/'
// https://www.versavvymedia.com/tomocaBot/eshiTele

if ($received->action == 'submit') {

    echo json_encode(CancelLitsener($received->Money));
}
function cancelLitsener($Money)
{
    $UserInfo = getUserInput($Money);
    $UserTotalAmount = $UserInfo['TotalAmount'];
    if ($UserInfo['createdType'] == 'SUB') {
        // for Subescription
        $outTradeNum = getName(10) . $Money . 'S';
    } else {
        // for purchase
        $outTradeNum = getName(10) . $Money . 'P';
    }
    // http://196.188.123.12:8080/TomocaBot2/eshiTele/

    $appKey = $_ENV['TELE_APPKEY_PROD'];;
    $data = [
        'outTradeNo' => $outTradeNum,
        'subject' => 'coffee',
        'totalAmount' => $UserTotalAmount,
        'shortCode' =>  $_ENV['TELE_SHORTCODE_PROD'],
        'notifyUrl' => 'https://www.versavvymedia.com/tomocaBot/eshiTele/',
        'returnApp' => 'https://t.me/TomTomChan',
        'receiveName' => 'Tomoca Coffee',
        'appId' => $_ENV['TELE_APPID_PROD'],
        'timeoutExpress' => '30',
        'nonce' => getName(16),
        'timestamp' => getTime()
    ];
    $ussdjson = json_encode($data);
    $publicKey =  $_ENV['TELE_PUBLICKEY_PROD'];
    $ussd = encryptRSA($ussdjson, $publicKey);

    $data['appKey'] = $appKey;
    ksort($data);

    $StringA = '';
    foreach ($data as $k => $v) {
        if ($StringA == '') {
            $StringA = $k . '=' . $v;
        } else {
            $StringA = $StringA . '&' . $k . '=' . $v;
        }
    }
    // echo $StringA . "\n\n";


    $StringB = hash("sha256", $StringA);
    $sign = strtoupper($StringB);






    $appId = $_ENV['TELE_APPID_PROD'];
    $requestMessage = [
        'appid' => $appId,
        'sign' => $sign,
        'ussd' => $ussd
    ];





    $api = $_ENV['TELE_APIURLSDK_PROD'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api);



    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_POST, TRUE);

    // curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestMessage));

    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array('Content-Type:application/json;charset=utf-8')
    );
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    list($returnCode, $returnContent) = array($httpCode, $response);

    $a["stringA"] = $StringA;
    $a["ussdjson"] = $ussdjson;
    $a["res"] = $response;
    $a["lastreq"] = json_encode($requestMessage);



    // $a["step1"] = $step;


    return $response;

    // if ($returnCode == 200) {
    //     $rsp = json_decode($returnContent, true);
    //     header('location:' . $rsp['data']['toPayUrl']);
    // } else {
    //     echo 'Fail:' . $returnCode . '   ' . $sign['values'];
    // }


    // Attach encoded JSON string to the POST fields
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // // Set the content type to application/json
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json;charset=utf-8'));

    // // Return response instead of outputting
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // // Execute the POST request
    // $result = curl_exec($ch);


    // $res = json_encode($result);

    // // Close cURL resource
    // curl_close($ch);

    // $a["stringA"] = $StringA;
    // $a["ussdjson"] = $ussdjson;
    // $a["res"] = $res;

    // return $res;
}
