<?php

include 'Controller/Create.php';
include 'Controller/Edit.php';
include 'Controller/Delete.php';
include 'Controller/Orders.php';
$input = file_get_contents('php://input');
$Adminupdate = json_decode($input, true);
file_put_contents("result10.json", $input . PHP_EOL . PHP_EOL, FILE_APPEND);



function Adminfunc($data)
{
  $chat_id = $data['message']['chat']['id'];
  $markup  = array('keyboard' => array(array('Create Post'), array('Orders')), 'resize_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  $ret = message($chat_id, "Welcome to Admin port to continue Select Item", $markupjs);
  file_put_contents("result3.txt", $ret . PHP_EOL . PHP_EOL, FILE_APPEND);
}

function Createfunc($data)
{
  $chat_id = $data['message']['chat']['id'];
  $markup  = array('keyboard' => array(array('Next')), 'resize_keyboard' => true, 'selective' => true);

  // $markup  = array('keyboard' => array(array('Next'), array(array('Back'), array('Cancel'))), 'resize_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  $ret = message($chat_id, "To post Product insert product name and hit Next",  $markupjs);
}

function getAdminPhoto($data)
{
  $chat_id = $data['message']['chat']['id'];
  $markup  = array('keyboard' => array(array('Next'), array('Back', 'Cancel')), 'resize_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  $ret = message($chat_id, "insert product image and hit Next", $markupjs);
}

function getAdminPrice($data)
{
  $chat_id = $data['message']['chat']['id'];
  $markup  = array('keyboard' => array(array('Next'), array('Back', 'Cancel')), 'resize_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  $ret = message($chat_id, "insert product price and hit Next", $markupjs);
}

function getproductPrice($data)
{
  $chat_id = $data['message']['chat']['id'];
  $markup  = array('keyboard' => array(array('Next'), array('Back', 'Cancel')), 'resize_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  $ret = message($chat_id, "insert product type and hit Next", $markupjs);
}

function getpost($data)
{
  $ChannelName = "@TomTomChan";
  $user_id = $data['message']['user']['id'];
  $chat_id = $data['message']['chat']['id'];
  $markup  = array('keyboard' => array(array('Post'), array('Back', 'Cancel')), 'resize_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  $ret = message($chat_id, "Sucessfull!", $markupjs);
}

function postProduct($data)
{
  $ChannelName = "@TomTomChan";
  $chat_id = $data['message']['chat']['id'];
  $PostItem = getAdminInput();
  $product_title = $PostItem['Title'];
  $product_image = $PostItem['photo'];
  $product_price = $PostItem['price'];
  $product_size = $PostItem['size'];
  $product_Desc = $PostItem['Description'];
  $product_Id = $PostItem['productId'];
  $product_Roast = $PostItem['Roast'];

  PostToChannel($ChannelName, $product_title, $product_image, $product_price, $product_Desc, $product_Id, $data, $product_size, $product_Roast);
}

function goingBack($data)
{
  $chat_id = $data['message']['chat']['id'];
  $markup  = array('keyboard' => array(array('Go back')), 'resize_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  $ret = message($chat_id, "Press the button to go back to the menu", $markupjs);
}

function SizeInput($data)
{
  $ChannelName = "@TomTomChan";
  $user_id = $data['message']['user']['id'];
  $chat_id = $data['message']['chat']['id'];
  $markup  = array('keyboard' => array(array('Next'), array('Back', 'Cancel')), 'resize_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  $ret = message($chat_id, "Input product size", $markupjs);
}

function RosteInput($data)
{

  $user_id = $data['message']['user']['id'];
  $chat_id = $data['message']['chat']['id'];
  $markup  = array('keyboard' => array(array('Next'), array('Back', 'Cancel')), 'resize_keyboard' => true, 'selective' => true);
  $markupjs = json_encode($markup);
  $ret = message($chat_id, "insert Roast type and hit Next", $markupjs);
}
