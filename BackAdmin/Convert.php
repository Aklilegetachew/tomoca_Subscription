
<?php

// require '../config/db.php';
session_start();
$Inout = array();
$user = $_SESSION['shopname'];
$received = json_decode(file_get_contents('php://input'));




if ($received->action === "Convert") {


    echo json_encode(ConvertLitsener($received->id, $received->mode));
}
function ConvertLitsener($id, $mode)
{

    $urlStr = base64_encode(urlencode($id));
    $model = base64_encode(urlencode($mode));
    return [$urlStr, $model];
}
