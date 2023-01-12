<?php
// 5a6b628cf9465c011e42277a431525401eedc7fc23d57e3c551c05

function Eshiservice($userId, $UserInfo)
{
  $UserTgId = $UserInfo['UserId'];
  $UserPhoneNum = $UserInfo['PhoneNum'];
  $UserName = $UserInfo['UserName'];
  $LastName = $UserInfo['LastName'];
  $UserLati = $UserInfo['lat'];
  $UserLong = $UserInfo['longtiud'];
  $ShopLocation = $UserInfo['ShopLocation'];
  $UserOrderType = $UserInfo['orderType'];
  $startMsg = $UserInfo['StartID'];
  $LastMsg = $UserInfo['LastMsg'];
  $CartStart = intval($UserInfo['CartStart']);
  $CartEnd = intval($UserInfo['CartEnd']);
  $ProductNum = $UserInfo['NumProducts'];
  $dateIn = date("Y-m-d H:i:s");;
  $time = date("h:i:s");

  $Todaydate = date("Y-m-d H:i:s");
  $date = date_create("$Todaydate");
  date_add($date, date_interval_create_from_date_string("2 days"));
  $NextDay = date_format($date, "Y-m-d H:i:s");
  $ap = $_ENV['ESHI_APIKEY_PROD'];
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, "https://api.tookanapp.com/v2/create_task");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, FALSE);

  curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "{
  \"api_key\": \"$ap\",
  \"order_id\": \"654321\",
  \"team_id\": \"\",
  \"auto_assignment\": \"0\",
  \"job_description\": \"Test\",
  \"job_pickup_phone\": \"+251922749861\",
  \"job_pickup_name\": \"Tomoca Test\",
  \"job_pickup_email\": \"\",
  \"job_pickup_address\": \"Addis ababa\",
  \"job_pickup_latitude\": \"9.035384646799638\",
  \"job_pickup_longitude\": \"38.75016115555852\",
  \"job_pickup_datetime\": \"$Todaydate\",
  \"customer_email\": \"\",
  \"customer_username\": \"\",
  \"customer_phone\": \"$UserPhoneNum\",
  \"customer_address\": \"dembel\",
  \"latitude\": \"$UserLati\",
  \"longitude\": \"$UserLong\",
  \"job_delivery_datetime\": \"$NextDay\",
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
