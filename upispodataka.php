<?php 
date_default_timezone_set('Europe/Zagreb');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8"); 
//include("connect1.php"); 
//========================= UPIS PODATAKA ===================================
/*

INSERT INTO rezervacije (datum,teren,termin,sifra_clana,prezime_ime,satnica,cijena,tip_termina,STATUS,datum_placanja,
tip_placanja,lastminut,rezerviro,nacin_placanja,sifra_cijene,rez2,danas,naplatio,naplaceni_iznos,
termin_piramida,rez6,rez7,rez10,rez11) 

cisti SQL UPIT RADI;
-----------------------
INSERT INTO rezervacije VALUES ('2021-03-29', 7, 9, 1824, 'Demo program za clanove',
'20:00-21:30', 5.00, 1, 0, '2001-01-01', 1, 0, 1824, 1, 1, '',
'2021-02-16 14:12:46',0,0,0,'','','','',0);
----------------------------------------------------------------------------


VALUES:
'$jadan', '$rteren', '$rsatni', '$opera', '$clapre', '$termin', '$cijena', '1', '', '', '1', '$lmter1', '$opera', '',
 '$cijena', '', '$danas','','','$terpi','','','','$protiv','')

 $jadan  - (za koji datum)
 $rteren -  (koji teren)
 $rsatni -  (termin 1-9)
 $opera  -  (sifra clana)
 $clapre -  (prezime i ime)
 $termin -  (satnica 08:30-09:30)
 $cijena -   (cijena)
 '1'	 -  tip termina
 '1'     -  (tip placanja)
 $lmter1 -  (last minut)
 $opera  -  (rezerviro)
 $cijena -  (sifra cijene)
 $danas  -  (danasnji datum uglavnom '0000-00-00')
 $terpi  -  (termin piramida)
 $protiv -  (rez11)
 
POZIV PROGRAMA ZA UPIS:
------------------------------------------------------------------------------------------------------------------------ 
&opera=opera&clapre=clapre

 localhost/sportbooking/api/getdata.php?username=demo1&passwd=demo1
 localhost/sportbooking/api/predupis.php?bteren=1&bsatni=9&bkada=2021-03-30

 localhost/sportbooking/api/upispodataka.php?&rteren=12&rsatni=9&termin=20:00-21:30&danre=30.03.2021&lmter1=0&terpi=0
 &cijena=5.00&protiv=''
 
 vraca:
 1 - UPISAO
 2 - Nije upisao probaj ponovo
 3 - Termin je vec zauzet
 
*/
//************************************** connect1 *************************
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

//*************************************************************************	
	
	$rteren = "";
	$rsatni = "";
	$termin="";
	$datrz = "";
	$upiso = "";
	$cijena="";
	$cijen2="";
	$tkoje="";
	$vrpla="";
	
	$zadan="";
	$clacij="";
	$protiv="";
	$jadan="";
	$danas="";
	
		if (isset($_GET["rteren"])){
			$rteren = $_GET["rteren"];
		} else {
			$rteren = "";
		}
		if (isset($_GET["rsatni"])){
			$rsatni = $_GET["rsatni"];
		} else {
			$rsatni = "";
		}
		if (isset($_GET["termin"])){
			$termin = $_GET["termin"];
		} else {
			$termin = "";
		}
		if (isset($_GET["danre"])){
			$danre = $_GET["danre"];
		} else {
			$danre = "";
		}
		if (isset($_GET["lmter1"])){
			$lmter1 = $_GET["lmter1"];
		} else {
			$lmter1 = "";
		}
		if (isset($_GET["terpi"])){
			$terpi = $_GET["terpi"];
		} else {
			$terpi = "";
		}
		if (isset($_GET["cijena"])){
			$cijena = $_GET["cijena"];
		} else {
			$cijena = "";
		}
		if (isset($_GET["protiv"])){
			$protiv = $_GET["protiv"];
		} else {
			$protiv = "";
		}
		if (isset($_GET["nama1"])){
			$nama1 = $_GET["nama1"];
		} else {
			$nama1 = "";
		}
		if (isset($_GET["nama2"])){
			$nama2 = $_GET["nama2"];
		} else {
			$nama2 = "";
		}
		if (isset($_GET["nama3"])){
			$nama3 = $_GET["nama3"];
		} else {
			$nama3 = "";
		}
		
		if ($nacnate=="4" or $nacnate=="5"){
			if ($rteren and $rsatni and substr($danre,6,4)>'2018' and $opera){
				$jadan	  = substr($danre,6,4)."-".substr($danre,3,2)."-".substr($danre,0,2);
				$danas	  = date("Y-m-d H:i:s");
				
				$upisiga  = "INSERT INTO rezervacije VALUES ('".$jadan."',".$rteren.",".$rsatni.",".$opera.",'".$clapre.
					"','".$termin."',".$cijena.",1,0,'0000-00-00 00:00:00',1,".$lmter1.",".$opera.",0,".$cijena.",'','".
					$danas."',0,0.00,".$terpi.",'','','','".$protiv."',0)";
				$zapisito = mysqli_query($veza1,$upisiga);

				if ($logdato=="1"){
					$logvri  = date("Y-m-d H:i:s");
					$logdat  = "INSERT INTO log VALUES ('$logvri', '$opera', '$clapre', '1', '$rteren', '$rsatni', '$cijena', '1', '$nacinpl', '$jadan')";
					$logdat1 = mysqli_query($veza1,$logdat);
				}
	
				if ($nama1){
					$termi1   = $rsatni+1;
					$upit11   = "SELECT * FROM termini WHERE sifra='$termi1'";
					$resul11  = mysqli_query($veza1,$upit11);
					$ter11    = mysqli_fetch_array($resul11);
					$satnica  = $ter11['satnica'];

					$upitoy1  = "SELECT id AS sloboda FROM rezervacije WHERE termin='$termi1' and teren='$rteren' and datum='$jadan'";
					$resulty1 = mysqli_query($veza1,$upitoy1);
					$terohy1  = mysqli_fetch_array($resulty1);
					$etovam1  = $terohy1['sloboda'];

					if ($etovam1<1){
						
						$upisiga1  = "INSERT INTO rezervacije VALUES ('".$jadan."',".$rteren.",".$rsatni.",".$opera.",'".$clapre.
						"','".$termin."',".$cijena.",1,0,'0000-00-00 00:00:00',1,".$lmter1.",".$opera.",0,".$cijena.",'','".
						$danas."',0,0.00,".$terpi.",'','','','".$protiv."',0)";
						
						//$upisiga1  = "INSERT INTO rezervacije VALUES ('$jadan', '$rteren', '$termi1', '$opera', '$clapre', '$satnica', '$cijena', '1', '', '', '1', '$lmter1', '$opera', '', '$cijena', '', '$danas','','','$terpi','','','','$protiv','')";
						$zapisito1 = mysqli_query($veza1,$upisiga1);

						if ($logdato=="1"){
							$logvri  = date("Y-m-d H:i:s");
							$logdat  = "INSERT INTO log VALUES ('$logvri', '$opera', '$clapre', '1', '$rteren', '$termi1', '$cijena', '1', '$nacinpl', '$jadan')";
							$logdat1 = mysqli_query($veza1,$logdat);
						}
					}
				}
				if ($nama2){
					$termi2   = $rsatni+2;
					$upit12   = "SELECT * FROM termini WHERE sifra='$termi2'";
					$resul12  = mysqli_query($veza1,$upit12);
					$ter12    = mysqli_fetch_array($resul12);
					$satnica  = $ter12['satnica'];

					$upitoy2  = "SELECT id AS sloboda FROM rezervacije WHERE termin='$termi2' and teren='$rteren' and datum='$jadan'";
					$resulty2 = mysqli_query($veza1,$upitoy2);
					$terohy2  = mysqli_fetch_array($resulty2);
					$etovam2  = $terohy2['sloboda'];

					if ($etovam2<1){
						
						$upisiga2  = "INSERT INTO rezervacije VALUES ('".$jadan."',".$rteren.",".$rsatni.",".$opera.",'".$clapre.
						"','".$termin."',".$cijena.",1,0,'0000-00-00 00:00:00',1,".$lmter1.",".$opera.",0,".$cijena.",'','".
						$danas."',0,0.00,".$terpi.",'','','','".$protiv."',0)";
						
						//$upisiga2  = "INSERT INTO rezervacije VALUES ('$jadan', '$rteren', '$termi2', '$opera', '$clapre', '$satnica', '$cijena', '1', '', '', '1', '$lmter1', '$opera', '', '$cijena', '', '$danas','','','$terpi','','','','$protiv','')";
						$zapisito2 = mysqli_query($veza1,$upisiga2);

						if ($logdato=="1"){
							$logvri  = date("Y-m-d H:i:s");
							$logdat  = "INSERT INTO log VALUES ('$logvri', '$opera', '$clapre', '1', '$rteren', '$termi2', '$cijena', '1', '$nacinpl', '$jadan')";
							$logdat1 = mysqli_query($veza1,$logdat);
						}
					}
				}
				if ($nama3){
					$termi3   = $rsatni+3;
					$upit13   = "SELECT * FROM termini WHERE sifra='$termi3'";
					$resul13  = mysqli_query($veza1,$upit13);
					$ter13    = mysqli_fetch_array($resul13);
					$satnica  = $ter13['satnica'];

					$upitoy3  = "SELECT id AS sloboda FROM rezervacije WHERE termin='$termi3' and teren='$rteren' and datum='$jadan'";
					$resulty3 = mysqli_query($veza1,$upitoy3);
					$terohy3  = mysqli_fetch_array($resulty3);
					$etovam3  = $terohy3['sloboda'];

					if ($etovam3<1){
						
						$upisiga3  = "INSERT INTO rezervacije VALUES ('".$jadan."',".$rteren.",".$rsatni.",".$opera.",'".$clapre.
						"','".$termin."',".$cijena.",1,0,'0000-00-00 00:00:00',1,".$lmter1.",".$opera.",0,".$cijena.",'','".
						$danas."',0,0.00,".$terpi.",'','','','".$protiv."',0)";
						
						//$upisiga3  = "INSERT INTO rezervacije VALUES ('$jadan', '$rteren', '$termi3', '$opera', '$clapre', '$satnica', '$cijena', '1', '', '', '1', '$lmter1', '$opera', '', '$cijena', '', '$danas','','','$terpi','','','','$protiv','')";
						$zapisito3 = mysqli_query($veza1,$upisiga3);

						if ($logdato=="1"){
							$logvri  = date("Y-m-d H:i:s");
							$logdat  = "INSERT INTO log VALUES ('$logvri', '$opera', '$clapre', '1', '$rteren', '$termi3', '$cijena', '1', '$nacinpl', '$jadan')";
							$logdat1 = mysqli_query($veza1,$logdat);
						}
					}
				}
				
				$upito	  = "SELECT sifra_clana FROM rezervacije WHERE termin='$rsatni' and teren='$rteren' and datum='$jadan' and sifra_clana='$opera'";
				$resultat = mysqli_query($veza1,$upito);
				$teroh    = mysqli_fetch_array($resultat);
				$upiso    = $teroh['sifra_clana'];

				if ($upiso==$opera){
					echo "1";  //UPISAO REZERVACIJU
				} else {
					echo "2"; //NISAM upisao rezervaciju. Provjeri podatke i probaj još jednom 
				}
			} else {
				echo "3"; //Termin je vec zauzet
			}
		} else {
			if ($rteren and $rsatni and substr($danre,6,4)>'2020' and $opera and $cijena){
				$jadan=substr($danre,6,4)."-".substr($danre,3,2)."-".substr($danre,0,2);
				$danas=date("Y-m-d H:i:s");
				
				$upisiga  = "INSERT INTO rezervacije VALUES ('".$jadan."',".$rteren.",".$rsatni.",".$opera.",'".$clapre.
						"','".$termin."',".$cijena.",1,0,'0000-00-00 00:00:00',1,".$lmter1.",".$opera.",0,".$cijena.",'','".
						$danas."',0,0.00,0,'','','','".$protiv."',0)";
				
				//$upisiga="INSERT INTO rezervacije VALUES ('$jadan', '$rteren', '$rsatni', '$opera', '$clapre', '$termin', '$cijena', '1', '', '', '1', '$lmter1', '$opera', '', '$cijena', '', '$danas','','','','','','','$protiv','')";
				
				$zapisito = mysqli_query($veza1,$upisiga);
	
				if ($logdato=="1"){
					$logvri=date("Y-m-d H:i:s");
					$logdat="INSERT INTO log VALUES ('$logvri', '$opera', '$clapre', '1', '$rteren', '$rsatni', '$cijena', '1', '$nacinpl', '$jadan')";
					$logdat1= mysqli_query($veza1,$logdat);
				}
	
				if ($nama1){
					$termi1   = $rsatni+1;
					$upit11   = "SELECT * FROM termini WHERE sifra='$termi1'";
					$resul11  = mysqli_query($veza1,$upit11);
					$ter11    = mysqli_fetch_array($resul11);
					$satnica  = $ter11['satnica'];

					$upitoy1  = "SELECT id AS sloboda FROM rezervacije WHERE termin='$termi1' and teren='$rteren' and datum='$jadan'";
					$resulty1 = mysqli_query($veza1,$upitoy1);
					$terohy1  = mysqli_fetch_array($resulty1);
					$etovam1  = $terohy1['sloboda'];

					if ($etovam1<1){
						
						$upisiga1  = "INSERT INTO rezervacije VALUES ('".$jadan."',".$rteren.",".$rsatni.",".$opera.",'".$clapre.
							"','".$termin."',".$cijena.",1,0,'0000-00-00 00:00:00',1,".$lmter1.",".$opera.",0,".$cijena.",'','".
							$danas."',0,0.00,".$terpi.",'','','','".$protiv."',0)";
						
						//$upisiga1  = "INSERT INTO rezervacije VALUES ('$jadan', '$rteren', '$termi1', '$opera', '$clapre', '$satnica', '$cijena', '1', '', '', '1', '$lmter1', '$opera', '', '$cijena', '', '$danas','','','$terpi','','','','$protiv','')";
						$zapisito1 = mysqli_query($veza1,$upisiga1);

						if ($logdato=="1"){
							$logvri  = date("Y-m-d H:i:s");
							$logdat  = "INSERT INTO log VALUES ('$logvri', '$opera', '$clapre', '1', '$rteren', '$termi1', '$cijena', '1', '$nacinpl', '$jadan')";
							$logdat1 = mysqli_query($veza1,$logdat);
						}
					}
				}
				if ($nama2){
					$termi2   = $rsatni+2;
					$upit12   = "SELECT * FROM termini WHERE sifra='$termi2'";
					$resul12  = mysqli_query($veza1,$upit12);
					$ter12    = mysqli_fetch_array($resul12);
					$satnica  = $ter12['satnica'];

					$upitoy2  = "SELECT id AS sloboda FROM rezervacije WHERE termin='$termi2' and teren='$rteren' and datum='$jadan'";
					$resulty2 = mysqli_query($veza1,$upitoy2);
					$terohy2  = mysqli_fetch_array($resulty2);
					$etovam2  = $terohy2['sloboda'];

					if ($etovam2<1){
						$upisiga2  = "INSERT INTO rezervacije VALUES ('".$jadan."',".$rteren.",".$rsatni.",".$opera.",'".$clapre.
							"','".$termin."',".$cijena.",1,0,'0000-00-00 00:00:00',1,".$lmter1.",".$opera.",0,".$cijena.",'','".
							$danas."',0,0.00,".$terpi.",'','','','".$protiv."',0)";
						
						
						//$upisiga2  = "INSERT INTO rezervacije VALUES ('$jadan', '$rteren', '$termi2', '$opera', '$clapre', '$satnica', '$cijena', '1', '', '', '1', '$lmter1', '$opera', '', '$cijena', '', '$danas','','','$terpi','','','','$protiv','')";
						$zapisito2 = mysqli_query($veza1,$upisiga2);
						if ($logdato=="1"){
							$logvri  = date("Y-m-d H:i:s");
							$logdat  = "INSERT INTO log VALUES ('$logvri', '$opera', '$clapre', '1', '$rteren', '$termi2', '$cijena', '1', '$nacinpl', '$jadan')";
							$logdat1 = mysqli_query($veza1,$logdat);
						}
					}
				}
				if ($nama3){
					$termi3   = $rsatni+3;
					$upit13   = "SELECT * FROM termini WHERE sifra='$termi3'";
					$resul13  = mysqli_query($veza1,$upit13);
					$ter13    = mysqli_fetch_array($resul13);
					$satnica  = $ter13['satnica'];

					$upitoy3  = "SELECT id AS sloboda FROM rezervacije WHERE termin='$termi3' and teren='$rteren' and datum='$jadan'";
					$resulty3 = mysqli_query($veza1,$upitoy3);
					$terohy3  = mysqli_fetch_array($resulty3);
					$etovam3  = $terohy3['sloboda'];

					if ($etovam3<1){
						$upisiga3  = "INSERT INTO rezervacije VALUES ('".$jadan."',".$rteren.",".$rsatni.",".$opera.",'".$clapre.
							"','".$termin."',".$cijena.",1,0,'0000-00-00 00:00:00',1,".$lmter1.",".$opera.",0,".$cijena.",'','".
							$danas."',0,0.00,".$terpi.",'','','','".$protiv."',0)";
						
						
						//$upisiga3  = "INSERT INTO rezervacije VALUES ('$jadan', '$rteren', '$termi3', '$opera', '$clapre', '$satnica', '$cijena', '1', '', '', '1', '$lmter1', '$opera', '', '$cijena', '', '$danas','','','$terpi','','','','$protiv','')";
						$zapisito3 = mysqli_query($veza1,$upisiga3);
						if ($logdato=="1"){
							$logvri  = date("Y-m-d H:i:s");
							$logdat  = "INSERT INTO log VALUES ('$logvri', '$opera', '$clapre', '1', '$rteren', '$termi3', '$cijena', '1', '$nacinpl', '$jadan')";
							$logdat1 = mysqli_query($veza1,$logdat);
						}
					}
				}

				$upito="SELECT sifra_clana FROM rezervacije WHERE termin='$rsatni' and teren='$rteren' and datum='$jadan' and sifra_clana='$opera'";
				$resultat = mysqli_query($veza1,$upito);
				$teroh = mysqli_fetch_array($resultat);
				$upiso = $teroh['sifra_clana'];
	
				if ($upiso==$opera){
				    echo "1";  //UPISAO
				} else {
				    echo "2"; //NISAM upisao rezervaciju. Provjeri podatke i probaj još jednom
				}
			} else {
				//echo $jadan;
			    echo "33";  //Termin je vec zauzet
			}
		}
		
	//		DOVDE JE UPIS PODATAKA
	//================================================================================================
?>