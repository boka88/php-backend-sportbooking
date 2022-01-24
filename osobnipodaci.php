<?php 
date_default_timezone_set('Europe/Zagreb');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");
/*
*
* popunjavaju se polja iz baze SETUP tabela clanovi, lozinka se ne popunjava
*	(mjesto,  ulica i br., e-mail, Telefon/mob   , korisnicko ime,   lozinka 
*	iz tabele clanovi:  username, mjesto, ulica_kbr, email,  telefon, oib
*/
//******************************************************************************
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
$clanpira	 = "";

$nacfocij	 = $terosy['rez4'];  // cjenik 2 - ako je upisano 22

if ($jezik=="2"){
	include("prijevod1en.php");
} elseif ($jezik=="3"){
	include("prijevod1de.php");
} else {
	include("prijevod1.php");
}
//*******************************************************************************	
	if (!$opera or !$klusif){
	    echo "0";
	}
	$danas=date("Y-m-d");
		//check box 
		if (isset($_GET["pristajem"])){
			$pristajem = $_GET["pristajem"];
		} else {
			$pristajem = "";
		}
		if (isset($_GET["oib"])){
			$oib = $_GET["oib"];
		} else {
			$oib = "";
		}
		if (isset($_GET["prezime"])){
			$prezime = $_GET["prezime"];
		} else {
			$prezime = "";
		}
		if (isset($_GET["mjesto"])){
			$mjesto = $_GET["mjesto"];
		} else {
			$mjesto = "";
		}
		if (isset($_GET["ulica"])){
			$ulica = $_GET["ulica"];
		} else {
			$ulica = "";
		}
		if (isset($_GET["email"])){
			$email = $_GET["email"];
		} else {
			$email = "";
		}
		if (isset($_GET["mobitel"])){
			$mobitel = $_GET["mobitel"];
		} else {
			$mobitel = "";
		}
		if (isset($_GET["novokor"])){
			$novokor = $_GET["novokor"];
		} else {
			$novokor = "";
		}
		if (isset($_GET["novaloz"])){
			$novaloz = $_GET["novaloz"];
		} else {
			$novaloz = "";
		}
			$laprdo = "1";
		
		if ($pristajem and $laprdo and $novokor and $mjesto and $novaloz){
			
			$zaporka=md5($novaloz); //enkriptovana sifra
			
			$upis29 = "SELECT sifra_clana FROM clanovi WHERE username='$novokor' and password='$zaporka'";
			$podaci	= mysqli_query($veza2,$upis29);   
			$row21	= mysqli_fetch_array($podaci);
			$imaga=$row21['sifra_clana'];

			if ($imaga <> $opera){
				$poruka=$oso003;
				echo "0";  //ne poklapa se sifra clana sa opera javiti gresku
			} else {
				$upis4="UPDATE clanovi SET jezik='$laprdo', mjesto='$mjesto', ulica_kbr='$ulica', email='$email', telefon='$mobitel', username='$novokor', password='$zaporka', oib='$oib' WHERE sifra_clana='$opera'";
				$podaci4 = mysqli_query($veza2,$upis4);   
				$poruka=$oso002;
				
				//************************
				echo "1";  //IZMENE USPELE
			}
		} else {
			$poruka=$oso004;
			echo $poruka; //salje poruku
		}


		$upis29   = "SELECT * FROM clanovi WHERE sifra_clana='$opera'";
		$podaci	  = mysqli_query($veza2,$upis29);   
		$row	  = mysqli_fetch_array($podaci);
		$novokor  = $row['username'];
		$prezime  = $row['prezime_ime'];
		$laprdo   = $row['jezik'];
		$mjesto   = $row['mjesto'];
		$ulica    = $row['ulica_kbr'];
		$email	  = $row['email'];
		$mobitel  = $row['telefon'];
		$tvrtka   = $row['tvrtka'];
		$sjediste = $row['sjediste'];
		$tvrulica = $row['sjediste_ulica'];
		$oib	  = $row['oib'];
		$tvremail = $row['tvrtka_email'];
		if ($row['jezik']=="2"){
			$izb01="checked";
		}
		$izb02="checked";
		$novaloz="";

?>