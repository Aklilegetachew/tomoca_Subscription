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

    // $user_pwd = escape($_POST['User_pass']);
    // $Shop_name = escape($_POST['Shop_name']);
    // $user_role = "SuperAdmin";
    // $user_location = escape($_POST['Shop_Location']);
    // $ShopLong = "Longtuide";
    // $ShopLat = "Lattuide";

    // // encript password
    // $encryptePwd = password_hash($user_pwd, PASSWORD_BCRYPT, ['cost' => 10]);

    // $query = "INSERT INTO admin(Shop_name,UserName, Location, Password, Role, Longt, Lat) ";
    // $query .= "VALUES('$Shop_name', '$user_name', '$user_location', '$encryptePwd','$user_role','$ShopLong','$ShopLat') ";

    // $user_result = mysqli_query($connection, $query);

    // confirm($user_result);
    echo $ListID;
    // header("Location: ./users.php");
}





?>








<?php include  './config/db.php'; ?>
<!--  -->
<?php include  'Sqlfunc.php'; ?>

<div class="container-fluid" id="DivContainer">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pickup Orders</h1>
    <p class="mb-4">

    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                New Pickup Orders
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableCompleted" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Order Number</th>
                            <th>Confirmed Date and time</th>
                            <th>Cart</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <?php if ($_SESSION['user_role'] == 'SuperAdmin') { ?>
                                <th> Shop </th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                                $response = getPickupOrdersCompleted($_SESSION['user_role'], $_SESSION['location']);

                                foreach ($response as $row) { ?>
                            <tr>
                                <form class="user" action="./CartViewer.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="ID" value=<?php echo $row['Id']; ?> />
                                    <td><?php echo $row['Name'] . " " . $row['LastName']; ?></td>
                                    <td><?php echo $row['PhonNumber']; ?></td>
                                    <td><?php echo $row['OrderNumber']; ?></td>
                                    <td><?php echo 0; ?></td>
                                    <td><button class="btn btn-sm" type="submit" name="List" value="">List</button></td>
                                    <td><?php echo $row['Total']; ?> ETB</td>
                                    <td>Completed</td>
                                    <td><?php echo $row['Shop']; ?></td>
                                </form>
                            </tr>
                        <?php } ?>
                        <?php } elseif ($_SESSION['user_role'] != 'SuperAdmin') {
                                $response = getPickupOrdersCompleted($_SESSION['user_role'], $_SESSION['shopname']);
                                foreach ($response as $row) { ?>
                            <tr>
                                <td><?php echo $row['Name'] . " " . $row['LastName'];    ?></td>
                                <td><?php echo $row['PhonNumber']; ?></td>
                                <td><?php echo $row['OrderNumber']; ?></td>
                                <td><?php echo 0; ?></td>
                                <td><button class="btn btn-sm" href="#">List</button></td>
                                <td><?php echo $row['Total']; ?> ETB</td>
                                <td>Completed</td>

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