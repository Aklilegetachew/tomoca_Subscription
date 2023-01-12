<?php
require './config/db.php';

$Inout = array();
$user = $_SESSION['shopname'];
?>

<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Registered Shops</h1>
  </div>

  <!-- Content Row -->
  <!-- <div class="row"> -->
  <!-- Earnings (Monthly) Card Example -->

  <!-- Earnings (Monthly) Card Example -->

  <!-- Earnings (Monthly) Card Example -->

  <!-- Pending Requests Card Example -->
  <!-- </div> -->

  <!-- Content Row -->

  <!-- Content Row -->
  <div class="row">
    <!-- Content Column -->
    <div class="col-lg-9 mb-4">
      <!-- Project Card Example -->
      <!-- Color System -->
      <div class="row">


        <?php
        $queryFirst = "SELECT * FROM admin";
        $res = mysqli_query($connection, $queryFirst);


        while ($res2 = mysqli_fetch_assoc($res)) {
          $urlStr = base64_encode(urlencode($res2['iD']));
        ?>

          <!--  -->

          <a href="InfoPage.php?SIDe=<?php echo $urlStr; ?>" class="col-lg-5 mb-4">
            <div class="card bg-primary text-white shadow">
              <div class="card-body">
                <?php echo $res2['Shop_name']; ?>
                <div class="text-white-50 small">
                  <?php echo $res2['Location']; ?>
                </div>
              </div>
            </div>
          </a>

          <!--<?php } ?>  -->


      </div>
    </div>

    <!-- Approach -->
  </div>
</div>
</div>
<!-- /.container-fluid -->