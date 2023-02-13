<?php


if ($user_id !== 5102867263 && $step == "MembershipStart") {
    if ($text == "Next") {
        sharePhone($chat_id);
        setStep($user_id, "MemberFinal");
    } elseif ($text == "Go Back") {
        BackNotif($update);
        // goto QUAN;
    } elseif ($text == "Cancel") {

        $userIdDb = getUserID($user_id);
        $UserInfo = getUserInput($userIdDb);
        CancelNotifyerUser($chat_id);
        DeletRequest($userIdDb);
    } elseif ($text !== "Cancel" && $text !== "Go Back" && $text !== "Next" && $text !== "submit") {
        $markup  = array('keyboard' => array(array('Next'), array('Go Back', 'Cancel')), 'resize_keyboard' => true, 'selective' => true, 'one_time_keyboard' => true);
        $markupjs = json_encode($markup);
        $msg = urlencode("please choose only from the options provided. or cancel the previous order to empty your cart\nካሉት አማራጮች ብቻ ይምረጡ");

        message($chat_id, $msg, $markupjs);
    }
}

// =============================== Membership setting phone number ================================

if ($Contact && $step == "MemberFinal") {
    setphone($user_id, $Contact);
    ChooseProviderMem($chat_id, $user_id);
    setStep($user_id, "MembershipCheckout");
} elseif ($text == "Back" && $step == "MemberFinal") {
    $userIdDb = getUserIDMem($user_id);
    BackNotif($update);
    setStep($user_id, "MembershipStart");
} elseif ($step == "MemberFinal" && !is_numeric($text) && $text !== "Cancel") {
    $markup  = array('keyboard' => array(array(array('text' => 'Cancel'), array('text' => 'Phone Number', 'request_contact' => true))), 'resize_keyboard' => true, 'one_time_keyboard' => true, 'selective' => true);
    $markupjs = json_encode($markup);
    message($chat_id, "Please insert Phone number! or cancel previous order", $markupjs);
} elseif (is_numeric($text) && $step == "MemberFinal") {
    setphone($user_id, $text);
    ChooseProviderMem($chat_id, $user_id);
    setStep($user_id, "MembershipCheckout");
} elseif ($text == "Cancel"  && $step == "MemberFinal") {
    $userIdDb = getUserID($user_id);
    $UserInfo = getUserInput($userIdDb);
    CancelNotifyerUser($chat_id);
    DeletRequest($userIdDb);
}
