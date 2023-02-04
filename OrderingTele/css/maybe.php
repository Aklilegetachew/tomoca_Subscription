<?php

include '../functions.php';
include '../paymproc.php';
header('Content-Type:application/json; charset=utf-8');
$api = $_ENV['TELE_APIURL_PROD'];
$appkey = $_ENV['TELE_APPKEY_PROD'];
$publicKey = $_ENV['TELE_PUBLICKEY_PROD'];
$received = json_decode(file_get_contents('php://input'));

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

function sign($params)
{
    $signPars = '';
    foreach ($params as $k => $v) {
        if ($signPars == '') {
            $signPars = $k . '=' . $v;
        } else {
            $signPars = $signPars . '&' . $k . '=' . $v;
        }
    }
    $sign = [
        'sha256' => hash("sha256", $signPars),
        'values' => $signPars
    ];
    return $sign;
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
    return array($httpCode, $response);
}


if ($received->action == 'submit') {

    echo json_encode(CancelLitsener($received->Money));
}
function cancelLitsener($Money)
{
    $UserInfo = getUserInput($Money);
    $UserTotalAmount = $UserInfo['TotalAmount'];

    header('Content-Type:application/json; charset=utf-8');
    $api = $_ENV['TELE_APIURL_PROD'];
    $appkey = $_ENV['TELE_APPKEY_PROD'];
    $publicKey = $_ENV['TELE_PUBLICKEY_PROD'];



    $data = [
        'outTradeNo' => getName(10) . $Money,
        'subject' => 'Coffee Bag',
        'totalAmount' => $Money,
        'shortCode' => $_ENV['TELE_SHORTCODE_PROD'],
        'notifyUrl' => 'http://196.188.123.12:8080/TomocaBot2-CheckBack/eshi/',
        'returnUrl' => 'https://www.google.com/',
        'receiveName' => 'Tomoca Coffee',
        'appId' => $_ENV['TELE_APPID_PROD'],
        'timeoutExpress' => '30',
        'nonce' => getName(16),
        'timestamp' => getTime()
    ];
    $data['appKey'] = $appkey;
    ksort($data);

    $StringA = '';
    foreach ($data as $k => $v) {
        if ($StringA == '') {
            $StringA = $k . '=' . $v;
        } else {
            $StringA = $StringA . '&' . $k . '=' . $v;
        }
    }


    $StringB = hash("sha256", $StringA);
    $sign = strtoupper($StringB);

    $ussdjson = json_encode($data);


    $publicKey = $_ENV['TELE_PUBLICKEY_PROD'];;
    $ussd = encryptRSA($ussdjson, $publicKey);

    $appId = $_ENV['TELE_APPID_PROD'];
    $requestMessage = [
        'appid' => $appId,
        'sign' => $sign,
        'ussd' => $ussd
    ];



    // API URL
    $url = $_ENV['TELE_APIURL_PROD'];

    // Create a new cURL resource
    // $ch = curl_init($url);

    // Setup request to send json via POST
    $datam = array(
        'appid' => $appId,
        'sign' => $sign,
        'ussd' => $ussd
    );
    $payload = json_encode($datam);

    $responseArray = http_post_json($url, $payload);
    return  $responseArray;
}





	










// require 'vendor/autoload.php';
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();

// $received = json_decode(file_get_contents('php://input'));
// function encryptRSA($data, $public)
// {
//     $pubPem = chunk_split($public, 64, "\n");
//     $pubPem = "-----BEGIN PUBLIC KEY-----\n" . $pubPem . "-----END PUBLIC KEY-----\n";
//     $public_key = openssl_pkey_get_public($pubPem);
//     if (!$public_key) {
//         die('invalid public key');
//     }
//     $crypto = '';
//     foreach (str_split($data, 117) as $chunk) {
//         $return = openssl_public_encrypt($chunk, $cryptoItem, $public_key);
//         if (!$return) {
//             return ('fail');
//         }
//         $crypto .= $cryptoItem;
//     }
//     $ussd = base64_encode($crypto);
//     return $ussd;
// }
// if ($received->action == 'submit') {

//     echo json_encode(CancelLitsener($received->Money));
// }
// function cancelLitsener($Money)
// {
//     function getName($n)
//     {
//         $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//         $randomString = '';

//         for ($i = 0; $i < $n; $i++) {
//             $index = rand(0, strlen($characters) - 1);
//             $randomString .= $characters[$index];
//         }

//         return $randomString;
//     }

//     function getTime()
//     {

//         $milliseconds = round(microtime(true) / 1000);
//         return $milliseconds;
//     }
//     $appKey = 'daee4785f9f44cd7be28ed92094a3411';
//     $data = [
//         'outTradeNo' => getName(10),
//         'subject' => 'coffee',
//         'totalAmount' => $Money,
//         'shortCode' => '220175',
//         'notifyUrl' => 'http://196.188.123.12:8080/TomocaBot2-CheckBack/eshi/',
//         'returnUrl' => 'https://www.google.com/',
//         'receiveName' => 'AKERABI TRADING PLC',
//         'appId' => '4d7992fe84be4b50b51f2c0c7a488c7b',
//         'timeoutExpress' => '30',
//         'nonce' => getName(16),
//         'timestamp' => getTime()
//     ];
//     $data['appKey'] = $appKey;
//     ksort($data);

//     $StringA = '';
//     foreach ($data as $k => $v) {
//         if ($StringA == '') {
//             $StringA = $k . '=' . $v;
//         } else {
//             $StringA = $StringA . '&' . $k . '=' . $v;
//         }
//     }

//     $StringB = hash("sha256", $StringA);
//     $sign = strtoupper($StringB);

//     $ussdjson = json_encode($data);

//     $publicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEApq69qloTwa/OzpEytdPDigcvcmm0Hru1mMw38xKRIfniouCce00v/+nQmxcO+XR83fcVznPTx1+8Ir12OMCxZXRD3uUvTgMLCNg9isA1vFMiPShuQC1vWH9MKfOwRvYEdHwLsw3FnZupSCydFNah8Neh4y5N3SrEJ8F3Lsuf9WuTOuVWsLQ+QTZ9qwgEbP6rGkDYP6C71J/8QGPK1O7mPnwy5fAGmkiSxRDvjI4Dr+6+YwO3PM+/6eixwIHmgHjAyb5vdrRtCrt1Ju/4DcfE9/AtAzTOgJ6Y+RK6KEoa4HC2Hlr9z3ay+vIRS4EBmxmJacZ00tH03yr6FUT2pYomqwIDAQAB';
//     $ussd = encryptRSA($ussdjson, $publicKey);




//     $appId = '4d7992fe84be4b50b51f2c0c7a488c7b';
//     $requestMessage = [
//         'appid' => $appId,
//         'sign' => $sign,
//         'ussd' => $ussd
//     ];



    // API URL
    // $url = 'http://196.188.120.3:11443/service-openup/toTradeWebPay';

    // Create a new cURL resource
    // $ch = curl_init($url);

    // Setup request to send json via POST
    // $datam = array(
    //     'appid' => $appId,
    //     'sign' => $sign,
    //     'ussd' => $ussd
    // );
    // $payload = json_encode($datam);

    // Attach encoded JSON string to the POST fields
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // Set the content type to application/json
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json;charset=utf-8'));

    // Return response instead of outputting
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the POST request
    // $result = curl_exec($ch);


    // $res = json_encode($result);

    // Close cURL resource
    // curl_close($ch);
    // return $res;
// }
