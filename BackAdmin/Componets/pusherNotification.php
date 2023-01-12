<?php


include '../config/db.php';
// include 'Sqlfunc.php';

function addNotification($newOrder, $CustomerName, $dateOrder, $shopName)
{
    if (str_contains($newOrder, "pickup")) {
        $LinkUrl = "./PickOrder.php";
    } else {
        $LinkUrl = "./DeliveryOrder.php";
    }
    global $connection;
    $query = "INSERT INTO notificatione(newOrder, CustomerName, dateOrder, UrlOrder, ShopLocation) VALUES ('$newOrder', '$CustomerName', '$dateOrder', '$LinkUrl', '$shopName')";
    $res = mysqli_query($connection, $query);
    return $res;
}


$received = json_decode(file_get_contents('php://input'));

if ($received->action == 'submit') {

    echo json_encode(CancelLitsener($received->name, $received->Orderday, $received->NewOrder, $received->shopName));
}
function cancelLitsener($name, $Orderday, $NewOrder, $shopName)
{
    $_SESSION['new_order'] = true;
    $_SESSION['new_orderNum'] += 1;
    file_put_contents("notfy.txt", $name . PHP_EOL . PHP_EOL, FILE_APPEND);
    $r =  addNotification($NewOrder, $name, $Orderday, $shopName);
    return $r;
}
