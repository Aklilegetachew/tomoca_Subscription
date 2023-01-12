<?php
include '../functions.php';

getUserInput($userId);



function setStat($userInfo)
{
    global $db;
    $cartStart = intval($userInfo['CartStart']);
    $cartEnd = intval($userInfo['CartEnd']);
    $orderNum = 0;
    $TotalCash = 0;
    $BAR = 0;
    $FAM = 0;
    $Tur = 0;
    $Beans = 0;
    $Ground = 0;

    $currentDate = date('d');
    $currentMonth = date('M');
    $currentYear = date('Y');

    $options = array(
        'cluster' => 'us2',
        'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
        'e5fe60b6bb6d56b8b93e',
        '7c3c66b3fafa7887ded8',
        '1385315',
        $options
    );

    $queryFordate = "SELECT * From dashboardstat WHERE CurrentMonth='$currentMonth' AND Currentyear='$currentYear'";;
    $response = mysqli_query($db, $queryFordate);
    $result = mysqli_fetch_assoc($response);

    if (mysqli_num_rows($response) > 0) {

        $orderNum = intval($result['OrderNum']);
        $TotalCash = intval($result['TotalCash']);
        $BAR = intval($result['BAR']);
        $FAM = intval($result['Famila']);
        $Tur = intval($result['Turkish']);
        $Beans = intval($result['Beans']);
        $Ground = intval($result['Ground']);
        $ShopLoca = json_decode($result['ShopLocation'], true);

        for ($x = $cartStart; $x <= $cartEnd; $x++) {
            $query = "SELECT * From cart WHERE cartId=$x";;
            $res = mysqli_query($db, $query);
            $res2 = mysqli_fetch_assoc($res);
            $selectedItem = GetSelection($res2['ProductId']);

            if (str_contains($selectedItem["Description"], "Beans")) {
                $Beans += intval($res2["Quantity"]);
            } elseif (str_contains($selectedItem["Description"], "Ground")) {
                $Ground += intval($res2["Quantity"]);
            }

            if (str_contains($selectedItem["Roast"], "FAMIGLIA")) {
                $FAM += intval($res2["Quantity"]);
            } elseif (str_contains($selectedItem["Roast"], "BAR")) {
                $BAR += intval($res2["Quantity"]);
            } elseif (str_contains($selectedItem["Roast"], "Turkish")) {
                $Tur += intval($res2["Quantity"]);
            }
            
        }
        $orderNum += 1;
        $TotalCash += $userInfo["TotalAmount"];
        $ShopLoca[$userInfo["ShopLocation"]] += 1;
        $ShopNum = json_encode($ShopLoca);


        $queryforUpdate = "UPDATE dashboardstat SET OrderNum = '$orderNum', TotalCash= '$TotalCash', BAR = '$BAR', Famila = '$FAM', Turkish = '$Tur', Beans = '$Beans', Ground = '$Ground', ShopLocation = '$ShopNum' WHERE CurrentMonth= '$currentMonth' AND Currentyear= '$currentYear'";;
        $response = mysqli_query($db, $queryforUpdate);
    } else {


        for ($x = $cartStart; $x <= $cartEnd; $x++) {
            $query = "SELECT * From cart WHERE cartId=$x";;
            $res = mysqli_query($db, $query);
            $res2 = mysqli_fetch_assoc($res);
            $selectedItem = GetSelection($res2['ProductId']);

            if (str_contains($selectedItem["Description"], "Beans")) {
                $Beans += intval($res2["Quantity"]);
            } elseif (str_contains($selectedItem["Description"], "Ground")) {
                $Ground += intval($res2["Quantity"]);
            }

            if (str_contains($selectedItem["Roast"], "FAMIGLIA")) {
                $FAM += intval($res2["Quantity"]);
            } elseif (str_contains($selectedItem["Roast"], "BAR")) {
                $BAR += intval($res2["Quantity"]);
            } elseif (str_contains($selectedItem["Roast"], "Turkish")) {
                $Tur += intval($res2["Quantity"]);
            }


            
        }
        $orderNum += 1;
        $ShopJson = '{ "Historical" : 0,
            "Office Bar": 0,
            "Galleria": 0,
            "Meet up": 0,
            "Roastery": 0,
            "Camera": 0,
            "Village": 0,
            "Blue": 0,
            "Sip and Create": 0,
            "Black and white": 0}';

        $TotalCash += $userInfo["TotalAmount"];
        $queryNewMonth  = "INSERT INTO dashboardstat(StartDate, CurrentMonth, Currentyear, OrderNum, TotalCash, BAR, Famila, Turkish, Beans, Ground, ShopLocation) VALUES ('$currentDate', '$currentMonth', '$currentYear', '$orderNum', '$TotalCash', '$BAR', '$FAM', '$Tur', '$Beans', '$Ground', '$ShopJson')";
        $response = mysqli_query($db, $queryNewMonth);
        $data = "Update State";

        $pusher->trigger('my-channel', 'Stat-Update', $data);
    }
    $data = "Update State";
    $pusher->trigger('my-channel', 'Stat-Update', $data);
}
