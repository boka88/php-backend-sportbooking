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

	$tixter="";
	$cijlmi="";
	$fifica=date("Y-m-d");
	if (isset($_GET["bteren"])){
		$bteren = $_GET["bteren"];
	}
	if (isset($_GET["bsatni"])){
		$bsatni = $_GET["bsatni"];
	}
	if (isset($_GET["bkada"])){
		$zadan = $_GET["bkada"];
	}
	$tixter="";
	$cijlmi="";

	// provjera da li je termin slobodan
	$upitoy		= "SELECT id FROM rezervacije WHERE teren='$bteren' and datum='$zadan' and termin='$bsatni'";
	$resultaty	= mysqli_query($veza1,$upitoy);
	$teroy		= mysqli_fetch_array($resultaty);
	$slobo		= $teroy['id'];
	if ($slobo){
	    echo "0";
	}

	// provjera koja je vrsta terena i ispod termina
	$upitob1	= "SELECT tip_terena FROM tereni WHERE sifra='$bteren'";
	$resultatb1 = mysqli_query($veza1,$upitob1);
	$terob1		= mysqli_fetch_array($resultatb1);
	$tixter		= $terob1['tip_terena'];

	$upitob		= "SELECT * FROM termini WHERE sifra='$bsatni'";
	$resultatb	= mysqli_query($veza1,$upitob);
	$terob		= mysqli_fetch_array($resultatb);
	$termin		= $terob['satnica'];
	$termix		= substr($terob['satnica'],0,5);

	// ako se teren ne plaća
	if ($nacnate=="4" or $nacnate=="2"){
		$cijena=0;
		$razlog="";
	} else {
		// ako se teren plaća
		if ($nacfocij>10){
			$jedoo=substr($fifica,5,5);
			// odabir koja je sezona radi cjenika
			if ($jedoo>"03-31" and $jedoo<"10-15"){
				$sezon=1;
			} else {
				$sezon=2;
			}
			// cjenik2 - plaća se svaki termin različito - traži kolika je cijena termina
			$upitobac="SELECT mpcijena FROM cjenik2 WHERE termin='$bsatni' and teren='$bteren' and sezona='$sezon'";
			$resultatbac = mysqli_query($veza1,$upitobac);
			$terobac = mysqli_fetch_array($resultatbac);
			$cijena=$terobac['mpcijena'];
		} else {
			// traži u tabli termini kolika je cjena istog
			$upitobac="SELECT * FROM termini WHERE sifra='$bsatni'";
			$resultatbac = mysqli_query($veza1,$upitobac);
			$terobac = mysqli_fetch_array($resultatbac);
			if ($tixter<"2"){
				$cijena=$terobac['clan_cijena_vani'];
			} else {
				$cijena=$terobac['clan_dvorana_cijena'];
			}
		}
		//	da li je platio članarinu
		if ($nacnate=="3"){
			$razlog="";
		}
	}
//	rezervacije za piramidu po xx novaca ( piše u polju rezerva u piramida_clanovi ) - moze 2 puta mjesecno
	if ($igrapi>0){
		$mjese=date("Y-m");
		$query6		 = "SELECT COUNT(id) AS kolko FROM rezervacije WHERE sifra_clana='$opera' and datum like '$mjese%' and termin_piramida>'0'";
		$resultatbac = mysqli_query($veza1,$query6);
		$row		 = mysqli_fetch_array($resultatbac);
	    $koripi		 = $row['kolko'];
	}

	$terpi=0;
	if ($igrapi>0 and $koripi<3 and $sezon=="1"){
		if ($cijena>$cijepi){
			$cijena=$cijepi;
			$terpi=1;
		}
	}
	// izračun ako je uključena opcija lastminut - teren je u pola cijene
	if ($zadan==$fifica){
		if ($lastmin>0){
			$rasati="";
			$sada=date("H:i");
			$razlika = strtotime($termix)-strtotime($sada);
			$rasati=round($razlika/60);
			if ($rasati>0 and $rasati<=$lastmin){
				if ($termix>$lminodkad ){
					$cijena=round($cijena/2,2);
					$lmter1=1;
				}
			}
		}
	}

	$nemozerez="";
//	provjera stanja duga
	if ($izndug>0 and $nacinpl<"2"){
		if ($dancla>0){
			//	Provjera koliko je puta rezervirao teren taj dan - ako je uključena opcija broja rezervacija ( uglavnom je 1 termin )
			$upito20 = "SELECT COUNT(id) AS imali FROM rezervacije WHERE sifra_clana='$opera' and datum='$zadan'";
			$result3 = mysqli_query($veza1,$upito20);
			$tero20  = mysqli_fetch_array($result3);
			$brdrez=$tero20['imali'];
			if ($brdrez>=$dancla){
				$nemozerez="111";
			}
		}

		//	provjera koliki je iznos neplaćenih termina

		$upis3="SELECT SUM(cijena) AS novci FROM rezervacije WHERE sifra_clana ='$opera' and status='0' and tip_termina<'3' and datum<='$fifica' and tip_placanja<'3'";
		$result3 = mysqli_query($veza1,$upis3);
		$row3 = mysqli_fetch_array($result3);
		$sika1=$row3['novci'];
		
		$upis31="SELECT * FROM avansi WHERE sifra_clana ='$opera'";
		$result31=mysqli_query($veza1,$upis31);
		while ($row31 = mysqli_fetch_array($result31)){
			   $sika2=$sika2+$row31['iznos_uplate'];
			   $sika3=$sika3+$row31['iskoristeno'];
		}
		$saldo=$sika2-$sika1-$sika3;
		$dokle=$izndug*(-1);
		if ($saldo<$dokle){
			$nemozerez="111";
		}
	}
	
	//prikazujemo pozitivan iznos dugovanja korisnika
	$saldo = (-1)*$saldo;
// valuta	                iznos duga         valuta   dokle moze da ide dug
//.$valpl." ".number_format($saldo,2,',','.'). $valpl." ".$izndug;	
	echo '[{"valuta":"'.$valpl.'","iznosduga":"'.$saldo.'","dozvoljeno":"'.$izndug.'"}]';
?>
