<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark daccordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="./Dashboard.php">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class=""></i>
    </div>
    <div class="sidebar-brand-text mx-3">TOMOCA Admin <sup>2</sup></div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0" />

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="./Dashboard.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider" />

  <!-- Heading -->
  <div class="sidebar-heading">Orders</div>
  <!-- ========================  For subscription use  =================================================== -->


  <li class="nav-item" type="hidden">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
      <!-- <i class="fas fa-cart-arrow-down"></i>
      <i class="bi bi-person-circle"></i> -->
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
      </svg>
      <span>Subscribers</span>
    </a>
    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Subscribers:</h6>
        <a class="collapse-item" href="./subscribersList.php">Subscribers</a>
        <a class="collapse-item" href="./upCommingOrder.php">Upcomming Orders</a>
      </div>
    </div>
  </li>

  <!-- ========================  For future use  =================================================== -->

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item" type="hidden">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-cart-arrow-down"></i>
      <span>Pickup Orders</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">pickup orders:</h6>
        <a class="collapse-item" href="./PickOrder.php">Orders</a>
        <a class="collapse-item" href="./PickUpCompleted.php">Completed</a>
      </div>
    </div>
  </li>

  <!-- ========================  For future use  =================================================== -->

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-truck"></i>
      <span>Delivery Orders</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Delivery Orders:</h6>
        <a class="collapse-item" href="./DeliveryOrder.php">Orders</a>
        <a class="collapse-item" href="PickedUp.php">Pickedup</a>
        <a class="collapse-item" href="deliveryCompleted.php">Completed</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider" />

  <!-- Heading -->
  <?php
  if ($_SESSION['user_role'] == "SuperAdmin") {
  ?>
    <div class="sidebar-heading">Shops</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Manage Shops</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Shop Tools:</h6>
          <a class="collapse-item" href="shop.php">Shop List</a>
          <a class="collapse-item" href="signup.php">Add New Shop</a>
          <a class="collapse-item" href="addSubscription.php">Add New Subscription</a>
          <!-- <a class="collapse-item" href="forgot-password.html">Complete Orders</a> -->
        </div>
      </div>
    </li>
  <?php
  }
  ?>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block" />

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>