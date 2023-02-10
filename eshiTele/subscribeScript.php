

<?php

include '../config.php';
include '../functions.php';


global $db;
$query = "SELECT * FROM subscriptionlist WHERE payment_status = 'paid' AND 	sub_status = 'Online'";

$result = mysqli_query($db, $query);


// $options = array(
//     'cluster' => 'us2',
//     'useTLS' => true
// );
// $pusher = new Pusher\Pusher(
//     'e5fe60b6bb6d56b8b93e',
//     '7c3c66b3fafa7887ded8',
//     '1385315',
//     $options
// );



while ($res2 = mysqli_fetch_assoc($result)) {
    date_default_timezone_set("Africa/Addis_Ababa");

    $today = new DateTime();
    $exp_date = new DateTime($res2['sub_endDate']);

    if ($today > $exp_date) {
        echo "Subscription has ended";
        UpdateExpDate($res2);
    } else {

        $deliveryDate = new DateTime($res2['next_orderDate']);

      
        if ($today->format('Y-m-d') == $deliveryDate->format('Y-m-d')) {
            if ($res2['orderType'] == 'Pickup Order') {

                $response  =  makePickupOrder($res2);
                SendNotificationCustomer($res2, 'New Subscription Pickup');
                sendNotificationAdmin($res2, "Subscription Pickup");
                UpdateNextPickupdate($res2);
                // pusher
                // $data['message'] = 'New pickup order arrived';
                // $data['shop'] = $PickUpLocation;
                // $data['name'] = $Fullname;
                // $data['Orderdate'] = date("M Y,d");
                // $pusher->trigger('my-channel', 'my-event', $data);
            } else {
                // $res = Eshiservice($res2);
                $update = json_decode($res, true);

                makeDeliveryOrder($res2, $update['data']['pickup_tracking_link'], $update['data']['delivery_tracing_link'], $update['data']['job_id']);
                SendCompletedMsgDelivery($res2['telegramId'], $res2['transaction_number'], $update['data']['delivery_tracing_link'], $update['data']['job_id']);
                sendNotificationAdmin($res2, 'New delivery order');
                UpdateNextPickupdate($res2);
                // pusher

                // $data['message'] = 'New delivery order arrived';
                // $data['shop'] = $PickUpLocation;
                // $data['name'] = $Fullname;
                // $data['Orderdate'] = date("M Y,d");
                // $pusher->trigger('my-channel', 'my-event', $data);

            }
        } else {
            echo "Not Today";
        }
        echo "Subscription is active";
    }
}













?>