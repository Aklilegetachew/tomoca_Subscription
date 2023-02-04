<?php

include '../functions.php';
include '../paymproc.php';

$received = json_decode(file_get_contents('php://input'));



if ($received->action == 'submitlocation') {


    echo json_encode(CommentLitsener($received->comment, $received->selectedDate, $received->UID));
}

if ($received->action == 'submitDatePicker') {
    

    echo json_encode(DatePickerSelecter($received->selectedDate, $received->UID));
}
function CommentLitsener($comment, $selectedDate, $UID)
{
    setLocationComment($comment, $selectedDate, $UID);
}

function DatePickerSelecter($selectedDate, $UID)
{
    setDatePicker($selectedDate, $UID);
}
