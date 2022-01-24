<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

include_once 'conn.php';

session_start();

	$vrati = "0";
	$opera	= 0; 	//sifra_clana;
	$clapre	= "";	//prezime_ime;
	$klusif	= 0;	//klub_sifra;
	$jezik	= 1;	//jezik;
	$status	= 0;	//status_clana;
	$prava	= 1;	//prava_pristupa;
	$oibcla	= "";	//oib;
	$nacpla	= 0;	//nacin_placanja;
	$klbaza	= "";

	if (isset($_GET["username"]) && isset($_GET["passwd"])){

		$username = $_GET['username'];
		$passwd = $_GET['passwd'];

		$passwd = MD5($passwd);

		$sql = "SELECT * FROM clanovi WHERE username=? AND password=?";
		
		$stmt = mysqli_stmt_init($conn);
		
		$stmt = $conn->prepare($sql);
		$stmt->bind_param('ss', $username, $passwd);
		//'ss' znaci 2 varijable stringovi

		/* execute prepared statement */
		$stmt->execute();
		$result = $stmt->get_result();
		
		//broj slogova
		$num_rows = $result->num_rows;
		
		if ($num_rows>0){
			$vrati = "1";
			//uzimanje svih podataka u niz
			$data = $result->fetch_all(MYSQLI_ASSOC);

			//pomocni niz
			$myArray = array();
			
			//definisanje session varijabli pre uzimanja podataka
			$_SESSION['neka_varijabla'] = "";
			$_SESSION['logged_in'] = false;
			
			if ($data) {
				foreach ($data as $row) {
					//smestanje redova podataka iz tabele u niz
					array_push($myArray, $row);
					//uzimanje podataka clana radi daljnje obrade
					$opera	= $row['sifra_clana'];
					$clapre	= $row['prezime_ime'];
					$klusif	= $row['klub_sifra'];
					$jezik	= $row['jezik'];
					$status	= $row['status_clana'];
					$prava	= $row['prava_pristupa'];
					$oibcla	= $row['oib'];
					$nacpla	= $row['nacin_placanja'];
					$klbaza	= $row['klub_baza'];
					$_SESSION['opera']		= $opera;
					$_SESSION['clapre']		= $clapre;
					$_SESSION['klusif']		= $klusif;
					$_SESSION['klubbaza']	= $klbaza;
					$_SESSION['jezik']		= $jezik;
					$_SESSION['prava']		= $prava;
					$_SESSION['nacinpl']	= $nacpla;
					$_SESSION['oibcla']		= $oibcla;
					
				}
				//ako korisnik postoji pozivanje funkcije na dalju obradu
				//prosaologin($opera,$clapre,$klusif,$jezik,$status,$prava,$oibcla,$nacpla,$klbaza);
				echo json_encode($myArray);
			}
		} else {
			//vracanje stringa 0 ne postoji klijent
			echo "0";
		}
		//vracanje json objekta (niza podataka) pozivaocu
		//echo json_encode($myArray);

		$stmt->close();
	}else{
		//vracanje stringa 0 neispravni poslati podaci
		echo "0";
	}

	//zatvaranje konekcije
	//mysqli_close($conn);
	
	function prosaologin($opera,$clapre,$klusif,$jezik,$status,$prava,$oibcla,$nacpla,$klbaza){
		
			if ($clapre and $prava and $status){
				$kudaa="";
				if ($jezik=="1"){
					$kudaa="hr";
				} else {
					$kudaa="en";
				}
				if ($status>"0"){
					if ($prava=="1"){
						rekreacija($opera,$clapre,$klusif,$jezik,$status,$prava,$oibcla,$nacpla,$klbaza);
					} elseif ($prava=="2"){
						treneri($opera,$clapre,$klusif,$jezik,$status,$prava,$oibcla,$nacpla,$klbaza);
					} elseif ($prava=="3"){
						igraci($opera,$clapre,$klusif,$jezik,$status,$prava,$oibcla,$nacpla,$klbaza);
					} elseif ($prava=="5"){
						naplata($opera,$clapre,$klusif,$jezik,$status,$prava,$oibcla,$nacpla,$klbaza);
					} 
				} else {
					$poruka="NEMA STATUS";
				}
			} else {
				$poruka="NEMA PARAMETRE";
			}
		
	}
	function rekreacija($opera,$clapre,$klusif,$jezik,$status,$prava,$oibcla,$nacpla,$klbaza){
		//include_once 'connect.php';
		//if ($tiprekw=="2"){
		include_once 'rekreacija.php';
			//rekreacijad($opera,$clapre,$klusif,$jezik,$status,$prava,$oibcla,$nacpla,$klbaza);
		//}else{
		//	echo "rekreacija";
		//}
		
	}
	function rekreacijad($opera,$clapre,$klusif,$jezik,$status,$prava,$oibcla,$nacpla,$klbaza){
		//include_once 'connect.php';
		//echo "rekreacijad";
		include_once 'rekreacijad.php';
		
	}
	function treneri($opera,$clapre,$klusif,$jezik,$status,$prava,$oibcla,$nacpla,$klbaza){
		echo "treneri";
	}
	function igraci($opera,$clapre,$klusif,$jezik,$status,$prava,$oibcla,$nacpla,$klbaza){
		echo "igraci";
	}
	function naplata($opera,$clapre,$klusif,$jezik,$status,$prava,$oibcla,$nacpla,$klbaza){
		echo "naplata";
	}
	
?>