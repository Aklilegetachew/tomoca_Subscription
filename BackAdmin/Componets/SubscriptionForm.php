<?php
// require '../config/db.php';
 require './botFunctions.php';



// $user = $_SESSION['shopname'];

if (isset($_POST['create_post'])) {
    global $connection;
    $Subscription = escape($_POST['Subscription']);
    $subPeriod = escape($_POST['subPeriod']);
    $totalPrice = escape($_POST['totalPrice']);
    $deliveryOptions = escape($_POST['deliveryOptions']);
    $PackageSize = escape($_POST['PackageSize']);
    $Description = escape($_POST['Description']);
    // $PhotoPath = escape($_POST['postPic']);
    // echo $PhotoPath;
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($_FILES["postPic"]["name"]);

    if (move_uploaded_file($_FILES["postPic"]["tmp_name"], $target_file)) {
        $photo_path = $target_file;
    } else {
        echo "Error uploading file.";
    }
    // encript password

    $query = "INSERT INTO products(Title, photo, price, Description, size, subscription_period, delivery_option) ";
    $query .= "VALUES('$Subscription', '$photo_path', '$totalPrice', '$Description','$PackageSize','$subPeriod','$deliveryOptions') ";

    $user_result = mysqli_query($connection, $query);

    confirm($user_result);
    // header("Location: ./users.php");

    
    $query = "SELECT * FROM products ORDER BY productId DESC LIMIT 1";;
    $res = mysqli_query($connection, $query);
    $respo = mysqli_fetch_assoc($res);
    $PostItem = $respo;
  
    $res = Postphoto($PostItem);

}







?>

<div class="container-fluid">
    <!-- Page Heading -->

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-9 mb-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    Add New Subscription Package
                </h1>
            </div>
            <!-- Project Card Example -->
            <!-- Color System -->
            <div class="row">
                <div class="container">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-block bg-add-Subscription-image"></div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Add New Package</h1>
                                        </div>
                                        <form class="user" action="" method="POST" enctype="multipart/form-data">

                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="" placeholder="Subscription Name" name="Subscription">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="" placeholder="Subscription Period(Month)" name="subPeriod">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="" placeholder="Total Price(ETB)" name="totalPrice">
                                            </div>

                                            <div class="form-group">
                                                <label for="deliveryOptions">Choose delivery options</label>

                                                <select name="deliveryOptions" id="deliveryOptions" class="form-control form-control-user">
                                                    <option value="1">Per Week</option>
                                                    <option value="2">Bi-Weekly</option>
                                                    <option value="3">Monthly</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="" placeholder="Total Package Size" name="PackageSize">
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-user" id="" placeholder="Add Description Detail" name="Description">
                                            </div>

                                            <div class="form-group">
                                                <input type="file" id="postPic" name="postPic" accept="image/png, image/jpeg">
                                            </div>

                                            <button type="submit" class="btn btn-primary btn-user btn-block" name="create_post">
                                                Add Package
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


            </div>
        </div>

        <!-- Approach -->
    </div>
</div>
</div>
<!-- /.container-fluid -->