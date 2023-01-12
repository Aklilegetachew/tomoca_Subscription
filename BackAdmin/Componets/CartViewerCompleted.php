<!--  -->
<?php include  'Sqlfunc.php'; ?>

<?php

$ListID = urldecode(base64_decode($_GET['UD']));
$ModelID = urldecode(base64_decode($_GET['model']));

//$ListID = $_GET['UD'];


if ($ListID) {
    global $connection;
    // $ListID = $_GET['UD'];
    $detail = '';
    if ($ModelID == 'pik') {
        $detail = getUserInputAdmin($ListID);
    } else if ($ModelID == 'pikCom') {
        $detail = getUserInputPickupCompleted($ListID);
    } elseif ($ModelID == 'Del') {
        $detail = getUserInputDelivery($ListID);
    } elseif ($ModelID == 'DelPik') {
        $detail = getUserInputDeliveryPicked($ListID);
    } elseif ($ModelID == 'DelCom') {
        $detail = getUserInputDeliveryCompleted($ListID);
    }

    $FirstName = $detail['FirstName'];
    $LastName = $detail['LastName'];
    $TotalAmount = $detail['Total'];
    $TransactionID = $detail['OrderNumber'];
    $PhoneNumber = $detail['PhoneNumber'];
    $ShopLocation = $detail['ShopLocation'];
    $orderDate = $detail['CompletedDate'];
    $orderTime = $detail['completedTime'];

    $ChartStart = intval($detail['CartStart']);
    $ChartEnd = intval($detail['CartEnd']);

    $arryDetail = array();
    if ($ChartStart > $ChartEnd) {
        echo "something is wrong contact service provider";
    } else {

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
                        <span class=" infoTxt mb-0 font-weight text-gray"><?php echo $FirstName; ?></span>
                    </div>
                    <div class="defTxt mb-2 font-weight text">
                        Phone Number:
                        <span class=" infoTxt mb-0 font-weight text"><?php echo $PhoneNumber; ?></span>
                    </div>

                    <div class=" defTxt mb-2 font-weight text">
                        Order Number:
                        <span class=" infoTxt mb-0 font-weight text"><?php echo $TransactionID; ?></span>
                    </div>

                    <div class=" defTxt mb-2 font-weight text">
                        Total Amount:
                        <span class=" infoTxt mb-0 font-weight text"><?php echo $TotalAmount; ?>ETB</span>
                    </div>

                    <div class=" defTxt mb-2 font-weight text">
                        Completed Date:
                        <span class=" infoTxt mb-0 font-weight text"><?php echo $orderDate; ?></span>
                    </div>

                    <div class=" defTxt mb-2 font-weight text">
                        Completed Time:
                        <span class=" infoTxt mb-0 font-weight text"><?php echo $orderTime; ?></span>
                    </div>

                    <div class=" defTxt mb-2 font-weight text">
                        Status:
                        <span class="infoTxt mb-0 font-weight text">Completed</span>
                    </div>


                </div>


            </div>
        </div>




        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cart </h1>
        </div>
        <div class="row">
            <?php
            for ($x = $ChartStart; $x <= $ChartEnd; $x++) {
                $query = "SELECT * From cart WHERE cartId= '$x'";
                $res = mysqli_query($connection, $query);

                $res = mysqli_fetch_assoc($res);
                $productID = $res['ProductId'];
                $selectedItem = GetSelectionAdmin($productID);

                $Ch_title = $selectedItem['Title'];
                $Ch_quan = $res['Quantity'];
                $Ch_prc = $selectedItem['price'];
                $Ch_siz = $selectedItem['size'];
                $Ch_Roast = $selectedItem['Roast'];
                $Ch_amn = $res['Amount'];
                $Ch_Update = $res['Updated'];
                $Ch_dsc = $selectedItem['Description'];
                $Ch_Amount = $res['Amount'];
            ?>



                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        <?php echo $Ch_title; ?> </div>

                                    <div class="h5 mb-0 font-weight text-gray-800">Product type: <span class="h6 mb-0 font-weight text-gray-400"><?php echo $Ch_dsc; ?></span>
                                    </div>
                                    <div class="h5 mb-0 font-weight text-gray-800">Roast type: <span class="h6 mb-0 font-weight text-gray-400"><?php echo $Ch_Roast; ?></span></div>
                                    <div class="h5 mb-0 font-weight text-gray-800">Size: <span class="h6 mb-0 font-weight text-gray-400"><?php echo $Ch_siz; ?></span></div>
                                    <div class="h5 mb-0 font-weight text-gray-800">Qty: <span class="h6 mb-0 font-weight text-gray-400"> <?php echo $Ch_quan; ?></span></div>

                                    <div class="h5 mb-0 font-weight text-gray-800">Price/bag: <span class="h6 mb-0 font-weight text-gray-400"><?php echo $Ch_prc; ?> ETB</span></div>
                                    <div class="h5 mb-0 font-weight text-gray-800">Total: <span class="h6 mb-0 font-weight text-gray-400"><?php echo $Ch_Amount; ?>ETB </span></div>
                                </div>
                                <span class="col-auto">
                                    <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                    <!-- <img src="./img/logo.jpg" class="rounded fa-2x text-gray-300 row-cols-1" alt="..."> -->
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                




    <?php
            }
        }
    }
    ?>
        </div>