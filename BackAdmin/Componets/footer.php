<?php


?>


<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Versavvy 2022</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Select "Logout" below if you are ready to end your current session.
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                    Cancel
                </button>
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Successfully Completed order  -->

<div class="modal fade" id="CompleteModal" tabindex="-1" role="dialog" aria-labelledby="SucessesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example2ModalLabel">Complete order?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to complete order
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                    Cancel
                </button>
                <a class="btn btn-primary" href="function.php?UD=<?php echo $_GET['UD']; ?>&model=<?php echo $_GET['model']; ?>">Complete</a>
            </div>
        </div>
    </div>
</div>


<!-- piced up order from the row  -->


<div class="modal fade" id="CompleteModalRow" tabindex="-1" aria-labelledby="SucessesLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example2ModalLabel">Complete order?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to complete order
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                    Cancel
                </button>
                <a class="btn btn-primary" href="function.php?UD=<?php echo $urlStr; ?>&model=<?php echo $model; ?>">Complete</a>
            </div>
        </div>
    </div>
</div>

<!-- Picked Order -->

<div class="modal fade" id="PickModal" tabindex="-1" role="dialog" aria-labelledby="SucessesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example2ModalLabel">Picked order?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure the order is picked
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">
                    No
                </button>
                <a class="btn btn-primary" href="function.php?UD=<?php echo $_GET['UD']; ?>&model=<?php echo $_GET['model']; ?>">yes</a>
            </div>
        </div>
    </div>
</div>


<!--   DeleteModal-->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> Report options</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="m-0 font-weight-bold text-primary">
                    Choose options for report

                </h5>

                <form name="myForm" id="myForm" target="_myFrame" action="Componets/GenerateReport.php" method="POST">
                    <div>
                        <div>
                            <p>Start Date: <input class="dateReportInput" type="text" name="StartDate" id="datepickerStart" autocomplete="off"></p>
                        </div>

                        <div>
                            <p>End Date: <input class="dateReportInput" type="text" name="EndDate" id="datepickerEnd" autocomplete="off"></p>
                        </div>
                    </div>

                    <div>
                        <h6 class="m-0 font-weight-bold text-secondary">
                            Column options:
                        </h6>

                    </div>
                    <div class="btn-group-toggle" data-toggle="buttons">
                        <div>
                            <label class="btn btn-outline-primary active">
                                <input type="checkbox" autocomplete="off" name="Title"> Title +
                            </label>
                        </div>
                        <div>
                            <label class="btn btn-outline-primary active">
                                <input type="checkbox" autocomplete="off" name="Quantity"> Quantity +
                            </label>
                        </div>

                        <div>
                            <label class="btn btn-outline-primary active">
                                <input type="checkbox" autocomplete="off" name="price"> Price +
                            </label>
                        </div>

                        <div>
                            <label class="btn btn-outline-primary active">
                                <input type="checkbox" autocomplete="off" name="Amount"> Amount +
                            </label>
                        </div>

                        <div>
                            <label class="btn btn-outline-primary active">
                                <input type="checkbox" autocomplete="off" name="Description"> Description +
                            </label>
                        </div>

                        <div>
                            <label class="btn btn-outline-primary active">
                                <input type="checkbox" autocomplete="off" name="size"> Size +
                            </label>
                        </div>

                        <div>
                            <label class="btn btn-outline-primary active">
                                <input type="checkbox" autocomplete="off" name="Roast"> Roast +
                            </label>
                        </div>
                        <div>
                            <label class="btn btn-outline-primary active">
                                <input type="checkbox" autocomplete="off" name="Total"> Sum Total +
                            </label>
                        </div>

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" value="Report" name="report">Generate Report</button>
            </div>
            </form>
        </div>
    </div>
</div>





<!-- <form name="pushFormz" action="pusherNotification.php" method="POST" id="pushForm"> -->
<form name="myForm" id="myForm" target="_myFrame" action="Componets/pusherNotification.php" method="POST">
    <input name="username" type="hidden" id="username" />
    <input name="Date" type="hidden" id="Date" />
    <input name="newOrder" type="hidden" id="newOrder" />
    <input name="num" type="hidden" id="num" value="1" />
    <input class="btn-hidden" type="submit" name="btnsubmit" value="Submit" id="subHid" />


</form>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    var selectedDate
    $('input[name="StartDate"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 2022,
        maxYear: parseInt(moment().format('YYYY'), 10)
    }, function(start, end, label) {
        selectedDate = start;
        console.log(selectedDate)
    });

    $('input[name="StartDate"]').on('apply.daterangepicker', function(ev, picker) {
        $('input[name="EndDate"]').val(picker.startDate.format('MM-DD-YYYY'));
    });


    $('input[name="EndDate"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        startDate: selectedDate,
        minYear: 2022,
        maxYear: parseInt(moment().format('YYYY'), 10),

    }, function(start, end, label) {


    });
</script>

<script type="text/javascript">
    const alert1 = Vue.createApp({
        data() {
            return {
                newAlerts: [],
                unread: 0
            }
        },
        methods: {

            fetchAlerts() {
                axios.post('./Componets/fetch.php', {
                    action: "all"
                }).then(res => {
                    this.newAlerts = res.data

                })
            },
            async unreadAlerts(yes = "") {
                await axios.post('./Componets/fetch.php', {
                    action: 'count',
                    view: yes
                }).then(res => {
                    this.unread = res.data
                })
            }
        },

        created() {
            this.fetchAlerts()
            this.unreadAlerts("")
            var pusher = new Pusher('e5fe60b6bb6d56b8b93e', {
                cluster: 'us2',
                encrypted: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', async (data) => {
                var notification = JSON.stringify(data);
                // alert(notification);
                let shopLoc = "<?php echo $_SESSION['shopname'] ?>";

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


                this.fetchAlerts()
                this.unreadAlerts("")
            });

            ///////////////////////////////// Yes or NO   ///////////////////////////////////


            channel.bind('my-eventConfirm', async (data) => {
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

                    })

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
                    })


                }

                this.fetchAlerts()
                this.unreadAlerts("")
            });





        }
    }).mount("#alerts")
</script>

<!-- ================================= Subscription List Table ========================================== -->

<script>
    const subscribers = Vue.createApp({

        data() {
            return {
                newRow: []
            }
        },
        methods: {
            fetchTableRow() {
                axios.post('./Componets/fetchTable.php', {
                    action: "allSubscribers"
                }).then(res => {
                    this.newRow = res.data
                    console.log(res.data);
                    this.table(res.data)
                })
            },

            CartView(Id, Mode) {
                console.log("hey");
                urlcart = "subDetail.php?ID=" + Id
                window.location.href = urlcart
                // axios.post('./Convert.php', {
                //     action: "Convert",
                //     id: Id,
                //     mode: Mode
                // }).then(res => {
                //     // this.newRow = res.data
                //     console.log(res.data);
                //     console.log(res.data[0]);
                //     console.log(res.data);
                //     UID = res.data[0];
                //     Model = res.data[1]
                //     urlcart = "Cart.php?UD=" + UID + "&model=" + Model
                //     window.location.href = urlcart
                //     // this.table(res.data)
                // })

            },
            table(row) {
                var tables = $('#dataTableSubscribes').DataTable({

                    data: row,
                    columns: [{
                            data: 'sub_name'
                        },
                        {
                            data: 'sub_phone'
                        },
                        {
                            data: 'sub_startingDate'
                        },
                        {
                            data: 'sub_endDate'
                        },
                        {
                            data: 'next_orderDate'
                        },
                        {
                            data: 'orderType'
                        },
                        {
                            data: 'payment_status'
                        },
                        {
                            data: 'id',
                            render: function(data) {

                                return `<a  id="cart" data-id="${data}" class="btn btn-success btn-icon-split">
                                         <span class="icon text-white-50">
                                             <i class="fas fa-shopping-cart"></i>
                                         </span>
                                         <span class="text">Detail</span>
                                     </a>`
                            }
                        }
                    ],
                });




                let vm = this

                $(document).on('click', '#cart', function() {

                    let ids = $(this).data("id")
                    console.log(ids);
                    vm.CartView(ids, 'pik')

                })

            },

        },

        created() {
            this.fetchTableRow()
            var pusher = new Pusher('e5fe60b6bb6d56b8b93e', {
                cluster: 'us2',
                encrypted: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', async (data) => {
                this.fetchTableRow()

            });

            var channel2 = pusher.subscribe('my-channel');
            channel2.bind('my-eventConfirm', async (data) => {
                this.fetchTableRow()

            });


        }


    }).mount("#TableSubscribers")
</script>

<!-- ============================= Upcoming Orders ======================================================= -->

<script>
    const upcomming = Vue.createApp({

        data() {
            return {
                newRow: []
            }
        },
        methods: {
            fetchTableRow() {
                axios.post('./Componets/fetchTable.php', {
                    action: "upcomingOrders"
                }).then(res => {
                    this.newRow = res.data
                    console.log(res.data);
                    this.table(res.data)
                })
            },

            CartView(Id, Mode) {
                console.log("hey");
                urlcart = "subDetail.php?ID=" + Id
                window.location.href = urlcart
            },
            table(row) {
                var tables = $('#dataTableUpcomming').DataTable({

                    data: row,
                    columns: [{
                            data: 'sub_name'
                        },
                        {
                            data: 'sub_phone'
                        },
                        {
                            data: 'sub_startingDate'
                        },
                        {
                            data: 'sub_endDate'
                        },
                        {
                            data: 'next_orderDate'
                        },
                        {
                            data: 'orderType'
                        },
                        {
                            data: 'payment_status'
                        },
                        {
                            data: 'id',
                            render: function(data) {

                                return `<a  id="cart" data-id="${data}" class="btn btn-success btn-icon-split">
                                         <span class="icon text-white-50">
                                             <i class="fas fa-shopping-cart"></i>
                                         </span>
                                         <span class="text">Detail</span>
                                     </a>`
                            }
                        }
                    ],
                });




                let vm = this

                $(document).on('click', '#cart', function() {

                    let ids = $(this).data("id")
                    console.log(ids);
                    vm.CartView(ids, 'pik')

                })

            },

        },

        created() {
            this.fetchTableRow()
            var pusher = new Pusher('e5fe60b6bb6d56b8b93e', {
                cluster: 'us2',
                encrypted: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', async (data) => {
                this.fetchTableRow()

            });

            var channel2 = pusher.subscribe('my-channel');
            channel2.bind('my-eventConfirm', async (data) => {
                this.fetchTableRow()

            });


        }


    }).mount("#TableUpComming")
</script>







<!-- ============================= Pick UP =============================== -->

<script>
    const alert2 = Vue.createApp({

        data() {
            return {
                newRow: []
            }
        },
        methods: {
            fetchTableRow() {
                axios.post('./Componets/fetchTable.php', {
                    action: "all"
                }).then(res => {
                    this.newRow = res.data
                    console.log(res.data);
                    this.table(res.data)
                })
            },

            CartView(Id, Mode) {

                urlcart = "subCart.php?ID=" + Id
                window.location.href = urlcart
                console.log("hey");
                // axios.post('./Convert.php', {
                //     action: "Convert",
                //     id: Id,
                //     mode: Mode
                // }).then(res => {
                //     // this.newRow = res.data
                //     console.log(res.data);
                //     console.log(res.data[0]);
                //     console.log(res.data);
                //     UID = res.data[0];
                //     Model = res.data[1]
                //     urlcart = "Cart.php?UD=" + UID + "&model=" + Model
                //     window.location.href = urlcart
                //     // this.table(res.data)
                // })

            },
            table(row) {
                var tables = $('#dataTablePick').DataTable({
                    // destroy: true,
                    // dom: 'lBfrtip',
                    // buttons: [
                    //     'excel',
                    //     'print',
                    //     'csv'
                    // ],

                    data: row,
                    // columns: [{
                    //         data: 'FirstName'
                    //     },
                    //     {
                    //         data: 'PhoneNumber'
                    //     },
                    //     {
                    //         data: 'TransactionID'
                    //     },
                    //     {
                    //         data: 'NumProduct'
                    //     },
                    //     {
                    //         data: 'TotalAmount'
                    //     },
                    //     {
                    //         data: 'ID',
                    //         render: function(data) {

                    //             return `<a  id="cart" data-id="${data}" class="btn btn-success btn-icon-split">
                    //                      <span class="icon text-white-50">
                    //                          <i class="fas fa-shopping-cart"></i>
                    //                      </span>
                    //                      <span class="text">Cart List</span>
                    //                  </a>`
                    //         }
                    //     }
                    // ],
                    columns: [{
                            data: 'FirstName'
                        },
                        {
                            data: 'PhoneNumber'
                        },
                        {
                            data: 'TransactionID'
                        },
                        {
                            data: 'TotalAmount'
                        },
                        {
                            data: 'Pickstatus'
                        },
                        {
                            data: 'ID',
                            render: function(data) {

                                return `<a  id="cart" data-id="${data}" class="btn btn-success btn-icon-split">
                                         <span class="icon text-white-50">
                                             <i class="fas fa-shopping-cart"></i>
                                         </span>
                                         <span class="text">Detail</span>
                                     </a>`
                            }
                        },
                        {
                            data: 'ShopLocation'
                        }
                    ],
                });




                let vm = this

                $(document).on('click', '#cart', function() {

                    let ids = $(this).data("id")
                    console.log(ids);
                    vm.CartView(ids, 'pik')

                })

            },

        },

        created() {
            this.fetchTableRow()
            var pusher = new Pusher('e5fe60b6bb6d56b8b93e', {
                cluster: 'us2',
                encrypted: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', async (data) => {
                this.fetchTableRow()

            });

            var channel2 = pusher.subscribe('my-channel');
            channel2.bind('my-eventConfirm', async (data) => {
                this.fetchTableRow()

            });


        }


    }).mount("#TableReal")
</script>



<script>
    const alert3 = Vue.createApp({

        data() {
            return {
                newRow: ''
            }
        },
        methods: {
            fetchTableRowDelivery() {
                axios.post('./Componets/fetchTable.php', {
                    action: "allDelivery"
                }).then(res => {
                    this.newRow = res.data
                    console.log(this.newRow)
                    this.table(res.data)
                })
            },

            CartViewDel(Id, Mode) {
                axios.post('./Convert.php', {
                    action: "Convert",
                    id: Id,
                    mode: Mode
                }).then(res => {
                    // this.newRow = res.data
                    console.log(res.data);
                    console.log(res.data[0]);
                    console.log(res.data);
                    UID = res.data[0];
                    Model = res.data[1]
                    urlcart = "CartPicked.php?UD=" + UID + "&model=" + Model
                    window.location.href = urlcart
                    // this.table(res.data)
                })

            },
            table(row) {
                $('#dataTableDeli').DataTable({

                    data: row,
                    columns: [{
                            data: 'FirstName'
                        },
                        {
                            data: 'PhoneNumber'
                        },
                        {
                            data: 'OrderNumber'
                        },
                        {
                            data: 'DeliveryID'
                        },
                        {
                            data: 'Total'
                        },
                        {
                            data: 'DeliveryUrl',
                            render: function(data) {

                                return `<a href="${data}" target="_blank">Click here..</a>`
                            }
                        },
                        {

                            render: function() {

                                return "Pending"
                            }
                        },
                        {
                            data: 'ID',
                            render: function(data) {

                                return `<a  id="cart" data-id="${data}" class="btn btn-success btn-icon-split">
                                         <span class="icon text-white-50">
                                             <i class="fas fa-shopping-cart"></i>
                                         </span>
                                         <span class="text">Detail</span>
                                     </a>`
                            }
                        },
                        <?php if ($_SESSION['user_role'] == 'SuperAdmin') { ?> {
                                data: 'ShopLocation'
                            },
                        <?php }  ?>
                    ],
                });


                let vm = this


                $(document).on('click', '#cart', function() {

                    let ids = $(this).data("id")
                    console.log(ids);
                    vm.CartViewDel(ids, 'Del')

                })

            },

        },

        created() {
            this.fetchTableRowDelivery()
            var pusher = new Pusher('e5fe60b6bb6d56b8b93e', {
                cluster: 'us2',
                encrypted: true
            });

            var channel3 = pusher.subscribe('my-channel');
            channel3.bind('my-eventConfirm', async (data) => {
                this.fetchTableRowDelivery()

            });

            channel3.bind('my-event', async (data) => {
                this.fetchTableRowDelivery()

            });


        }


    }).mount("#TableDelivery")
</script>

<script>
    const miniViews = Vue.createApp({
        data() {
            return {
                newRowMini: '',
                pendingRow: '',
                completedRow: '',
                urlNew: '',
                urlPending: '',
                urlCompleted: ''
            }
        },
        methods: {
            fetchDeliveryTable() {
                axios.post('./Componets/fetchTable.php', {
                    action: "allDelivery"
                }).then(res => {
                    this.newRowMini = res.data
                    console.log(this.newRowMini)

                })

            },
            fetchPendingTable() {
                axios.post('./Componets/fetchTableCompleted.php', {
                    action: "PickedAll"
                }).then(res => {
                    this.pendingRow = res.data

                })

            },
            fetchCompletedTable() {
                axios.post('./Componets/fetchTableCompleted.php', {
                    action: "fetchAllCompleted",
                }).then(res => {
                    this.completedRow = res.data
                })
            },

            convertCompleted(Id, Mode) {
                axios.post('./Convert.php', {
                    action: "Convert",
                    id: Id,
                    mode: Mode
                }).then(res => {
                    UID = res.data[0];
                    Model = res.data[1]
                    urlcart = "CartCompleted.php?UD=" + UID + "&model=" + Model
                    window.location.href = urlcart

                })

            },

            convertNew(Id, Mode) {
                axios.post('./Convert.php', {
                    action: "Convert",
                    id: Id,
                    mode: Mode
                }).then(res => {

                    UID = res.data[0];
                    Model = res.data[1]
                    urlcart = "CartPicked.php?UD=" + UID + "&model=" + Model
                    window.location.href = urlcart

                })
            },
            convertPending(Id, Mode) {
                axios.post('./Convert.php', {
                    action: "Convert",
                    id: Id,
                    mode: Mode
                }).then(res => {

                    UID = res.data[0];
                    Model = res.data[1]
                    urlcart = "Cart.php?UD=" + UID + "&model=" + Model
                    window.location.href = urlcart

                })
            }



        },
        created() {
            this.fetchDeliveryTable()
            this.fetchPendingTable()
            this.fetchCompletedTable()
            $(document).on('click', '#cartCard', function() {

                let ids = this.ID
                console.log(ids);
                // vm.CartViewDel(ids, 'Del')

            })
        }

    }).mount("#TableDeliveryMini")
</script>

<script>
    const alert4 = Vue.createApp({

        data() {
            return {
                newRow: [],
                startDay: '',
                EndDay: ''
            }
        },
        methods: {
            CartViewDel(Id, Mode) {
                console.log("hey");
                axios.post('./Convert.php', {
                    action: "Convert",
                    id: Id,
                    mode: Mode
                }).then(res => {

                    console.log(res.data);
                    console.log(res.data[0]);
                    console.log(res.data);
                    UID = res.data[0];
                    Model = res.data[1]
                    urlcart = "CartCompleted.php?UD=" + UID + "&model=" + Model
                    window.location.href = urlcart

                })

            },

            fetchTableRowDelivery() {
                axios.post('./Componets/fetchTableCompleted.php', {
                    action: "allDelivery"
                }).then(res => {
                    this.newRow2 = res.data
                    console.log(res.data)
                    this.table(res.data)
                })
            },

            fetchTableRowDeliveryCompleted(Sdate, Edate) {
                axios.post('./Componets/fetchTableCompleted.php', {
                    action: "ByDate",
                    startDate: Sdate,
                    endDate: Edate
                }).then(res => {
                    this.newRow2 = res.data
                    console.log(res.data)
                    this.table(res.data)
                })
            },
            table(row) {
                $('#dataTableDelicom').DataTable({
                    backed: this,
                    destroy: true,
                    data: row,
                    columns: [{
                            data: 'FirstName'
                        },
                        {
                            data: 'PhoneNumber'
                        },
                        {
                            data: 'OrderNumber'
                        },
                        {
                            data: 'Confirmdate'
                        },
                        {
                            data: 'Total'
                        },

                        {
                            render: function() {
                                return "Completed"
                            }

                        },

                        {
                            data: 'ID',
                            render: function(data) {

                                return `<a  id="cart2" data-id="${data}" class="btn btn-success btn-icon-split">
                                         <span class="icon text-white-50">
                                             <i class="fas fa-shopping-cart"></i>
                                         </span>
                                         <span class="text">Cart List</span>
                                     </a>`
                            }
                        },

                        <?php if ($_SESSION['user_role'] == 'SuperAdmin') { ?> {
                                data: 'ShopLocation'
                            },
                        <?php }  ?>
                    ],
                });


                let vm = this


                $(document).on('click', '#cart2', function() {

                    let ids = $(this).data("id")
                    console.log(ids);
                    vm.CartViewDel(ids, 'DelCom')

                })
            },

            datePickerFunc() {

                vm2 = this
                var today = new Date()
                $('input[name="daterange"]').daterangepicker({
                    opens: 'right',

                }, function(start, end, label) {
                    startDate: today,
                    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                    var start = start.format('YYYY-MM-DD');
                    var end = end.format('YYYY-MM-DD');

                    if (start && end) {
                        vm2.fetchTableRowDeliveryCompleted(start, end)
                    }

                });

            },
        },

        created() {
            this.fetchTableRowDelivery()
            this.datePickerFunc()
            // this.Exporter()

        }


    }).mount("#TableDeliveryCompleted")
</script>



<script>
    const picked = Vue.createApp({

        data() {
            return {
                newRow: [],
                UID: '',
                Model: '',
                showModalBoolen: false

            }
        },
        methods: {
            CartViewDelPicked(Id, Mode) {

                axios.post('./Convert.php', {
                    action: "Convert",
                    id: Id,
                    mode: Mode
                }).then(res => {
                    UID = res.data[0];
                    Model = res.data[1]
                    urlcart = "Cart.php?UD=" + UID + "&model=" + Model
                    window.location.href = urlcart
                })

            },
            ModalAperance(UID, Model) {
                this.showModalBoolen = true
                $('#CompleteModalRow').modal('show')
                console.log(this.showModalBoolen)
            },

            completePickedup(Id, Mode) {
                axios.post('./Convert.php', {
                    action: "Convert",
                    id: Id,
                    mode: Mode
                }).then(res => {
                    UID = res.data[0]
                    Model = res.data[1]
                    // this.ModalAperance(this.UID, this.Model)
                    urlcart = "function.php?UD=" + UID + "&model=" + Model
                    window.location.href = urlcart
                })

            },

            fetchTableRowDeliveryPicked() {
                axios.post('./Componets/fetchTableCompleted.php', {
                    action: "PickedAll"
                }).then(res => {
                    this.newRow2 = res.data
                    console.log(res.data)
                    this.table(res.data)
                })
            },
            table(row) {
                $('#dataTableDeliPik').DataTable({
                    backed: this,
                    destroy: true,
                    data: row,
                    columns: [{
                            data: 'FirstName'
                        },
                        {
                            data: 'PhoneNumber'
                        },
                        {
                            data: 'OrderNumber'
                        },
                        {
                            data: 'DeliveryUrl',
                            render: function(data) {

                                return `<a href="${data}" target="_blank">Click here..</a>`
                            }
                        },
                        {
                            data: 'ID',
                            render: function(data) {

                                return "picked"
                            }
                        },
                        {
                            data: 'Total'
                        },

                        {
                            data: 'ID',
                            render: function(data) {

                                return ` <a id="completeOrder" data-id="${data}"  class="btn btn-success btn-icon-split ">
                                        <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Complete Order</span>
                                    </a>`
                            }
                        },

                        {
                            data: 'ID',
                            render: function(data) {

                                return `<a  id="cartPicked" data-id="${data}" class="btn btn-back btn-success btn-icon-split ">
                                         <span class="icon text-white-50">
                                             <i class="fas fa-shopping-cart"></i>
                                         </span>
                                         <span class="text">Cart List</span>
                                     </a>`
                            }
                        },

                        <?php if ($_SESSION['user_role'] == 'SuperAdmin') { ?> {
                                data: 'ShopLocation'
                            },
                        <?php }  ?>
                    ],
                });


                let vm = this


                $(document).on('click', '#cartPicked', function() {

                        let ids = $(this).data("id")
                        console.log(ids);
                        vm.CartViewDelPicked(ids, 'DelPik')

                    }),

                    $(document).on('click', '#completeOrder', function() {

                        let ids = $(this).data("id")
                        console.log(ids);
                        vm.completePickedup(ids, 'DelPik')

                    })



            },
        },

        created() {
            this.fetchTableRowDeliveryPicked()
            var pusher = new Pusher('e5fe60b6bb6d56b8b93e', {
                cluster: 'us2',
                encrypted: true
            });
            var channelConfirm = pusher.subscribe('my-channel');
            channelConfirm.bind('my-eventUpdateTable', async (data) => {
                this.fetchTableRowDeliveryPicked()

            });
            // this.datePickerFunc()
            // this.Exporter()

        }


    }).mount("#TableDeliveryPickedup")
</script>

<!-- Bootstrap core JavaScript-->

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Core plugin JavaScript-->

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<script src="js/demo/chart-bar-demo.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->

<script src="public/theme/js/t-datepicker.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
    // $(function() {
    //     var dateFormat = "mm/dd/yy";
    //     var minDatefrom;
    //     $("#datepickerStart").datepicker().on("change", function() {
    //         console.log(getDate(this));
    //         to.datepicker("option", "minDate", getDate(this));
    //     });
    //     to = $("#datepickerEnd").datepicker({

    //     });


    //     function getDate(element) {
    //         var date;
    //         try {
    //             date = $.datepicker.parseDate(dateFormat, element.value);
    //         } catch (error) {
    //             date = null;
    //         }

    //         return date;
    //     }


    // });
</script>


<script>

</script>


</body>

</html>