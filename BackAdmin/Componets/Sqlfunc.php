<?php

include './config/db.php';

function SetCompleted($detail)
{
    global $connection;
    $UserID = $detail['UserID'];
    $FirstName = $detail['FirstName'];
    $LastName = $detail['LastName'];
    $CartStart = $detail['CartStart'];
    $CartEnd = $detail['CartEnd'];
    $TotalAmount = $detail['TotalAmount'];
    $NumProduct = $detail['NumProduct'];
    $TransactionID = $detail['TransactionID'];
    $PhoneNumber = $detail['PhoneNumber'];
    $ShopLocation = $detail['ShopLocation'];
    // $cartStart = $detail['CartStart'];
    // $cartEnd = $detail['CartEnd'];

    $query = "INSERT INTO pickupcompleted(FirstName, LastName, PhonNumber, Total, CartStart, CartEnd, OrderNumber, Shop, NumProduct)
     VALUES ('$FirstName', '$LastName', '$PhoneNumber', '$TotalAmount', '$CartStart', '$CartEnd', '$TransactionID', '$ShopLocation', '$NumProduct')";
    $res = mysqli_query($connection, $query);
}

function deleteRow($detail)
{
    global $connection;
    $UserID = $detail['ID'];

    $query = "DELETE FROM pickuppayed WHERE Id= $UserID";;
    $res = mysqli_query($connection, $query);
    return $res;
}

function deleteRowCompleted($detail)
{
    global $connection;
    $UserID = $detail['Id'];

    $query = "DELETE FROM pickupcompleted WHERE Id= $UserID";;
    $res = mysqli_query($connection, $query);
    return $res;
}

function deleteRowCompletedDel($detail)
{
    global $connection;
    $UserID = $detail['ID'];

    $query = "DELETE FROM completeddelivery WHERE ID= $UserID";;
    $res = mysqli_query($connection, $query);
    return $res;
}


function getDeliveryOrders($role, $location)
{
    global $connection;
    $Inout = array();

    if ($role == "SuperAdmin") {
        $query = "SELECT * From deliveryorders";
        $res = mysqli_query($connection, $query);
        $respon = mysqli_num_rows($res);


        while ($res2 = mysqli_fetch_assoc($res)) {
            $Inout[] = $res2;
        }

        return $Inout;
    } else {
        $query = "SELECT * From deliveryorders WHERE ShopLocation = '$location'";
        $res = mysqli_query($connection, $query);
        $respon = mysqli_num_rows($res);


        while ($res2 = mysqli_fetch_assoc($res)) {
            $Inout[] = $res2;
        }

        return $Inout;
    }
}


function getDeliveryPickedOrders($role, $location)
{
    global $connection;
    $Inout = array();

    if ($role == "SuperAdmin") {
        $query = "SELECT * From deliverypickedup";
        $res = mysqli_query($connection, $query);
        $respon = mysqli_num_rows($res);


        while ($res2 = mysqli_fetch_assoc($res)) {
            $Inout[] = $res2;
        }

        return $Inout;
    } else {
        $query = "SELECT * From deliverypickedup WHERE ShopLocation = '$location'";
        $res = mysqli_query($connection, $query);
        $respon = mysqli_num_rows($res);


        while ($res2 = mysqli_fetch_assoc($res)) {
            $Inout[] = $res2;
        }

        return $Inout;
    }
}


function getPickupOrders($role, $location)
{
    global $connection;
    $Inout = array();

    if ($role == "SuperAdmin") {
        $query = "SELECT * From pickuppayed ";
        $res = mysqli_query($connection, $query);
        $respon = mysqli_num_rows($res);


        while ($res2 = mysqli_fetch_assoc($res)) {
            $Inout[] = $res2;
        }

        return $Inout;
    } else {
        $query = "SELECT * From pickuppayed WHERE ShopLocation = '$location'";
        $res = mysqli_query($connection, $query);
        $respon = mysqli_num_rows($res);


        while ($res2 = mysqli_fetch_assoc($res)) {
            $Inout[] = $res2;
        }

        return $Inout;
    }
}


function getDeliveryCompleted($role, $location)
{
    global $connection;
    $Inout = array();

    if ($role == "SuperAdmin") {
        $query = "SELECT * From completeddelivery";
        $res = mysqli_query($connection, $query);
        while ($res2 = mysqli_fetch_assoc($res)) {
            $Inout[] = $res2;
        }

        return $Inout;
    } else {
        $query = "SELECT * From completeddelivery WHERE ShopLocation = '$location'";
        $res = mysqli_query($connection, $query);
        $respon = mysqli_num_rows($res);


        while ($res2 = mysqli_fetch_assoc($res)) {
            $Inout[] = $res2;
        }

        return $Inout;
    }
}





function getPickupOrdersCompleted($role, $location)
{
    global $connection;
    $Inout = array();

    if ($role == "SuperAdmin") {
        $query = "SELECT * From pickupcompleted";
        $res = mysqli_query($connection, $query);
        while ($res2 = mysqli_fetch_assoc($res)) {
            $Inout[] = $res2;
        }

        return $Inout;
    } else {
        $query = "SELECT * From pickupcompleted WHERE Shop = '$location'";
        $res = mysqli_query($connection, $query);
        $respon = mysqli_num_rows($res);


        while ($res2 = mysqli_fetch_assoc($res)) {
            $Inout[] = $res2;
        }

        return $Inout;
    }
}

function getUserInputAdmin($UseID)
{
    global $connection;
    $query = "SELECT * FROM pickuppayed WHERE ID = '$UseID'";
    $res = mysqli_query($connection, $query);
    $res2 = mysqli_fetch_assoc($res);
    $respo = array();

    return $res2;
}

function getUserInfo($UseID)
{
    global $connection;
    $query = "SELECT * FROM subscriptionlist WHERE id = '$UseID'";
    $res = mysqli_query($connection, $query);
    $res2 = mysqli_fetch_assoc($res);
    $respo = array();

    return $res2;
}


function getProductInfo($UseID)
{
    global $connection;
    $query = "SELECT * FROM products WHERE productId = '$UseID'";
    $res = mysqli_query($connection, $query);
    $res2 = mysqli_fetch_assoc($res);
    $respo = array();

    return $res2;
}

function getUserInputPickupCompleted($UseID)
{
    global $connection;
    $query = "SELECT * FROM pickupcompleted WHERE Id = '$UseID'";
    $res = mysqli_query($connection, $query);
    $res2 = mysqli_fetch_assoc($res);
    $respo = array();

    return $res2;
}

function getUserInputDelivery($UseID)
{
    global $connection;
    $query = "SELECT * FROM deliveryorders WHERE ID = '$UseID'";
    $res = mysqli_query($connection, $query);
    $res2 = mysqli_fetch_assoc($res);
    $respo = array();

    return $res2;
}

function getUserInputDeliveryPicked($UseID)
{
    global $connection;
    $query = "SELECT * FROM deliverypickedup WHERE ID = '$UseID'";
    $res = mysqli_query($connection, $query);
    $res2 = mysqli_fetch_assoc($res);
    $respo = array();

    return $res2;
}


function getUserInputDeliveryCompleted($UseID)
{
    global $connection;
    $query = "SELECT * FROM completeddelivery WHERE ID = '$UseID'";
    $res = mysqli_query($connection, $query);
    $res2 = mysqli_fetch_assoc($res);
    $respo = array();

    return $res2;
}




function GetSelectionAdmin($ID)
{
    global $connection;
    $query = "SELECT * From products WHERE productId = '$ID'";
    $res = mysqli_query($connection, $query);
    $res2 = mysqli_fetch_assoc($res);

    return $res2;
}



// delivery

function SetCompletedDel($detail)
{
    date_default_timezone_set("Africa/Addis_Ababa");
    $timeOrder = date("h:i a");
    $dateOrder = date("Y-m-d");

    global $connection;
    $UserID = $detail['UserID'];
    $FirstName = $detail['FirstName'];
    $LastName = $detail['LastName'];
    $CartStart = $detail['CartStart'];
    $CartEnd = $detail['CartEnd'];
    $TotalAmount = $detail['Total'];
    $NumProduct = $detail['Quantity'];
    $TransactionID = $detail['OrderNumber'];
    $PhoneNumber = $detail['PhoneNumber'];
    $ShopLocation = $detail['ShopLocation'];
    $pickupurl = $detail['Pickupurl'];
    $Deliveryurl = $detail['DeliveryUrl'];
    $TinName = $detail['TinName'];
    $TinNumber = $detail['TinNumber'];
    $deliveryID = $detail['DeliveryID'];


    $query = "INSERT INTO deliverypickedup(FirstName, LastName, PhoneNumber, Total, CartStart, CartEnd, OrderNumber, Pickupurl, Quantity, DeliveryUrl, ShopLocation, Status, TinName, TinNumber, DeliveryID, pickedDate, pickedTime)
     VALUES ('$FirstName', '$LastName', '$PhoneNumber', '$TotalAmount', '$CartStart', '$CartEnd', '$TransactionID', '$pickupurl', '$NumProduct', '$Deliveryurl', '$ShopLocation', 'Unconfirmed', '$TinName', '$TinNumber', '$deliveryID', '$dateOrder', '$timeOrder')";
    $res = mysqli_query($connection, $query);
}


function deleteRowDel($detail)
{
    global $connection;
    $UserID = $detail['ID'];

    $query = "DELETE FROM deliveryorders WHERE ID= $UserID";;
    $res = mysqli_query($connection, $query);
    return $res;
}


function SetCompletedDelPic($detail)
{
    date_default_timezone_set("Africa/Addis_Ababa");
    $timeOrder = date("h:i a");
    $dateOrder = date("Y-m-d");

    global $connection;
    $UserID = $detail['UserID'];
    $FirstName = $detail['FirstName'];
    $LastName = $detail['LastName'];
    $CartStart = $detail['CartStart'];
    $CartEnd = $detail['CartEnd'];
    $TotalAmount = $detail['Total'];
    $NumProduct = $detail['Quantity'];
    $TransactionID = $detail['OrderNumber'];
    $PhoneNumber = $detail['PhoneNumber'];
    $ShopLocation = $detail['ShopLocation'];
    $pickupurl = $detail['Pickupurl'];
    $Deliveryurl = $detail['DeliveryUrl'];
    $Confirmdate = $detail['Confirmdate'];
    $TinName = $detail['TinName'];
    $TinNumber = $detail['TinNumber'];
    $deliveryID = $detail['DeliveryID'];


    $query = "INSERT INTO completeddelivery(FirstName, LastName, PhoneNumber, Total, CartStart, CartEnd, OrderNumber, Pickupurl, Quantity, DeliveryUrl, ShopLocation, Confirmdate, TinName, TinNumber, DeliveryID, completedTime)
     VALUES ('$FirstName', '$LastName', '$PhoneNumber', '$TotalAmount', '$CartStart', '$CartEnd', '$TransactionID', '$pickupurl', '$NumProduct', '$Deliveryurl', '$ShopLocation', '$Confirmdate', '$TinName', '$TinNumber', '$deliveryID', '$timeOrder')";
    $res = mysqli_query($connection, $query);
}


function deleteRowDelPic($detail)
{
    global $connection;
    $UserID = $detail['ID'];

    $query = "DELETE FROM deliverypickedup WHERE ID= $UserID";;
    $res = mysqli_query($connection, $query);
    return $res;
}



function DashBordInput($currentMonth, $currentYear)
{

    global $connection;

    $query = "SELECT * FROM dashboardstat WHERE CurrentMonth = '$currentMonth' AND Currentyear = '$currentYear'";
    $res = mysqli_query($connection, $query);

    $respon = mysqli_num_rows($res);

    if ($respon !== 1) {
        return "something is wrong on the db";
    } else {
        $res2 = mysqli_fetch_assoc($res);
        return $res2;
    }
}
