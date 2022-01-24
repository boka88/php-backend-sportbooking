<?php 
date_default_timezone_set('Europe/Zagreb');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");
/*
*	treba da primi varijable danod(dd.mm.yyyy), dando(dd.mm.yyyy) i grupica = 1
*	dalje idu donje varijable za konekciju
*
*
*/
//**********************************************************
	if (isset($_GET["opera"])){
		$opera = $_GET["opera"];
	}
	if (isset($_GET["clapre"])){
		$clapre = $_GET["clapre"];
	}
	if (isset($_GET["prava"])){
		$prava = $_GET["prava"];
	}
	if (isset($_GET["klubbaza"])){
		$baza1 = $_GET["klubbaza"];
	}
	if (isset($_GET["nacinpl"])){
		$nacinpl = $_GET["nacinpl"];
	}
	if (isset($_GET["jezik"])){
		$jezik = $_GET["jezik"];
	}
	if (isset($_GET["klusif"])){
		$klusif = $_GET["klusif"];
	}

//konekcije na baze
include 'ccoon.php';




$query	 = "SELECT * FROM clanovi WHERE sifra_clana='$opera'";
$podaci1 = mysqli_query($veza2,$query);   
$myrow	 = mysqli_fetch_array($podaci1);
$jezik	 = $myrow['jezik'];
$oibcla	 = $myrow['oib'];
$predrez = $myrow['pred_rezervacija'];
//*********************************************
//dodatni podaci za formu OSOBNIPODACI
$mjesto = $myrow['mjesto'];
$ulica_kbr = $myrow['ulica_kbr'];
$email = $myrow['email'];
$telefon = $myrow['telefon'];
//ostali parametri su uzeti ranije (oib,opera,username.......)

//*********************************************
$upitof2     = "SELECT * FROM setup";
$podacif2	 = mysqli_query($veza1,$upitof2);   
$teross		 = mysqli_fetch_array($podacif2);
$tknaziv	 = $teross['naziv'];
$oibbrf		 = $teross['oib'];
$terena		 = $teross['broj_terena'];
$dancla		 = $teross['dnevno_clan'];
$redan		 = $teross['rezervacija_dana'];
$pdvst		 = $teross['stopa_pdva'];
$logoz		 = "klubovi/".$teross['logo_racun'];
$logop		 = "slike/".$teross['logo_paragon'];
$terva		 = $teross['broj_vanjskih_terena'];
$satot		 = $teross['otkazi_rezervirano_sati'];
$valpl		 = $teross['valuta'];
$nacnate	 = $teross['nacin_naplate_terena'];
$dpnpla		 = $teross['prom_nac_placanja'];
$izndug		 = $teross['dug_iznad'];
$lastmin	 = $teross['last_minute_minute'];
$porcla		 = $teross['poruka_clanovima'];
$viseklubova = $teross['broj_klubova'];
$logdato	 = $teross['log_datoteka'];
$otknapo	 = $teross['otkaz_napomena'];
$fiskali	 = $teross['fiskalizacija'];
$putcer		 = $teross['certifikat'];
$pascer		 = $teross['zaporka'];
$kojilogo	 = $teross['sifra_reklame'];
$ispracnap	 = $teross['ispisi_racun_pri_naplati'];
$stornorac	 = $teross['rez3'];
$dugopom	 = $teross['opomena_dug'];
$claopome	 = $teross['clanarina_opomena'];
$uplclan	 = $teross['upl_clan_do'];
$uplcla2	 = substr($teross['upl_clan_do'],0,4);
$necnap		 = $teross['neclanovi_duplo'];

$nac_pri_ter = "";

$lminodkad	 = $teross['rez4'];
$vcjenik	 = $teross['rez5'];
$tiprekw	 = $teross['rez31'];  // vrsta: rekreacija.php  ili rekreacijad.php
$valuta		 = $teross['valuta'];
//$_SESSION['valut']=$teross['valuta'];

$upitosy	 = "SELECT * FROM setup_system";
$podaci1	 = mysqli_query($veza1,$upitosy);   
$terosy		 = mysqli_fetch_array($podaci1);
$kojilogo	 = $terosy['zaglavlje_tip'];
$sportboo	 = $terosy['sportbooking_logo'];
$logospo1	 = $terosy['logo_sponzora'];
$logoklub	 = $terosy['logo_kluba'];
$webspon1	 = $terosy['web_adresa_sponzora'];
$webspon2	 = $terosy['mail_za_racuna_tvrtki'];
$webkluba	 = $terosy['web_kluba'];
$napsvega	 = $terosy['naplata_svih_termina'];
$logospo2	 = $terosy['logo_sponzora2'];
$pregled5	 = $terosy['popis_pregleda_5'];
$pregled6	 = $terosy['popis_pregleda_6'];
$pregled7	 = $terosy['popis_pregleda_7'];
$pregled8	 = $terosy['popis_pregleda_8'];
$pregled9	 = $terosy['popis_pregleda_9'];
$nacnapxx	 = $terosy['rez2'];
//$clanpira	 = $terosy['rez3'];
$clanpira	 = "";

$nacfocij	 = $terosy['rez4'];  // cjenik 2 - ako je upisano 22

if ($jezik=="2"){
	include("prijevod1en.php");
} elseif ($jezik=="3"){
	include("prijevod1de.php");
} else {
	include("prijevod1.php");
}
//***********************************************************	
if (!$opera or !$klusif){
    echo "0";
}else{

	$danod="";
	$dando="";
	$iivan="";
		$zadan="";
		if (isset($_GET["danod"])){
			$danod = $_GET["danod"];
		} else {
			$danod = "";
		}
		if (isset($_GET["dando"])){
			$dando = $_GET["dando"];
		} else {
			$dando = "";
		}
		if (isset($_GET["grupica"])){
			$grupica = $_GET["grupica"];
		} else {
			$grupica = "";
		}
		$iivan="1234";
	
	if (!$danod){
		$upitoy = "SELECT MIN(datum) AS datko FROM rezervacije";
		$podaci	= mysqli_query($veza1,$upitoy);   
		$teroy	= mysqli_fetch_array($podaci);
		$danod	= substr($teroy['datko'],8,2).".".substr($teroy['datko'],5,2).".".substr($teroy['datko'],0,4);
		$dando	= date("d.m.Y");
	}
	$ter01="";
	$ter02="";
	$ter03="";
	$ter04="";
	$ter05="";
	$ter06="";
	$ter07="";
	$ter08="";
	$ter09="";
	$ter10="";
	$svota="";
	
	//<!-- Glavni dio -->
						$brojredova = 0;
						$status = ' ';						
						$jsonosnovni = '[';
						
						$brojj="0";
						$datod=substr($danod,6,4)."-".substr($danod,3,2)."-".substr($danod,0,2);
						$datdo=substr($dando,6,4)."-".substr($dando,3,2)."-".substr($dando,0,2);
						$query6 = "SELECT * FROM rezervacije WHERE datum>='$datod' and datum<='$datdo' and sifra_clana='$opera' and tip_termina='1' ORDER BY datum, termin, teren";
						$podac6	= mysqli_query($veza1,$query6); 
						$brojredova = mysqli_num_rows($podac6);	
						
						if($brojredova > 0){						
						
							while ($row = mysqli_fetch_array($podac6)){
								   $brojx=$brojx+1;
								   
								   if($brojx>1){
										$jsonosnovni = $jsonosnovni . ',';
								   }
								   $ukupn=$ukupn+$row['cijena'];
								   $xadan=substr($row['datum'],8,2).".".substr($row['datum'],5,2).".".substr($row['datum'],0,4);
								   if ($row[5]>0){
										$status = $novo73;
								   }
								   $jsonosnovni = $jsonosnovni . '{"rbr":"'.$brojx.'","datum":"'.$xadan.'","tereni":"'.$row['teren'].
								   '","termin":"'.$row['satnica'].'","protivnik":"'.$row['rez11'].'","status":"'.$status.'"}';
								   
							} //end while
						}else{
							$jsonosnovni = $jsonosnovni . '"rbr":," ","datum":" ","tereni":" ",'.
								'"termin":" ","protivnik":" ","status":" "}';
						}	
						
						$jsonosnovni = $jsonosnovni . ']';
			//vraca json fajl
			echo $jsonosnovni;
						
	
} 
?>