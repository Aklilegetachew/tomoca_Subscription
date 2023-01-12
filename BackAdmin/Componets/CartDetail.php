
<?php

require '../config/db.php';
session_start();
$Inout = array();
$user = $_SESSION['shopname'];
$received = json_decode(file_get_contents('php://input'));


if ($received->action === "cart") {

    $CartStart =  $received->CStart;
    $productList = array();

    $queryFirst = "SELECT * FROM cart WHERE cartId = '$CartStart'";
    $res = mysqli_query($connection, $queryFirst);
    $resresult = mysqli_fetch_assoc($res);

    $UserId = $resresult['UserID'];

    $query = "SELECT * FROM cart WHERE UserID = '$UserId'";

    $res = mysqli_query($connection, $query);
    while ($res2 = mysqli_fetch_assoc($res)) {


        $productID = $res2['ProductId'];
        $query = "SELECT * FROM products WHERE productId = '$productID'";


        $res3 = mysqli_query($connection, $query);
        $resprod = mysqli_fetch_assoc($res3);

        $EveryList = [$res2['Quantity'], $resprod['size'], $resprod['Roast']];
        array_push($productList,  $EveryList);
        // $productList .= $EveryList;
    }

    return "hello";
}
