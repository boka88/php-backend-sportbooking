<?php
/*
$servername = "localhost";
$username = "csh";
$password = "5iiivan9";
*/
$servername = "localhost";
$username = "root";
$password = "bin123";
$dbname = "setup";
$dbConn = null;

try {
    // http://php.net/manual/en/pdo.connections.php
    $dbConn = new PDO("mysql:host={$servername};dbname={$dbname};charset=UTF8", $username, $password);
    
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Setting Error Mode as Exception
    // More on setAttribute: http://php.net/manual/en/pdo.setattribute.php
} catch(PDOException $e) {
    echo $e->getMessage();
}

?>

