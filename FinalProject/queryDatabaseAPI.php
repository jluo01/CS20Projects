<?php
$server = "localhost";
$userid = "uo8hchpccgagq";
$pw = "hhxxttxs";
$db= "db3guheulakj3q";

$conn = new mysqli($server, $userid, $pw);

if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

$conn->select_db($db);

$SQLQuery = "SELECT ";

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

$SQLQuery += " FROM food WHERE date=";

$theTime = $_GET["when"];
$SQLQuery += $theTime;

$SQLQuery += " AND userid=";

$theUID = $_GET["uid"];
$SQLQuery += $theUID;

//query database
$diaries = $conn->query($SQLQuery);

if ($diaries->num_rows > 0) {
    $result = 0;
	while($row = $result->fetch_assoc()) 
	{
        $result += $row[$theMetric];
	}
  } 

echo $result;

$conn->close();
?>