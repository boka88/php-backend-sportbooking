<?php
$servername	= "sdb-e.hosting.stackcp.net";
$username	= "binsoftsetup-313833482b";
$password	= "bqyf3i8upn";

$dbname = "binsoftsetup-313833482b";


$conn = null;

//mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$conn->set_charset('utf8');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

?>