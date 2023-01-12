<?php

require '../config/db.php';
session_start();
$Inout = array();
$user = $_SESSION['shopname'];
$received = json_decode(file_get_contents('php://input'));

if ($received->action === "all") {

    if ($user === 'Central') {

        $query = "SELECT * FROM notificatione ORDER BY ID DESC";
    } else {
        $query = "SELECT * FROM notificatione WHERE ShopLocation = '$user' ORDER BY ID DESC";
    }

    $res = mysqli_query($connection, $query);
    while ($res2 = mysqli_fetch_assoc($res)) {
        $Inout[] = $res2;
    }
    echo json_encode($Inout);
}

if ($received->action === "count") {
    $view = $received->view;
    $loc = $_SESSION['shopname'];
    if ($view == "") {

        if ($user === 'Central') {
            $status_query = "SELECT * FROM notificatione WHERE comment_statusAdmin=0";
        } else {

            $status_query = "SELECT * FROM notificatione WHERE ShopLocation = '$user' AND comment_status=0 ORDER BY ID DESC";
        }
        $status_result = mysqli_query($connection, $status_query);
        $number = mysqli_num_rows($status_result);
        echo json_encode($number);
    } else {

        if ($loc == "Central") {

            $update_query = "UPDATE notificatione SET comment_statusAdmin = 1 WHERE comment_statusAdmin=0";
        } else {
            $update_query = "UPDATE notificatione SET comment_status = 1 WHERE comment_status=0 AND ShopLocation = '$loc'";
        }
        $update_result = mysqli_query($connection, $update_query);
        echo json_encode("updated");
    }
}
