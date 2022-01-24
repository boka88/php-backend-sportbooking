<?php
include_once 'conn.php';  
  
$id = $_POST['id'];
  
  
//uslov da uzme artikle te grupe
$where = "katbr='" . trim($id) . "'";  

$sql ="SELECT sifm as sifartikla,nazivm " .
"as nazivm,jmere,FORMAT(plcena,2) as " .
"cena FROM sifarnikrobe where " . $where;  
$result = array();  
  
    $myArray = array();
    if ($result = $conn->query($sql)) {
        $tempArray = array();
        while($row = $result->fetch_object()) {
                $tempArray = $row;
                array_push($myArray, $tempArray);
            }
        echo json_encode($myArray);
    }

    $result->close();
    $conn->close();
?>