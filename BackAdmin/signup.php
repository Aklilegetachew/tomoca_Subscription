<?php
session_start();

if (!isset($_SESSION['user_role'])) {
    header("Location: index.php");
}



?>



<?php

require_once 'config/db.php';
include  './config/functions.php';

if (isset($_POST['create_user'])) {
    global $connection;
    $user_name = escape($_POST['User_name']);
    $user_pwd = escape($_POST['User_pass']);
    $Shop_name = escape($_POST['Shop_name']);
    $user_role = "ShopAdmin";
    $user_location = escape($_POST['Shop_Location']);
    // 63.97448052880151, 165.51871972906292
    $ShopLatLong = escape($_POST['GeoLocation']);

    $ShopLocationArray = explode(",", $ShopLatLong);
    $ShopLong = $ShopLocationArray[1];
    $ShopLat = $ShopLocationArray[0];

    $ShopPhoneNum = escape($_POST['PhoneNumber']);

    // encript password
    $encryptePwd = password_hash($user_pwd, PASSWORD_BCRYPT, ['cost' => 10]);

    $query = "INSERT INTO admin(Shop_name,UserName, Location, Password, Role, Longt, Lat, PhoneNumber) ";
    $query .= "VALUES('$Shop_name', '$user_name', '$user_location', '$encryptePwd','$user_role','$ShopLong','$ShopLat','$ShopPhoneNum') ";

    $user_result = mysqli_query($connection, $query);

    confirm($user_result);
    header("Location: ./users.php");
}





?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add New Shop</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-dark">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Add new Shop</h1>
                            </div>
                            <form class="user" action="" method="POST" enctype="multipart/form-data">

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="" placeholder="Shop Name" name="Shop_name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="" placeholder="Shop Phone Number" name="PhoneNumber">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="" placeholder="Shope Location" name="Shop_Location">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="" placeholder="Lat/Lng" name="GeoLocation">
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="" placeholder="Shop Admin Name" name="User_name">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="" placeholder="Password" name="User_pass">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block" name="create_user">
                                    Add shop
                                </button>
                                <hr>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>