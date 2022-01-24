<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

date_default_timezone_set('Europe/Zagreb');
if (isset($_SESSION['opera'])){
	$opera=$_SESSION['opera'];
} else {
	$opera="";
}
if (isset($_SESSION['clapre'])){
	$clapre=$_SESSION['clapre'];
} else {
	$clapre="";
}
if (isset($_SESSION['prava'])){
	$prava=$_SESSION['prava'];
} else {
	$prava="";
}
if (isset($_SESSION['klusif'])){
	$klusif=$_SESSION['klusif'];
} else {
	$klusif="";
}
if (isset($_SESSION['nacinpl'])){
	$nacinpl=$_SESSION['nacinpl'];
} else {
	$nacinpl="";
}
if (isset($_SESSION['jezik'])){
	$jezik=$_SESSION['jezik'];
} else {
	$jezik="";
}

if (!$opera or !$prava or !$klusif){
    echo("connect.php greska");
	exit;
}

//baza osnovnih podataka "setup"
$host2	= "sdb-e.hosting.stackcp.net";
$user2	= "binsoftsetup-313833482b";
$pass2	= "bqyf3i8upn";


//baza clanova "demo"
$host1	= "sdb-o.hosting.stackcp.net";
$user1	= "binsoftdemo-3139379eda";
$pass1	= "og9dj05yuq";
$baza1  = "binsoftdemo-3139379eda";


//		konekcija sa bazom èlanova
$baza2	= "binsoftsetup-313833482b";
$veza2	= mysqli_connect($host2,$user2,$pass2,$baza2);
mysqli_set_charset($veza2,"utf8");


//		konekcija sa bazom centra
//ovo iskljuceno jer ne treba u ovom slucaju 23-09-2021
//$baza1  = $_SESSION['klubbaza'];
$veza1	= mysqli_connect($host1,$user1,$pass1,$baza1);
mysqli_set_charset($veza1,"utf8");


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
$_SESSION['valut']=$teross['valuta'];

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


//			provjera koja je greška
//			if (!$data) {
//			    printf("Error: %s\n", mysqli_error($vezaa));
//			    exit();
//			}

 ?>