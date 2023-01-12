<?php

include '../functions.php';
include '../paymproc.php';
include './Abweb/security.php';




$received = json_decode(file_get_contents('php://input'));

if ($received->action == 'pay') {

    echo json_encode(CancelLitsener($received->userId, $received->userTgId, $received->StartMsg, $received->endMsg));
}
function cancelLitsener($userId, $UserTgId, $StartMsg, $endMsg)
{
    $UserInfo = getUserInput($userId);
    $UserTotalAmount = $UserInfo['TotalAmount'];


    $arrayVariable = array(
        "access_key"  => "398f9b6ee4b434889f144d3a4c147e6e",
        "profile_id"  => "CEB5656F-C750-4EA4-AB4B-F7A19C5F27CC",
        "transaction_uuid"  =>  uniqid(),
        "signed_field_names"  => "access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency",
        "unsigned_field_names"  => "",
        "signed_date_time"  => gmdate("Y-m-d\TH:i:s\Z"),
        "locale"  => "en",
        "transaction_type" => "authorization",
        "reference_number" => uniqid(),
        "amount" => $UserTotalAmount,
        "currency" => "ETB"

    );


    foreach ($arrayVariable as $name => $value) {
        echo "<input type=\"hidden\" id=\"" . $name . "\" name=\"" . $name . "\" value=\"" . $value . "\"/>\n";
    }
    echo "<input type=\"hidden\" id=\"signature\" name=\"signature\" value=\"" . sign($arrayVariable) . "\"/>\n";



    // deleteMessage($UserTgId, $endMsg, $StartMsg);
    // CancelNotifyerWeb($UserTgId);
    // DeletRow($userId);
    // return "success";
}

?>
<form id="payment_confirmation" action="https://testsecureacceptance.cybersource.com/pay" method="post" />