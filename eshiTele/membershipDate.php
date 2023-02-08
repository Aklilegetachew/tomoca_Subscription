
<?php

include './config/db.php';
include '../functions.php';

global $connection;
$query = "SELECT * FROM membership WHERE step = 'MEMBER'";

$result = mysqli_query($connection, $query);

while ($res2 = mysqli_fetch_assoc($result)) {

    date_default_timezone_set("Africa/Addis_Ababa");

    $today = new DateTime();
    $exp_date = new DateTime($res2['Exp_date']);
    $difference = $today->diff($exp_date);
    if ($difference->days == 3) {
        sendNoticeExpiration($res2);
    } else if ($today > $exp_date) {
        DiscardMembership($res2);
        sendExpiredMessage($res2);
    } else {
        echo "Still a member";
    }
}
