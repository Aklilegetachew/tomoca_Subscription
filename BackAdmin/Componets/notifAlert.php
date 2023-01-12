<?php

require '../config/db.php';
session_start();

function getshopNotification()
{
    global $connection;
    $Inout = array();
    $loggedShop = "Historical";

    $query = "SELECT * FROM notificatione WHERE ShopLocation = '$loggedShop'";
    $res = mysqli_query($connection, $query);
    while ($res2 = mysqli_fetch_assoc($res)) {
        $Inout[] = $res2;
    }

    return $Inout;
}


function getshopNotificationAll()
{
    global $connection;
    $Inout = array();
    $loggedShop = "Historical";

    $query = "SELECT * FROM notificatione ";
    $res = mysqli_query($connection, $query);
    while ($res2 = mysqli_fetch_assoc($res)) {
        $Inout[] = $res2;
    }

    return $Inout;
}



$locationUrl = '#';
$ShopName = $_POST["shopName"];
$dateOrder = $_POST["Orderday"];
$newOrder = $_POST["NewOrder"];
$CustomerName = $_POST["name"];

if ($newOrder == "New pickup order arrived") {

    $locationUrl = "./PickOrder.php";
} else {
    $locationUrl = "./DeliveryOrder.php";
}



if ($_SESSION['shopname'] == "Central") {

    echo   '<a class="dropdown-item d-flex align-items-center" href="' . $locationUrl . '">
    <div class="mr-3">
        <div class="icon-circle bg-primary">
            <i class="fas fa-bell fa-fw text-white"></i>
        </div>
    </div>
    <div>
        <div class="small text-gray-500" id="notifyday">';
    echo  $dateOrder;
    echo ' </div>
        <span class="font-weight-bold" id="notifyMsg">';

    echo  $newOrder;
    echo '</span>
        <div class="text-gray-500" id="notifytype">';

    echo  $ShopName;
    echo '</div>
    </div>
</a>';
} else {

    echo   '<a class="dropdown-item d-flex align-items-center" href="' . $locationUrl . '">
    <div class="mr-3">
        <div class="icon-circle bg-primary">
            <i class="fas fa-bell fa-fw text-white"></i>
        </div>
    </div>
    <div>
        <div class="small text-gray-500" id="notifyday">';
    echo  $dateOrder;
    echo ' </div>
        <span class="font-weight-bold" id="notifyMsg">';

    echo  $newOrder;
    echo '</span>
        <div class="text-gray-500" id="notifytype">';

    echo  $CustomerName;
    echo '</div>
    </div>
</a>';
}
