 <?php include  './config/db.php'; ?>
 <!--  -->
 <?php include  'Sqlfunc.php'; ?>


 <div class="container-fluid">
     <!-- Page Heading -->
     <h1 class="h3 mb-2 text-gray-800">Pickup Orders</h1>
     <p class="mb-4">

     </p>

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">
                 New Pickup Orders
             </h6>
         </div>
         <div class="card-body">
             <div class="table-responsive" id="TableReal">
                 <table class="table table-bordered" id="dataTablePick" width="100%" cellspacing="0">
                     <thead>
                         <tr>

                             <th>Full Name</th>
                             <th>Phone Number</th>
                             <th>Transaction Number</th>
                             <th>Total</th>
                             <th>Status</th>
                             <th>Detail</th>
                             <th>Shop</th>


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