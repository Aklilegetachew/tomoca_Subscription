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
                    <?php include 'Componets/CartViewer.php';
                    // $ListID = urldecode(base64_decode($_GET['UD']));

                    ?>
                    <a href="function.php?UD=<?php echo $_GET['UD']; ?>&model=<?php echo $_GET['model']; ?>" class="pickedOrder btn btn-success btn-icon-split" data-toggle="modal" data-target="#PickModal">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Pick Order</span>
                    </a>
                    <a href="./PickedUp.php" class=" pickedOrder btn btn-back btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Back</span>
                    </a>


                </div>






                <!-- End of Main Content -->
            </div>
            <?php include 'Componets/footer.php'; ?>