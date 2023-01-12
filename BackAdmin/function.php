<!--  -->
<?php include  'Componets/Sqlfunc.php'; ?>


<?php

include '../functions.php';




$ListID = urldecode(base64_decode($_GET['UD']));
$ModelID = urldecode(base64_decode($_GET['model']));


if ($ListID) {
    global $connection;

    if ($ModelID == 'pik') {
        $detail = getUserInputAdmin($ListID);
        SetCompleted($detail);
        deleteRow($detail);
        header("Location: PickOrder.php");
    } else if ($ModelID == 'pikCom') {
        $detail = getUserInputPickupCompleted($ListID);
    } elseif ($ModelID == 'Del') {
        $detail = getUserInputDelivery($ListID);
        SetCompletedDel($detail);
        sendNotificationToUser($detail);
        deleteRowDel($detail);
        header("Location: DeliveryOrder.php");
    } elseif ($ModelID == 'DelPik') {
        $detail = getUserInputDeliveryPicked($ListID);
        SetCompletedDelPic($detail);
        deleteRowDelPic($detail);
        header("Location: PickedUp.php");
    } elseif ($ModelID == 'DelCom') {
        $detail = getUserInputDeliveryCompleted($ListID);
    }
}
?>