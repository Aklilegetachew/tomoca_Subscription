<!-- <?php include  '../config/db.php'; ?> -->

<?php include  'Sqlfunc.php'; ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Delivery Orders</h1>
    <p class="mb-4">

    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 displayBig">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Pickedup Delivery Orders
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="TableDeliveryPickedup">
                <table class="table table-bordered" id="dataTableDeliPik" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Order Number</th>
                            <th>Delivery Tracking</th>
                            <th>Status</th>

                            <th>Total Price</th>
                            <th>Action</th>
                            <th>Cart</th>

                            <?php if ($_SESSION['user_role'] == 'SuperAdmin') { ?>
                                <th> Shop </th>
                            <?php } ?>
                            <!-- -->
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="mainContainer" id="TableDeliveryMini">
    <div class="Nodata">
        <h6 v-if="pendingRow ==''" class="m-0 font-weight-bold text-primary">
            No new pick up orders
        </h6>
    </div>
    <div v-if="pendingRow !== ''">
        <div v-for="row in pendingRow" class="CustomCard">
            <div class="card border-left-primary shadow h-200">
                <button class=" CustomCard d-flex" @click="convertPending(row.ID,'DelPik')">
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

</div>
<!-- /.container-fluid -->
</div>