<?php include  '../config/db.php'; ?>
<?php include  '../config/functions.php'; ?>
<?php session_start(); ?>


<?php
$user = $_SESSION['shopname'];
// Excel file name for download 
$fileName = "Tomoca-Sales-Report-" . date('Ymd') . ".xlsx";

// Headers for download 
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Content-Type: application/vnd.ms-excel");

// Filter the excel data 
function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}


function GetSelection($ID)
{
    global $connection;
    $query = "SELECT * From products WHERE productId=$ID";;
    $res = mysqli_query($connection, $query);
    $res2 = mysqli_fetch_assoc($res);
    return $res2;
}




if (isset($_POST['report'])) {

    $option = array("Title", "Description", "Roast", "size",  "Quantity", "price", "Amount", "Total");
    $ChosenOptions = [];
    $Inout = [];
    $TotalAmount = 0;
    $CountBar = 0;
    $CountFam = 0;
    $CountTur = 0;
    $CountSizeSmall = 0;
    $CountSizelarge = 0;
    $CountBeans = 0;
    $CountGround = 0;
    $CountOrders = 0;




    foreach ($option as $fields) {
        if (isset($_POST[$fields])) {
            array_push($ChosenOptions, $fields);
        }
    }

    $fields = $ChosenOptions;

    // Excel file name for download 
    $fileName = "Sales_Report" . date('Y-m-d') . ".xls";

    // Display column names as first row 
    $excelData = implode("\t", array_values($fields)) . "\n";
    $firstDay =  strtotime($_POST['StartDate']);
    $lastdate =  strtotime($_POST['EndDate']);



    for ($i = $firstDay; $i <= $lastdate; $i = $i + 86400) {
        // $L = intval($i);
        $thisDate = date('Y-m-d', $i); // 2010-05-01, 2010-05-02, et

        if ($user === 'Central') {

            $query = "SELECT * FROM completeddelivery WHERE CompletedDate = '$thisDate'";
        } else {
            $query = "SELECT * FROM completeddelivery WHERE ShopLocation = '$user' AND CompletedDate = '$thisDate'";
        }

        $res = mysqli_query($connection, $query);
        $lineData2 = [$thisDate];
        if (mysqli_num_rows($res) > 0) {

            // Output each row of the data 
            while ($row = mysqli_fetch_assoc($res)) {
                $lineData = array();
                $CartStart =  intval($row['CartStart']);
                $CartEnd = intval($row['CartEnd']);
                // echo $CartStart . "<br>";
                // echo $CartEnd . "<br>"; 
                for ($x = $CartStart; $x <= $CartEnd; $x++) {
                    $queryCart = "SELECT * From cart WHERE cartId=$x";;
                    $resCart = mysqli_query($connection, $queryCart);
                    $res2 = mysqli_fetch_assoc($resCart);
                    $selectedItem = GetSelection($res2['ProductId']);
                    // print_r($selectedItem);
                    // echo "<br>";
                    foreach ($ChosenOptions as $Col) {
                        if ($Col == "Title" || $Col == "Description" || $Col == "size" || $Col == "Roast" || $Col == "price") {
                            if ($Col == "Title") {
                                array_push($lineData, $selectedItem[$Col]);
                            } elseif ($Col == "Description") {
                                if (str_contains($selectedItem[$Col], "Beans")) {
                                    array_push($lineData, "Beans");
                                    $CountBeans += $res2["Quantity"];
                                } else {
                                    array_push($lineData, "Ground");
                                    $CountGround += $res2["Quantity"];
                                }
                            } elseif ($Col == "size") {
                                if ($selectedItem[$Col] == "250") {
                                    array_push($lineData, "250 g");
                                    $CountSizeSmall += $res2["Quantity"];
                                } else {
                                    array_push($lineData, "500 g");
                                    $CountSizelarge += $res2["Quantity"];
                                }
                            } elseif ($Col == "Roast") {
                                if (str_contains($selectedItem[$Col], "FAMIGLIA")) {
                                    array_push($lineData, "FAMIGLIA");
                                    $CountFam += $res2["Quantity"];
                                } elseif (str_contains($selectedItem[$Col], "Turkish")) {
                                    array_push($lineData, "Turkish");
                                    $CountTur += $res2["Quantity"];
                                } elseif (str_contains($selectedItem[$Col], "BAR")) {
                                    array_push($lineData, "BAR");
                                    $CountBar += $res2["Quantity"];
                                }
                            } elseif ($Col == "price") {
                                array_push($lineData, $selectedItem[$Col]);
                            }
                        } elseif ($Col == "Quantity" || $Col == "Amount") {
                            array_push($lineData, $res2[$Col]);
                            if ($Col == "Quantity") {
                                $CountOrders += $res2["Quantity"];
                            }
                        }
                    }



                    array_walk($lineData, 'filterData');
                    $excelData .= implode("\t", array_values($lineData)) . "\n";
                    $lineData = array();
                }
                foreach ($ChosenOptions as $Col) {
                    if ($Col == "Total") {
                        // array_push($lineData, $row["Total"]);
                        $TotalAmount +=  $row["Total"];
                    }
                }
            }
        } else {
        }
    }

    // Headers for download 
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment; filename=\"$fileName\"");


    //  Summery

    array_push($Inout, " ", "", "", "");
    array_walk($Inout, 'filterData');
    $excelData .= implode("\t", array_values($Inout)) . "\n";
    $Inout = array();

    array_push($Inout, " ", "", "", "");
    array_walk($Inout, 'filterData');
    $excelData .= implode("\t", array_values($Inout)) . "\n";
    $Inout = array();

    array_push($Inout, " ", "Summary from" . " " . $_POST['StartDate'] . " TO " . $_POST['EndDate']);
    array_walk($Inout, 'filterData');
    $excelData .= implode("\t", array_values($Inout)) . "\n";
    $Inout = array();

    foreach ($ChosenOptions as $Col) {
        if ($Col == "Total") {
            array_push($Inout, "Sum Total:");
            array_push($Inout, $TotalAmount . "ETB");
            array_walk($Inout, 'filterData');
            $excelData .= implode("\t", array_values($Inout)) . "\n";
            $Inout = array();
        } elseif ($Col == "Roast") {
            array_push($Inout, "BAR:");
            array_push($Inout, $CountBar);
            array_walk($Inout, 'filterData');
            $excelData .= implode("\t", array_values($Inout)) . "\n";
            $Inout = array();

            array_push($Inout, "FAMIGLIA:");
            array_push($Inout, $CountFam);
            array_walk($Inout, 'filterData');
            $excelData .= implode("\t", array_values($Inout)) . "\n";
            $Inout = array();

            array_push($Inout, "Turkish:");
            array_push($Inout, $CountTur);
            array_walk($Inout, 'filterData');
            $excelData .= implode("\t", array_values($Inout)) . "\n";
            $Inout = array();
        } elseif ($Col == "size") {
            array_push($Inout, "Size 250g:");
            array_push($Inout, $CountSizeSmall);
            array_walk($Inout, 'filterData');
            $excelData .= implode("\t", array_values($Inout)) . "\n";
            $Inout = array();


            array_push($Inout, "Size 500g:");
            array_push($Inout, $CountSizelarge);
            array_walk($Inout, 'filterData');
            $excelData .= implode("\t", array_values($Inout)) . "\n";
            $Inout = array();
        } elseif ($Col == "Description") {


            array_push($Inout, "Beans:");
            array_push($Inout, $CountBeans);
            array_walk($Inout, 'filterData');
            $excelData .= implode("\t", array_values($Inout)) . "\n";
            $Inout = array();


            array_push($Inout, "Ground:");
            array_push($Inout, $CountGround);
            array_walk($Inout, 'filterData');
            $excelData .= implode("\t", array_values($Inout)) . "\n";
            $Inout = array();
        } elseif ($Col == "Quantity") {
            array_push($Inout, "Numbers of Orders:");
            array_push($Inout, $CountOrders);
            array_walk($Inout, 'filterData');
            $excelData .= implode("\t", array_values($Inout)) . "\n";
            $Inout = array();
        }
    }


    // Render excel data 
    echo $excelData;

    exit;

   
}







?>