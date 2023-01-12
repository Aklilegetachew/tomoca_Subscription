<!-- <?php include  '../config/db.php'; ?> -->

<?php include  'Sqlfunc.php'; ?>

<div class="container-fluid  ">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Delivery Orders</h1>
        <button data-toggle="modal" data-target="#exampleModalCenter" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Sales Report</button>
    </div>
    <!-- Page Heading -->

    <p class="mb-4">

    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 displayBig">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Completed Delivery Orders
            </h6>
            <input class="dateReportInput t-check-in" type="text" name="daterange" value="" />
        </div>
        <div class="card-body">
            <div class="table-responsive" id="TableDeliveryCompleted">
                <table class="table table-bordered display nowrap" id="dataTableDelicom" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Order Number</th>
                            <th>Confirmation Date</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Cart</th>
                            <?php if ($_SESSION['user_role'] == 'SuperAdmin') { ?>
                                <th>Shop</th>
                            <?php } ?>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="TableDeliveryMini">
    <h6 class=" CustomCard m-0 font-weight-bold text-primary">
        Completed Delivery Orders
    </h6>
    <div v-for="row in completedRow" class="CustomCard">
        <div class="card border-left-primary shadow h-200">

            <button class=" CustomCard d-flex" @click="convertCompleted(row.ID,'DelCom')" id="cartCard">
                <div class="list-image mr-3">
                    <img class="rounded-circle_custom" src="img/logo.jpg" alt="...">
                </div>
                <div class="cardInfo">
                    <div class="">
                        <div class="text_list"> {{row.FirstName}}</div>
                        <div class="text_list">{{row.PhoneNumber}}</div>
                        <div class="text_list"> {{row.Total}} ETB</div>
                        <?php if ($_SESSION['user_role'] == 'SuperAdmin') { ?>
                            <div class="text_list text-gray-500">{{row.ShopLocation}}</div>
                        <?php } ?>
                    </div>
                </div>
            </button>
        </div>
    </div>
</div>


<!-- /.container-fluid  -->
</div>