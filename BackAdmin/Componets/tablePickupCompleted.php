<?php

require_once 'config/db.php';
// include  './config/functions.php';


if (isset($_POST['List'])) {
    global $connection;
    $ListID = escape($_POST['ID']);



    $selectedItem = GetSelectionAdmin($Cart);

    $Ch_title = $selectedItem['Title'];
    $Ch_quan = $res['Quantity'];
    $Ch_prc = $selectedItem['price'];
    $Ch_amn = $res['Amount'];
    $Ch_Update = $res['Updated'];


    echo $ListID;
}

?>

<?php include  './config/db.php'; ?>
<!--  -->
<?php include  'Sqlfunc.php'; ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pickup Orders</h1>
    <p class="mb-4">

    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Completed Pickup Orders
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Order Number</th>
                            <th>Qty</th>
                            <th>Detail</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <?php if ($_SESSION['user_role'] == 'SuperAdmin') { ?>
                                <th> Shop </th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                                $response = getPickupOrdersCompleted($_SESSION['user_role'], $_SESSION['location']);

                                foreach ($response as $row) {

                                    $urlStr = base64_encode(urlencode($row['Id']));
                                    $model = base64_encode(urlencode("pikCom")); ?>
                            <tr>
                                <form class="user" action="./CartViewer.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="ID" value=<?php echo $row['Id']; ?> />
                                    <td><?php echo $row['FirstName'] . " " . $row['LastName']; ?></td>
                                    <td><?php echo $row['PhonNumber']; ?></td>
                                    <td><?php echo $row['OrderNumber']; ?></td>
                                    <td><?php echo $row['NumProduct']; ?></td>
                                    <td> <a href="CartCompleted.php?UD=<?php echo $urlStr; ?>&model=<?php echo $model; ?>" class="btn btn-success btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-shopping-cart"></i>
                                            </span>
                                            <span class="text">Detail</span>
                                        </a></td>
                                    <td><?php echo $row['Total']; ?> ETB</td>
                                    <td>Completed</td>
                                    <td><?php echo $row['Shop']; ?></td>
                                </form>
                            </tr>
                        <?php } ?>
                        <?php } elseif ($_SESSION['user_role'] != 'SuperAdmin') {
                                $response = getPickupOrdersCompleted($_SESSION['user_role'], $_SESSION['shopname']);
                                foreach ($response as $row) {
                                    $urlStr = base64_encode(urlencode($row['Id']));
                                    $model = base64_encode(urlencode("pikCom")); ?>
                            <tr>
                                <td><?php echo $row['FirstName'] . " " . $row['LastName'];    ?></td>
                                <td><?php echo $row['PhonNumber']; ?></td>
                                <td><?php echo $row['OrderNumber']; ?></td>
                                <td><?php echo $row['NumProduct']; ?></td>
                                <td><?php echo $row['Total']; ?> ETB</td>
                                <td>pending</td>
                                <td>
                                    <a href="CartCompleted.php?UD=<?php echo $urlStr; ?>&model=<?php echo $model; ?>" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-shopping-cart"></i>
                                        </span>
                                        <span class="text">Cart List</span>
                                    </a>
                                </td>


                            </tr>
                        <?php }  ?>
                    <?php }  ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>