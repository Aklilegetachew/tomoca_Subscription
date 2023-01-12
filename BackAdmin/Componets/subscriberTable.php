<?php include  './config/db.php'; ?>
<!--  -->
<?php include  'Sqlfunc.php'; ?>


<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Subscribers List</h1>
    <p class="mb-4">

    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                All Subscriber List
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="TableSubscribers">
                <table class="table table-bordered" id="dataTableSubscribes" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th>Full Name</th>
                            <th>Phone Number</th>
                            <th>Opening Date</th>
                            <th>Closing Date</th>
                            <th>Next Order Date</th>
                            <th>Order Type</th>
                            <th>Status</th>
                            <th>Detail</th>

                        </tr>
                    </thead>

                    <tbody>



                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>