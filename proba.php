<?php
	
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");
	
	//include("connect1.php");  
	//ODAVDE IDE VRACANJE I PROVERA PODATAKA ===============================
	//primer:    rekreacijax2.php?bteren=1&bsatni=9&bkada=2021-03-11
	//primer:    predupis.php?bteren=1&bsatni=9&bkada=2021-03-11
	/*
	localhost:81/sportbooking/api/getdata.php?username=demo1&passwd=demo1
	localhost:81/sportbooking/api/predupis.php?bteren=1&bsatni=9&bkada=2021-03-30
	
	*/

	
		
			echo '[{"jadan":"","rteren":0,"termi3":0,"opera":1824,"clapre":"Demo program za clanove",'.
			'"satnica":"","cijena":3.00,"lmter1":0,"danas":""2021-04-01 18:15:58","terpi":0}]';
					
?>