
<?php


include '../config/db.php';
require  '../../vendor/autoload.php';


function getUserInputDeliveryPickedauto($UseID)
{
    global $connection;
    $query = "SELECT * FROM deliverypickedup WHERE ID = '$UseID'";
    $res = mysqli_query($connection, $query);
    $res2 = mysqli_fetch_assoc($res);
    $respo = array();

    return $res2;
}

function SetCompletedDelPicauto($detail)
{
    global $connection;
    $UserID = $detail['ID'];
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


    $query = "INSERT INTO completeddelivery(FirstName, LastName, PhoneNumber, Total, CartStart, CartEnd, OrderNumber, Pickupurl, Quantity, DeliveryUrl, ShopLocation, Confirmdate, TinName, TinNumber, DeliveryID)
     VALUES ('$FirstName', '$LastName', '$PhoneNumber', '$TotalAmount', '$CartStart', '$CartEnd', '$TransactionID', '$pickupurl', '$NumProduct', '$Deliveryurl', '$ShopLocation', '$Confirmdate', '$TinName', '$TinNumber', '$deliveryID')";
    $res = mysqli_query($connection, $query);
}


function deleteRowDelPicauto($detail)
{
    global $connection;
    $UserID = $detail['ID'];

    $query = "DELETE FROM deliverypickedup WHERE ID= $UserID";;
    $res = mysqli_query($connection, $query);
    return $res;
}
// include './Sqlfunc.php';

function addConfirmation($Status, $confirmday, $NumOrder, $Conftime)
{

    $LinkUrl = "./DeliveryOrder.php";
    global $connection;
    if ($Status == "YES") {
        $stat = "Confirmed";
    } else {
        $stat = "Denied";
    }


    $query1 = "SELECT * FROM deliverypickedup WHERE OrderNumber = '$NumOrder'";
    $res1 = mysqli_query($connection, $query1);

    $respon = mysqli_num_rows($res1);

    if ($respon !== 0) {
        $res2 = mysqli_fetch_assoc($res1);
        $shopName = $res2["ShopLocation"];
        $NAME = $res2["FirstName"] . $res2["LastName"];
        $mesg = "Confirmation notification";
        $ListID = $res2['ID'];

        $query = "INSERT INTO notificatione(Status, ConfrmationTime, dateOrder, UrlOrder, ShopLocation, OrderNum, newOrder, CustomerName) VALUES ('$Status', '$Conftime', '$confirmday', '$LinkUrl', '$shopName', '$NumOrder', '$mesg', '$NAME')";
        $res = mysqli_query($connection, $query);


        $query = "UPDATE deliverypickedup SET Status = '$stat' WHERE OrderNumber = '$NumOrder'";;
        $res = mysqli_query($connection, $query);

        $query = "UPDATE deliverypickedup SET Confirmdate = '$confirmday' WHERE OrderNumber = '$NumOrder'";;
        $res = mysqli_query($connection, $query);


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

        if ($stat == 'Confirmed') {
            $detail = getUserInputDeliveryPickedauto($ListID);
            SetCompletedDelPicauto($detail);
            deleteRowDelPicauto($detail);
            $pusher->trigger('my-channel', 'my-eventUpdateTable', "updateTablePicked");
        }

        return $shopName;
    } else {
        $queryanother = "SELECT * FROM completeddelivery WHERE OrderNumber = '$NumOrder'";
        $resanother = mysqli_query($connection, $queryanother);

        $res2 = mysqli_fetch_assoc($resanother);
        $shopName = $res2["ShopLocation"];
        $NAME = $res2["FirstName"] . $res2["LastName"];
        $mesg = "Confirmation notification";

        $query = "INSERT INTO notificatione(Status, ConfrmationTime, dateOrder, UrlOrder, ShopLocation, OrderNum, newOrder, CustomerName) VALUES ('$Status', '$Conftime', '$confirmday', '$LinkUrl', '$shopName', '$NumOrder', '$mesg', '$NAME')";
        $res = mysqli_query($connection, $query);

        $query = "UPDATE completeddelivery SET Status = '$stat' WHERE OrderNumber = '$NumOrder'";;
        $res = mysqli_query($connection, $query);

        $query = "UPDATE completeddelivery SET Confirmdate = '$confirmday' WHERE OrderNumber = '$NumOrder'";;
        $res = mysqli_query($connection, $query);

        return $shopName;
    }
}


$received = json_decode(file_get_contents('php://input'));

if ($received->action == 'submit') {

    echo json_encode(ConfirmLitsener($received->Status, $received->confirmday, $received->NumOrder, $received->Conftime));
}
function confirmLitsener($Status, $confirmday, $NumOrder, $Conftime)
{

    $responseShop =  addConfirmation($Status, $confirmday, $NumOrder, $Conftime);
    return $responseShop;
}
