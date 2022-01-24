<?php
date_default_timezone_set('Europe/Zagreb'); 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");
	
	/*
	*	localhost:81/sportbooking/api/otkaz.php?idbroj=99610&razod=1
	*	razod = sifra razloga otkazivanja iz tabele "odjava_rezervacije"
	*/
//**********************connect1.php*************************************************
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
if (!$opera or !$prava or !$klusif){
    echo("connect.php greska");
	exit;
}

//konekcije na baze
include 'ccoon.php';


$query	 = "SELECT * FROM clanovi WHERE sifra_clana='$opera'";
$podaci1 = mysqli_query($veza2,$query);   
$myrow	 = mysqli_fetch_array($podaci1);
$jezik	 = $myrow['jezik'];
$oibcla	 = $myrow['oib'];
$predrez = $myrow['pred_rezervacija'];

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

//$nac_pri_ter = $teross['nac_pri_ter'];
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


//******************************************************************************

	$danas=date("Y-m-d H:i:s");
	$lmter="";
		if (isset($_GET["idbroj"])){
			$idbroj = $_GET["idbroj"];
		} else {
			$idbroj = "";
		}
		if (isset($_GET["razod"])){
			$razod = $_GET["razod"];
		} else {
			$razod = "";
		}
		if ($razod and $idbroj and $opera){
			$rezer2	  = "SELECT * FROM rezervacije WHERE id=".$idbroj;
			$resultat = mysqli_query($veza1,$rezer2);
			$teros2   = mysqli_fetch_array($resultat);
			$datrez   = $teros2['datum'];
			$siftrn   = $teros2['teren'];
			$siftrm   = $teros2['termin'];
			$sifcla   = $teros2['sifra_clana'];
			$clapre   = $teros2['prezime_ime'];
			$satnic   = $teros2['satnica'];
			$novaca   = $teros2['cijena'];
			$tipter   = $teros2['tip_termina'];
			$rezrvo   = $teros2['rezerviro'];
			$sifcjn   = $teros2['nacin_placanja'];

			$rezertof = "DELETE FROM rezervacije WHERE id=" . $idbroj;
			$zapisito = mysqli_query($veza1,$rezertof);

			$rezer21  = "SELECT * FROM odjava_rezervacije WHERE sifra=" . $razod;
			$result21 = mysqli_query($veza1,$rezer21);
			$teroh    = mysqli_fetch_array($result21);
			$razlog   = $teroh['razlog_odjave'];

			$logvri=date("Y-m-d H:i:s");
		
	$logdat	  ="INSERT INTO odjava VALUES ('" . $logvri . "'," .$opera.",".$sifcla.",'".$clapre."',".$razod.",'".$razlog."','".
	$datrez."',".$siftrn.",'".$siftrm."','".$satnic."',".$novaca.",".$tipter.",".$sifcjn.",'".$rezrvo."','','')";
	$zapisito = mysqli_query($veza1,$logdat);

			/*
			if ($logdato>"0"){
				$logvri   = date("Y-m-d H:i:s");
				$logdat1  = "INSERT INTO log VALUES ('$logvri', '$opera', '$clapre', '2', '$siftrn', '$siftrm', '$novaca', '', '', '$datrez')";
				$zapisito = mysqli_query($veza1,$logdat1);
			}
			*/
			echo "1";	//otkazana rezervacija
		} else {
		    echo "0";	//nije otkazano nisu podaci u redu
		}
	if (isset($_GET["idbroj"])){
		$idbroj = $_GET["idbroj"];
	} else {
		echo "0";	//nije otkazano
	}
?>