<!-- <?php include  './config/db.php'; ?> -->
<!--  -->
<?php include  'Sqlfunc.php'; ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Delivery Orders</h1>
    <p class="mb-4">

    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Completed Delivery Orders
            </h6>

            <span>
                <!-- Set up your HTML -->
                <div class="t-datepicker">
                    <div class="t-check-in"></div>
                    <div class="t-check-out"></div>
                </div>
                <!-- <button>Generate report</button> -->
            </span>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                        <tr>

                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Order Number</th>
                            <th>Delivery ID</th>
                            <th>Total Price</th>
                            <th>Delivery Tracking</th>
                            <th>Status</th>
                            <th>Cart</th>

                            <?php if ($_SESSION['user_role'] == 'SuperAdmin') { ?>
                                <th> Shop </th>
                            <?php } ?>
                            <!-- -->
                        </tr>
                    </thead>

                    <tbody>
<!-- <?php include  './config/db.php'; ?> -->
<!--  -->
<?php include  'Sqlfunc.php'; ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Delivery Orders</h1>
    <p class="mb-4">

    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4" id="TableDeliveryCompleted">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Completed Delivery Orders
            </h6>

            <span>
                <!-- Set up your HTML -->
                <div class="t-datepicker">
                    <div class="t-check-in"></div>
                    <div class="t-check-out"></div>
                </div>
                <!-- <button>Generate report</button> -->
            </span>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Order Number</th>
                            <th>Confirmation Date </th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Cart</th>

                            <?php if ($_SESSION['user_role'] == 'SuperAdmin') { ?>
                                <th> Shop </th>

                        </tr>
                    </thead>
                    <?php $i = 1; ?>
                    <tbody>
                        <?php
                                $response = getDeliveryCompleted($_SESSION['user_role'], $_SESSION['location']);

                                foreach ($response as $row) {
                                    $urlStr = base64_encode(urlencode($row['ID']));
                                    $model = base64_encode(urlencode("DelCom"));
                        ?>

                            <tr>

                                <td><?php echo $row['FirstName'] . " " . $row['LastName'];    ?></td>
                                <td><?php echo $row['PhoneNumber']; ?></td>
                                <td><?php echo $row['OrderNumber']; ?></td>
                                <td><?php echo $row['Confirmdate']; ?></td>
                                <td><?php echo $row['Total']; ?> ETB</td>
                                <td>Completed</td>
                                <td>
                                    <a href="CartCompleted.php?UD=<?php echo $urlStr; ?>&model=<?php echo $model; ?>" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-shopping-cart"></i>
                                        </span>
                                        <span class="text">Cart List</span>
                                    </a>
                                </td>
                                <td><?php echo $row['ShopLocation']; ?></td>


                                <?php $i++; ?>
                            </tr>

                        <?php } ?>
                        <?php } elseif ($_SESSION['user_role'] != 'SuperAdmin') {
                                $response = getDeliveryCompleted($_SESSION['user_role'], $_SESSION['shopname']);
                                foreach ($response as $row) {
                                    $urlStr = base64_encode(urlencode($row['ID']));
                                    $model = base64_encode(urlencode('DelCom')); ?>
                            <tr>
                                <td><?php echo $row['FirstName'] . " " . $row['LastName'];    ?></td>
                                <td><?php echo $row['PhoneNumber']; ?></td>
                                <td><?php echo $row['OrderNumber']; ?></td>
                                <td><?php echo $row['Confirmdate']; ?></td>
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
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>