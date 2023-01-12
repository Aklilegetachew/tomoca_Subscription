<?php include  'Sqlfunc.php'; ?>


<?php

$today = date("Y/m/d");
$currentMonth = date("M");
$currentYear = date("Y");

// $TotalCash = 10000;
// $NumberOrder = 45;
$result = DashBordInput($currentMonth, $currentYear);
// echo $result;
$startDate = $result["StartDate"];
$NumberOrder = $result["OrderNum"];
$TotalCash = $result["TotalCash"];
// $CoffeeType = $result["CoffeeType"];




?>


<div class="container-fluid">
  <!-- Page Heading -->
  <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate
      Report</a>
  </div> -->

  <!-- Content Row -->
  <div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Total Amount (Monthly)
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php echo number_format($TotalCash, 2) . "ETB"; ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Total Order (Monthly)
              </div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
                <?php echo $NumberOrder ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-truck fa-2x text-gray-300"></i>

            </div>
          </div>
        </div>
      </div>
    </div>



  </div>

  <!-- Content Row -->

  <div class="row">
    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">
            Earnings Overview
          </h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>

          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">
            Product Orders
          </h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body ">
          <div class="chart-pie pt-4 pb-2">
            <canvas id="myPieChart"></canvas>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-2">
              <i class="fas fa-circle color-circleAvatarDark"></i> BAR
            </span>
            <span class="mr-2">
              <i class="fas fa-circle color-circleAvatarMedium"></i> FAMIGLIA
            </span>
            <span class="mr-2">
              <i class="fas fa-circle color-circleAvatarLight"></i> TURKISH
            </span>
          </div>
        </div>



      </div>
    </div>

    <div class="card shadow mb-4 col-lg-8">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Shop location and number of orders</h6>
      </div>
      <div class="card-body">
        <div class="chart-bar">
          <canvas id="myBarChart"></canvas>
        </div>
        <hr>

      </div>
    </div>
  </div>

  <!-- Content Row -->

  <!-- /.container-fluid -->
</div>
</div>
<!-- End of Main Content -->