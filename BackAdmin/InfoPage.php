<?php
require './config/db.php';
$ListID = urldecode(base64_decode($_GET['SIDe']));



$queryFirst = "SELECT * FROM admin WHERE iD= '$ListID'";
$res = mysqli_query($connection, $queryFirst);


while ($res2 = mysqli_fetch_assoc($res)) {
    $urlStr = base64_encode(urlencode($res2['iD']));
    $shopName = $res2['Shop_name'];
    $UserName = $res2['UserName'];
    $Location = $res2['Location'];
    $password = $res2['Password'];
    $Role = $res2['Role'];
    $Longt = $res2['Longt'];
    $Lat = $res2['Lat'];
    $phoneNumber = $res2['PhoneNumber'];
    $email = $res2['email'];
}
?>

<?php include 'Componets/HeaderAdmin.php'; ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'Componets/SideBar.php'; ?>
        <!-- End of Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'Componets/TopBar.php'; ?>
                <!-- End of Topbar -->

                <!-- Content Wrapper -->

                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Shop Details</h1>
                    </div>
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo $shopName; ?></h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Options:</div>
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="#">Delete</a>
                                    <div class="dropdown-divider"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            Shop Information


                            <div class="alert alert-dark" role="alert">
                                USER NAME : <?php echo $UserName; ?>
                            </div>

                            <div class="alert alert-dark" role="alert">
                                LOCATION : <?php echo $Location; ?>
                            </div>
                            <div class="alert alert-dark" role="alert">
                                ROLE : <?php echo $Role; ?>
                            </div>
                            <div class="alert alert-dark" role="alert">
                                PHONE NUMBER : <?php echo $phoneNumber; ?>
                            </div>
                            <div class="alert alert-dark" role="alert">
                                EMAIL : <?php echo $email; ?>
                            </div>
                            <div class="alert alert-dark" role="alert">
                                MAP LOCATION : <a href="http://maps.google.com/?ie=UTF8&hq=&ll=<?php echo $Lat; ?>,<?php echo $Longt; ?>&z=13">click here</a>
                            </div>

                        </div>
                    </div>

                    <!-- End of Main Content -->

                </div>
                <?php include 'Componets/footer.php'; ?>