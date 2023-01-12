<?php

include '../functions.php';
include '../paymproc.php';

$received = json_decode(file_get_contents('php://input'));



if ($received->action == 'submitlocation') {

    echo json_encode(CommentLitsener($received->comment, $received->UID));
}
function CommentLitsener($comment, $UID){
     setLocationComment($comment, $UID);
}
