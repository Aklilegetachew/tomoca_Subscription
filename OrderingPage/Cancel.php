<?php

include '../functions.php';
include '../paymproc.php';

$received = json_decode(file_get_contents('php://input'));

if ($received->action == 'cancel') {

    echo json_encode(CancelLitsener($received->userId, $received->userTgId, $received->StartMsg, $received->endMsg));
}
function cancelLitsener($userId, $UserTgId, $StartMsg, $endMsg)
{

    deleteMessage($UserTgId, $endMsg, $StartMsg);
    CancelNotifyerWeb($UserTgId);
    DeletRow($userId);
    return "success";
}
