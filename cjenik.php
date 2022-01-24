<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

	    include("jezici.php"); 
		$poruka='[{"poruka1":"'.$ind090.'","poruka2":"' . $ind090a . '"}]';
		echo $poruka;
?>