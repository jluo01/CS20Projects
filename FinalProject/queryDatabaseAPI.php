<?php 
    $SQLQuery = "SELECT ";//Junxing

    $theMetric = $_GET["metric"];
    if ($theMetric == "calories"){
        $SQLQuery += "calories";
    }
    else if ($theMetric == "fat"){
        $SQLQuery += "fat";
    }
    else if ($theMetric == "carbs"){
        $SQLQuery += "carbs";
    }
    else if ($theMetric == "protein"){
        $SQLQuery += "protein";
    }

    $theTime = $_GET["when"];
    $SQLQuery += $theTime;

    $theUID = $_GET["uid"];
    $SQLQuery += $theUID;

    //Query DB here, sum up all diary entries


    $result = 1234;//result should store the sum of all diary entries

    echo $result;
?>
    
