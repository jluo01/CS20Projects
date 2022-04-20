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

$SQLQuery = "SELECT SUM(";

$theMetric = $_GET["metric"];


$SQLQuery .= "$theMetric) FROM food WHERE date='";

$theTime = $_GET["when"];
$SQLQuery .= $theTime;

$SQLQuery .= "' AND userid=";

$theUID = $_GET["uid"];
$SQLQuery .= $theUID;

//query database
$diary = $conn->query($SQLQuery);

$result = -1;
if ($diary->num_rows > 0) {
	$row = $diary->fetch_array();
    $result = $row[0];
  }
echo $result;

$conn->close();
?>