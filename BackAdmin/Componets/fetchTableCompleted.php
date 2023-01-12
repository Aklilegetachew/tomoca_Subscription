
<?php

require '../config/db.php';
session_start();
$Inout = array();
$user = $_SESSION['shopname'];
$received = json_decode(file_get_contents('php://input'));






if ($received->action === "allDelivery") {

    if ($user === 'Central') {

        $query =  "SELECT * FROM completeddelivery ORDER BY CompletedDate DESC";
    } else {
        $query = "SELECT * FROM completeddelivery WHERE ShopLocation = '$user' ORDER BY CompletedDate DESC";
    }

    $res = mysqli_query($connection, $query);
    while ($res2 = mysqli_fetch_assoc($res)) {

        array_push($Inout, $res2);
    }

    echo json_encode($Inout);
}


if ($received->action === "ByDate") {

    $firstDay =  strtotime($received->startDate);
    $lastdate =  strtotime($received->endDate);



    for ($i = $firstDay; $i <= $lastdate; $i = $i + 86400) {
        // $L = intval($i);
        $thisDate = date('Y-m-d', $i); // 2010-05-01, 2010-05-02, et



        if ($user === 'Central') {

            $query = "SELECT * FROM completeddelivery WHERE CompletedDate = '$thisDate'";
        } else {
            $query = "SELECT * FROM completeddelivery WHERE ShopLocation = '$user' AND CompletedDate = '$thisDate'";
        }

        $res = mysqli_query($connection, $query);
        while ($res2 = mysqli_fetch_assoc($res)) {

            array_push($Inout, $res2);
        }
    }

    echo json_encode($Inout);
}




if ($received->action === "PickedAll") {

    if ($user === 'Central') {

        $query =  "SELECT * FROM deliverypickedup ORDER BY ID DESC";
    } else {
        $query = "SELECT * FROM deliverypickedup WHERE ShopLocation = '$user' ORDER BY ID DESC";
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