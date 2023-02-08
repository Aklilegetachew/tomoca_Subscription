<?php

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

function Eshiservice($UserInfo)
{

  $UserPhoneNum = $UserInfo['sub_phone'];

  $userFullName = $UserInfo['sub_name'];

  $UserLati = $UserInfo['lat'];
  $UserLong = $UserInfo['longt'];
  $LocationComment = $UserInfo['localtion'];
  $ShopLocation = $UserInfo['ShopLocation'];

  $response = GetShopLocation($ShopLocation);
  $ShopLong = $response['Longt'];
  $ShopLat = $response['Lat'];
  $ShopAdress = $response['Location'];
  $ShopPhone = $response['PhoneNumber'];

  $ProductNum = $UserInfo['NumProducts'];
  $Todaydate = date("Y-m-d H:i:s");
  $expressTime = date("Y-m-d H:i:s", strtotime('+1:30 hours'));

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, "https://api.tookanapp.com/v2/create_task");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);

  curl_setopt($ch, CURLOPT_POST, TRUE);

  // $_ENV['ESHI_APIKEY_PROD'];
  $ap = $_ENV['ESHI_APIKEY_PROD'];
  curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"api_key\": \"$ap\",
  \"order_id\": \"203040\",
  \"team_id\": \"\",
  \"auto_assignment\": \"0\",
  \"job_description\": \"Soft launch tomoca\",
  \"job_pickup_phone\": \"$ShopPhone\",
  \"job_pickup_name\": \"Soft launch Tomoca\",
  \"job_pickup_email\": \"\",
  \"job_pickup_address\": \"$ShopAdress\",
  \"job_pickup_latitude\": \"$ShopLat\",
  \"job_pickup_longitude\": \"$ShopLong\",
  \"job_pickup_datetime\": \"$Todaydate\",
  \"customer_email\": \"\", 
  \"customer_username\": \"$userFullName\",
  \"customer_phone\": \"$UserPhoneNum\",
  \"customer_address\": \"$LocationComment\",
  \"latitude\": \"$UserLati\",
  \"longitude\": \"$UserLong\",
  \"job_delivery_datetime\": \"$expressTime\",
  \"has_pickup\": \"1\",
  \"has_delivery\": \"1\",
  \"layout_type\": \"0\",
  \"tracking_link\": 1,
  \"timezone\": \"-180\",
  \"custom_field_template\": \"Template_1\",
  \"meta_data\": [],
  \"pickup_custom_field_template\": \"Template_2\",
  \"pickup_meta_data\": [
    {
      \"label\": \"Quantity\",
      \"data\": \"$ProductNum\"
    }
  ],
  \"fleet_id\": \"\",
  \"p_ref_images\": [
    \"https://i.ebayimg.com/images/g/wUUAAOSwpwxg0fce/s-l300.png\"
  ],
  \"ref_images\": [
    \"http://tookanapp.com/wp-content/uploads/2015/11/logo_dark.png\"
  ],
  \"notify\": 1,
  \"tags\": \"\",
  \"geofence\": 0,
  \"ride_type\": 0
}");

  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json"
  ));

  $response = curl_exec($ch);
  curl_close($ch);

  var_dump($response);
  return $response;
}
