<!--  -->
<?php include  'Componets/Sqlfunc.php'; ?>


<?php



$ListID = urldecode(base64_decode($_GET['UD']));
$ModelID = urldecode(base64_decode($_GET['model']));





if ($ListID) {
    $detail = getUserInputPickupCompleted($ListID);
    deleteRowCompleted($detail);
    // $arryDetail = array();
    header("Location: PickUpCompleted.php");


    if ($ModelID == 'pik') {

        header("Location: PickOrder.php");
    } else if ($ModelID == 'pikCom') {
        $detail = getUserInputPickupCompleted($ListID);
        deleteRowCompleted($detail);
        header("Location: PickUpCompleted.php");
    } elseif ($ModelID == 'Del') {
        header("Location: DeliveryOrder.php");
    } elseif ($ModelID == 'DelPik') {
        header("Location: PickedUp.php");
    } elseif ($ModelID == 'DelCom') {
        $detail = getUserInputDeliveryCompleted($ListID);
        deleteRowCompletedDel($detail);
        header("Location: deliveryCompleted.php");
    }
}
?>