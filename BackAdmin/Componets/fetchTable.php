
<?php

require '../config/db.php';
session_start();
$Inout = array();
$user = $_SESSION['shopname'];
$received = json_decode(file_get_contents('php://input'));

if ($received->action === "allSubscribers") {

    if ($user === 'Central') {

        $query = "SELECT * FROM subscriptionlist ORDER BY id DESC";
    } else {
        $query = "SELECT * FROM subscriptionlist WHERE ShopLocation = '$user' ORDER BY ID DESC";
    }

    $res = mysqli_query($connection, $query);

    while ($res2 = mysqli_fetch_assoc($res)) {

        array_push($Inout, $res2);
    }

    echo json_encode($Inout);
}


if ($received->action === "all") {

    if ($user === 'Central') {

        $query = "SELECT * FROM pickuppayed ORDER BY ID DESC";
    } else {
        $query = "SELECT * FROM pickuppayed WHERE ShopLocation = '$user' ORDER BY ID DESC";
    }

    $res = mysqli_query($connection, $query);

    while ($res2 = mysqli_fetch_assoc($res)) {

        array_push($Inout, $res2);
    }

    echo json_encode($Inout);
}


if ($received->action === "allDelivery") {

    if ($user === 'Central') {

        $query = "SELECT * FROM deliveryorders ORDER BY ID DESC";
    } else {
        $query = "SELECT * FROM deliveryorders WHERE ShopLocation = '$user' ORDER BY ID DESC";
    }

    $res = mysqli_query($connection, $query);
    while ($res2 = mysqli_fetch_assoc($res)) {

        array_push($Inout, $res2);
    }

    echo json_encode($Inout);
}


if ($received->action === "fetchAllCompleted") {

    if ($user === 'Central') {

        $query =  "SELECT * FROM completeddelivery ORDER BY ID DESC";
    } else {
        $query = "SELECT * FROM completeddelivery WHERE ShopLocation = '$user' ORDER BY ID DESC";
    }

    $res = mysqli_query($connection, $query);
    while ($res2 = mysqli_fetch_assoc($res)) {

        array_push($Inout, $res2);
    }

    echo json_encode($Inout);
}
