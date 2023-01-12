<?php ?>

<?php include  'SqlFunctionB.php'; ?>
<?php session_start(); ?>


<thead>

    <tr>

        <th>Name</th>
        <th>Phone Number</th>
        <th>Order Number</th>
        <th>Qty</th>

        <th>Total Price</th>
        <th>Status</th>
        <th>Cart</th>

        <?php if ($_SESSION['user_role'] == 'SuperAdmin') { ?>
            <th> Shop </th>

    </tr>
</thead>
<?php $i = 1; ?>
<tbody>
    <?php
            $response = getPickupOrders($_SESSION['user_role'], $_SESSION['shopname']);

            foreach ($response as $row) {
                $urlStr = base64_encode(urlencode($row['ID']));
                $model = base64_encode(urlencode("pik"));
    ?>

        <tr>

            <td><?php echo $row['FirstName'] . " " . $row['LastName'];    ?></td>
            <td><?php echo $row['PhoneNumber']; ?></td>
            <td><?php echo $row['TransactionID']; ?></td>
            <td><?php echo $row['NumProduct']; ?></td>
            <td><?php echo $row['TotalAmount']; ?> ETB</td>
            <td>pending</td>
            <td>
                <a href="Cart.php?UD=<?php echo $urlStr; ?>&model=<?php echo $model; ?>" class="btn btn-success btn-icon-split">
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
            $response = getPickupOrders($_SESSION['user_role'], $_SESSION['shopname']);
            foreach ($response as $row) {
                $urlStr = base64_encode(urlencode($row['ID']));
                $model = base64_encode(urlencode("pik"));
    ?>
        <tr>
            <td><?php echo $row['FirstName'] . " " . $row['LastName'];    ?></td>
            <td><?php echo $row['PhoneNumber']; ?></td>
            <td><?php echo $row['TransactionID']; ?></td>
            <td><?php echo $row['NumProduct']; ?></td>
            <td><?php echo $row['TotalAmount']; ?> ETB</td>
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