<!--  -->
<?php include  'Sqlfunc.php'; ?>

<?php


$ListID = $_GET['ID'];


$detail = getUserInputAdmin($ListID);
$productInfo = getProductInfo($detail['product_id']);

$FullName = $detail['FirstName'];
$PhoneNumber = $detail['PhoneNumber'];
$TotalPayment = $detail['TotalAmount'];
$Status = $detail['Payment'];
$NextDate = "Today";

$TransactionNumber = $detail['TransactionID'];
$TinNumber = "";
$BussinessName = "";
$ShopLocation = $detail['ShopLocation'];
$SubscriptionTitle = $productInfo['Title'];
$Price = $productInfo['price'];
$Description = $productInfo['Description'];
$PackageSize = $productInfo['size'];
$Duration = $productInfo['Roast'];

// if ($ListID) {
//     global $connection;
//     $detail = getUserInfo($ListID);
//     $productInfo= getProductInfo($detail['product_id'])
//     // $ListID = $_GET['UD'];
//     if ($ModelID == 'pik') {

//     } else if ($ModelID == 'pikCom') {
//         $detail = getUserInputPickupCompleted($ListID);
//     } elseif ($ModelID == 'Del') {
//         $detail = getUserInputDelivery($ListID);
//         $FirstName = $detail['FirstName'];
//         $LastName = $detail['LastName'];
//         $TotalAmount = $detail['Total'];
//         $TransactionID = $detail['OrderNumber'];
//         $PhoneNumber = $detail['PhoneNumber'];
//         $ShopLocation = $detail['ShopLocation'];

//         $labelDate = "Order Date:";
//         $labelTime = "Order Time:";
//         $orderDate = $detail['orderDate'];
//         $orderTime = $detail['orderTime'];
//     } elseif ($ModelID == 'DelPik') {
//         $detail = getUserInputDeliveryPicked($ListID);
//         $FirstName = $detail['FirstName'];
//         $LastName = $detail['LastName'];
//         $TotalAmount = $detail['Total'];
//         $TransactionID = $detail['OrderNumber'];
//         $PhoneNumber = $detail['PhoneNumber'];
//         $ShopLocation = $detail['ShopLocation'];

//         $orderDate = $detail['pickedDate'];
//         $orderTime = $detail['pickedTime'];

//         $labelDate = "Picked Date:";
//         $labelTime = "Picked Time:";
//     } elseif ($ModelID == 'DelCom') {
//         $detail = getUserInputDeliveryCompleted($ListID);
//     }


//     $ChartStart = intval($detail['CartStart']);
//     $ChartEnd = intval($detail['CartEnd']);
//     $TinName = "";
//     $TinNumber = "";
//     if ($detail['TinName']) {
//         $TinName = $detail['TinName'];
//         $TinNumber = $detail['TinNumber'];
//     } else {
//         $TinName = "Personal";
//         $TinNumber = "N/A";
//     }

//     $ChartStart = intval($detail['CartStart']);
//     $ChartEnd = intval($detail['CartEnd']);
//     $arryDetail = array();
//     if ($ChartStart > $ChartEnd) {
//     } else {

?>

<div class="">
    <div class="card CustomCardBig shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header flex-row  justify-content-between">
            <div class="m-0 font-weight-bold centerText text-primary">
                Customer Information
            </div>
        </div>
        <div class="infoContainer">
            <div class="defTxt mb-2 font-weight text-gray">
                Name:
                <span class=" infoTxt mb-0 font-weight text-gray"><?php echo $FullName; ?></span>
            </div>
            <div class="defTxt mb-2 font-weight text">
                Phone Number:
                <span class=" infoTxt mb-0 font-weight text"><?php echo $PhoneNumber; ?></span>
            </div>

            <div class=" defTxt mb-2 font-weight text">
                Order Number:
                <span class=" infoTxt mb-0 font-weight text"><?php echo $TransactionNumber; ?></span>
            </div>

            <div class=" defTxt mb-2 font-weight text">
                Total Amount:
                <span class=" infoTxt mb-0 font-weight text"><?php echo $TotalPayment; ?>ETB</span>
            </div>

            <div class=" defTxt mb-2 font-weight text">
                Business Name:
                <span class="infoTxt mb-0 font-weight text"><?php echo $BussinessName ?></span>
            </div>

            <div class=" defTxt mb-2 font-weight text">
                Tin Number:
                <span class="infoTxt mb-0 font-weight text"><?php echo $TinNumber ?></span>
            </div>

            <div class=" defTxt mb-2 font-weight text">
                Shop Location:
                <span class="infoTxt mb-0 font-weight text"><?php echo $ShopLocation ?></span>
            </div>

            <div class=" defTxt mb-2 font-weight text">
                Next Order Date:
                <span class="infoTxt mb-0 font-weight text"><?php echo $NextDate ?></span>
            </div>

            <div class=" defTxt mb-2 font-weight text">
                Status:
                <span class="infoTxt mb-0 font-weight text"><?php echo $Status ?></span>
            </div>

        </div>
    </div>
</div>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Subscription Detail</h1>
</div>
<div class="tinStatus">
    <h5 class="">Business Name:<?php echo $BussinessName ?> </h5>
    <h5 class="">Tin Number:<?php echo $TinNumber ?> </h5>
</div>
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <?php echo $SubscriptionTitle; ?> </div>

                        <div class="h5 mb-0 font-weight text-gray-800">Product type: <span class="h6 mb-0 font-weight text-gray-400"><?php echo $SubscriptionTitle; ?></span>
                        </div>
                        <div class="h5 mb-0 font-weight text-gray-800">Duration Period: <span class="h6 mb-0 font-weight text-gray-400"><?php echo $Duration; ?></span></div>
                        <div class="h5 mb-0 font-weight text-gray-800">Total Size: <span class="h6 mb-0 font-weight text-gray-400"><?php echo $PackageSize; ?></span></div>

                        <div class="h5 mb-0 font-weight text-gray-800">Total: <span class="h6 mb-0 font-weight text-gray-400"><?php echo $Price; ?>ETB </span></div>
                    </div>
                    <span class="col-auto">
                        <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                        <!-- <img src="./img/logo.jpg" class="rounded fa-2x text-gray-300 row-cols-1" alt="..."> -->
                    </span>
                </div>
            </div>
        </div>
    </div>


</div>