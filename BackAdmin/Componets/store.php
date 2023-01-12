<?php



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var channel = pusher.subscribe('my-channel'); channel.bind('my-event', async function(data) {
    var notification = JSON.stringify(data);
    // alert(notification);
    let shopLoc = "<?php echo $_SESSION['shopname'] ?>";
    console.log(data.shop);
    console.log(data.name);
    console.log(shopLoc);
    var newOrder = data.message;
    var SelectedShop = data.shop;
    var name = data.name;
    var orderday = data.Orderdate;
    var loggedShop = shopLoc;
    let shopLocation = SelectedShop;

    axios.post('Componets/pusherNotification.php', {
        action: 'submit',
        name: name,
        Orderday: orderday,
        NewOrder: newOrder,
        shopName: shopLocation
    })

    if (loggedShop == shopLocation) {
        console.log("then");
        // window.location.reload();
        ////////////////////////// try ////////////////

        // function load_unseen_notification(view = '') {
        //     $.ajax({
        //         url: "fetch.php",
        //         method: "POST",
        //         data: {
        //             view: view
        //         },
        //         dataType: "json",
        //         success: function(data) {
        //             $('.dropdown-menu').html(data.notification);
        //             if (data.unseen_notification > 0) {
        //                 $('.count').html(data.unseen_notification);
        //             }
        //         }
        //     });
        // }




        $('#noteMode').load("Componets/notifAlert.php", {
            name: name,
            Orderday: orderday,
            NewOrder: newOrder,
            shopName: shopLocation

        }).then(res => {
            console.log("then2");
            $('#notifynum').load("Componets/notifAlertpin.php")
        })
    }

    if (loggedShop == "Central") {
        $('#noteMode').load("Componets/notifAlert.php", {
            name: name,
            Orderday: orderday,
            NewOrder: newOrder,
            shopName: shopLocation

        })
        $('#notifynum').load("Componets/notifAlertpin.php")

    }
});

///////////////////////////////////////////////////////////////////////////////////////////////////////////////



channel.bind('my-eventConfirm', async function(data) {

    var newConfirmation = data.message
    var Confirmationdate = data.Orderdate
    var OrderNum = data.OrderNumber
    var Confirmtime = data.OrderTime
    let shopLoc = "<?php echo $_SESSION['shopname'] ?>";


    console.log(newConfirmation)
    if (OrderNum.substr(0, 3) == "YES") {
        strNumber = OrderNum.substring(3)

        axios.post('Componets/UserNotification.php', {
            action: 'submit',
            Status: "YES",
            confirmday: Confirmationdate,
            NumOrder: strNumber,
            Conftime: Confirmtime
        }).then(res => {
            console.log(res.data)
            if (res.data == shopLoc) {
                $('#noteMode').load("Componets/notifAlert.php", {
                    name: "Denied",
                    Orderday: Confirmationdate,
                    NewOrder: newConfirmation,
                    shopName: res.data

                })
                $('#notifynum').load("Componets/notifAlertpin.php")

            } else if (shopLoc == "Central") {

                $('#noteMode').load("Componets/notifAlert.php", {
                    name: "Denied",
                    Orderday: Confirmationdate,
                    NewOrder: newConfirmation,
                    shopName: res.data

                })
                $('#notifynum').load("Componets/notifAlertpin.php")
            }
        })
        // $('#notifynum').load("Componets/notifAlertpin.php")


    } else if (OrderNum.substr(0, 2) == "NO") {

        strNumber = OrderNum.substring(2)

        axios.post('Componets/UserNotification.php', {
            action: 'submit',
            Status: "NO",
            confirmday: Confirmationdate,
            NumOrder: strNumber,
            Conftime: Confirmtime
        }).then(res => {
            console.log(res.data)
            if (res.data == shopLoc) {
                $('#noteMode').load("Componets/notifAlert.php", {
                    name: "Denied",
                    Orderday: Confirmationdate,
                    NewOrder: newConfirmation,
                    shopName: res.data

                })
                $('#notifynum').load("Componets/notifAlertpin.php")

            } else if (shopLoc == "Central") {

                $('#noteMode').load("Componets/notifAlert.php", {
                    name: "Denied",
                    Orderday: Confirmationdate,
                    NewOrder: newConfirmation,
                    shopName: res.data

                })
                $('#notifynum').load("Componets/notifAlertpin.php")

            }

        })


    }


});


///////////////////////////////////////////////////////////////////////////////////////////////
<!-- <a class="dropdown-item d-flex align-items-center" href=<?php echo  $row["UrlOrder"]; ?>>
<div class="mr-3">
    <div class="icon-circle bg-primary">
        <i class="fas fa-file-alt text-white"></i>
    </div>
</div>
<div>
    <div class="small text-gray-500" id="notifyday">
        <?php echo  $row["dateOrder"]; ?>
    </div>
    <span class="font-weight-bold" id="notifyMsg">
        <?php echo  $row["newOrder"]; ?>

    </span>
    <div class="text-gray-500" id="notifytype">

        <?php echo  $row["ShopLocation"]; ?>
    </div>
</div>
</a> -->



///////////////////////////////////////////////////////////
<?php if ($_SESSION['shopname'] == "Central") {
    $respo = getshopNotificationAll();
    foreach ($respo as $row) {
?> <div id="noteMode"> </div>
        <!-- <a class="dropdown-item d-flex align-items-center" href=<?php echo  $row["UrlOrder"]; ?>>
            <div class="mr-3">
                <div class="icon-circle bg-primary">
                    <i class="fas fa-file-alt text-white"></i>
                </div>
            </div>
            <div>
                <div class="small text-gray-500" id="notifyday">
                    <?php echo  $row["dateOrder"]; ?>
                </div>
                <span class="font-weight-bold" id="notifyMsg">
                    <?php echo  $row["newOrder"]; ?>

                </span>
                <div class="text-gray-500" id="notifytype">

                    <?php echo  $row["ShopLocation"]; ?>
                </div>
            </div>
        </a> -->

    <?php } ?>
    <?php } else {
    $respo = getshopNotification($_SESSION['shopname']);
    foreach ($respo as $row) {
    ?>

        <div id="noteMode"></div>
        <a class="dropdown-item d-flex align-items-center" href="#">
            <div class="mr-3">
                <div class="icon-circle bg-primary">
                    <i class="fas fa-bell fa-fw text-white"></i>
                </div>
            </div>
            <div>
                <div class="small text-gray-500" id="notifyday">
                    <?php echo  $row["dateOrder"]; ?>
                </div>
                <span class="font-weight-bold" id="notifyMsg">

                    <?php echo  $row["newOrder"]; ?>
                </span>
                <div class="text-gray-500" id="notifytype">

                    <?php echo  $row["CustomerName"]; ?>
                </div>
            </div>
        </a>

    <?php } ?>
<?php } ?>






/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

<!-- <?php include  './config/db.php'; ?> -->
<!--  -->
<?php include  'Sqlfunc.php'; ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Delivery Orders</h1>
    <p class="mb-4">

    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Pickedup Delivery Orders
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Order Number</th>
                            <th>Delivery Tracking</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Cart</th>

                            <?php if ($_SESSION['user_role'] == 'SuperAdmin') { ?>
                                <th> Shop </th>

                        </tr>
                    </thead>
                    <?php $i = 1; ?>
                    <tbody>
                        <?php
                                $response = getDeliveryPickedOrders($_SESSION['user_role'], $_SESSION['location']);

                                foreach ($response as $row) {
                                    $urlStr = base64_encode(urlencode($row['ID']));
                                    $model = base64_encode(urlencode('DelPik'));
                        ?>

                            <tr>

                                <td><?php echo $row['FirstName'] . " " . $row['LastName'];    ?></td>
                                <td><?php echo $row['PhoneNumber']; ?></td>
                                <td><?php echo $row['OrderNumber']; ?></td>
                                <td><a href=<?php echo $row['DeliveryUrl']; ?>> click here </a></td>
                                <td>pending</td>
                                <td><?php echo $row['Total']; ?> ETB</td>
                                <td> <a href="function.php?UD=<?php echo $urlStr; ?>&model=<?php echo $model; ?>" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#CompleteModalRow">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Complete Order</span>
                                    </a>
                                </td>
                                <td>
                                    <a href="Cart.php?UD=<?php echo $urlStr; ?>&model=<?php echo $model; ?>" class=" btn btn-back btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-shopping-cart"></i>
                                        </span>
                                        <span class="text">Cart List</span>
                                    </a>
                                </td>
                                <td><?php echo $row['ShopLocation']; ?></td>


                                <?php $i++; ?>
                            </tr>

                        <?php } ?>
                        <?php } elseif ($_SESSION['user_role'] != 'SuperAdmin') {
                                $response = getDeliveryPickedOrders($_SESSION['user_role'], $_SESSION['shopname']);
                                foreach ($response as $row) {
                                    $urlStr = base64_encode(urlencode($row['ID']));
                                    $model = base64_encode(urlencode('DelPik')); ?>
                            <tr>
                                <td><?php echo $row['FirstName'] . " " . $row['LastName'];    ?></td>
                                <td><?php echo $row['PhoneNumber']; ?></td>
                                <td><?php echo $row['OrderNumber']; ?></td>
                                <td><a href=<?php echo $row['DeliveryUrl']; ?>> click here </a></td>
                                <td><?php echo $row['Total']; ?> ETB</td>
                                <td>
                                    <a href="function.php?UD=<?php echo $urlStr; ?>&model=<?php echo $model; ?>" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="CompleteModalRow">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Complete Order</span>
                                    </a>
                                </td>
                                <td>pending</td>
                                <td>
                                    <a href="Cart.php?UD=<?php echo $urlStr; ?>&model=<?php echo $model; ?>" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-shopping-cart"></i>
                                        </span>
                                        <span class="text">Cart List</span>
                                    </a>
                                </td>
                            </tr>
                        <?php }  ?>
                    <?php }  ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
