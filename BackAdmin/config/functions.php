<?php

function escape($text)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($text));
}


function confirm($result)
{

    global $connection;
    if (!$result) {
        die('QUERY FAILED ' . mysqli_error($connection));
    }
}

