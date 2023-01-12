<?php

include '../../config/db.php';
$received = json_decode(file_get_contents('php://input'));

if ($received->action === "Chart") {

    $currentMonth = $received->CMonth;
    $currentYear = $received->CYear;
    $Inout = array();
    $labels = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
    ];
    global $connection;

    $query = "SELECT * FROM dashboardstat WHERE Currentyear = '$currentYear'";
    $res = mysqli_query($connection, $query);

    $respon = mysqli_num_rows($res);
   

    foreach ($labels as $mnth) {
        $query = "SELECT * FROM dashboardstat WHERE Currentyear = '$currentYear' AND CurrentMonth = '$mnth'";
        $res = mysqli_query($connection, $query);
        $respon = mysqli_num_rows($res);

        if($respon !== 0){
            $res2 = mysqli_fetch_assoc($res);
            array_push($Inout, $res2['TotalCash']);
        }else{
            array_push($Inout, "0");
        }
    }

    echo json_encode($Inout);
}



if ($received->action === "ChartBAR") {

    $currentMonth = $received->CMonth;
    $currentYear = $received->CYear;
    $Inout = array();

    global $connection;

    $query = "SELECT * FROM dashboardstat WHERE Currentyear = '$currentYear' AND CurrentMonth = '$currentMonth'";
    $res = mysqli_query($connection, $query);

    $respon = mysqli_num_rows($res);

    if ($respon !== 1) {

        array_push($Inout, "something is wrong on the db");
    } else {

        while ($res2 = mysqli_fetch_assoc($res)) {

            array_push($Inout, $res2['BAR']);
            array_push($Inout, $res2['Famila']);
            array_push($Inout, $res2['Turkish']);
        }
    }


    echo json_encode($Inout);
}




if ($received->action === "ChartShop") {

    $currentMonth = $received->CMonth;
    $currentYear = $received->CYear;
    $Inout = array();

    global $connection;

    $query = "SELECT * FROM dashboardstat WHERE Currentyear = '$currentYear' AND CurrentMonth = '$currentMonth'";
    $res = mysqli_query($connection, $query);

    $respon = mysqli_num_rows($res);

    if ($respon !== 1) {

        array_push($Inout, "something is wrong on the db");
    } else {

        while ($res2 = mysqli_fetch_assoc($res)) {
            $shopLocation = $res2['ShopLocation'];
            array_push($Inout, $shopLocation);
        }
    }


    echo json_encode($Inout);
}
