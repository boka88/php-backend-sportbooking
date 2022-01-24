<?php 
date_default_timezone_set('Europe/Zagreb'); 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");	
	//ODAVDE IDE TRAZENJE ID BROJA UPISA ===============================
	//primer:    localhost:81/sportbooking/api/predotkaz.php?bteren=12&bsatni=9&bkada=2021-04-02
	/*
	localhost:81/sportbooking/api/predotkaz.php?username=demo1&passwd=demo1
	localhost:81/sportbooking/api/predupis.php?bteren=1&bsatni=9&bkada=2021-03-30
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
    echo "0";
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

if (!$opera or $prava<>"1" or !$klusif){
    echo "0";
}
$dozvola="";
$dozvol0="";
$dozvol1="";
$dozvol2="";
$dozvol3="";
$dozvol4="";
$dozvol5="";
$dozvol6="";
$dozvol7="";
$jedan="1";
$dvoje="2";
$nulla="0";
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
$ter11="";
$ukljuci="";
$poruka="";
$imaj1="";
$imaj2="";
$imaj3="";
$zada2="";
$zada3="";
$zada4="";
$zada5="";
$zada6="";
$zada7="";
$lmter="";

$canka=date("Y-m-d");
$zadan=date("Y-m-d");
$brdrez=0;
$upito20="SELECT sifra_clana FROM rezervacije WHERE sifra_clana='$opera' and datum='$zadan'";
$podaci	= mysqli_query($veza1,$upito20);   
while ($stmt = mysqli_fetch_array($podaci)){
	   $brdrez=$brdrez+1;
}
if ($brdrez>=$dancla){
	$dozvola="9";
}
$lovva="";
$brojy="";
$lovva=$nacinpl;
$zlock2=date("Y-m-d");
$zlocko=date("Y")."-01-01";
$godin=date("Y");
if ($uplcla2<$zlock2){
	$query6  = "SELECT clan_sifra FROM clanarina WHERE godina='$godin' and clan_sifra='$opera'";
	$podaci	 = mysqli_query($veza1,$query6);   
	$row	 = mysqli_fetch_array($podaci);
    $brojyy2 = $row['clan_sifra'];
} else {
	$brojyy2 = "11";
}

$termin="";
$cijena="";
$bteren="";
$bsatni="";
$rezer="";
$plati="";
$sika1="";
$sika2="";
$sika3="";
$sika4="";
$svzat="";
$neplaceno="";
$fixica=date("Y-m-d");

if (isset($_GET["sql3"])){
	$idbroj = $_GET["idbroj"];
	$upito="SELECT * FROM rezervacije WHERE id='$idbroj'";
	$podaci	= mysqli_query($veza1,$upito);   
	$terow	= mysqli_fetch_array($podaci);
	$datrez=$terow['datum'];
	$rteren=$terow['teren'];
	$rsatni=$terow['termin'];
	$clapre=$terow['prezime_ime'];
	$iznoss=$terow['cijena'];
	if ($logdato){
		$logvri=date("Y-m-d H:i:s");
		$upisi1 = "INSERT INTO log VALUES ('$logvri', '$opera', '$clapre', '2', '$rteren', '$rsatni', '$iznoss', '', '', '$datrez')";
		$upiso	= mysqli_query($veza1,$upisi1);   
	}
	$rezer="DELETE FROM rezervacije WHERE id='$idbroj'";
	$podaci	= mysqli_query($veza1,$rezer);   
	$idbroj="";
}

$upis3	= "SELECT SUM(cijena) AS duguje FROM rezervacije WHERE sifra_clana ='$opera' and status='0' and tip_termina<'3' and datum<='$fixica' and tip_placanja<'3'";
$podaci	= mysqli_query($veza1,$upis3);   
$row3	= mysqli_fetch_array($podaci);
$sika1	= $row3['duguje'];

$upis31="SELECT * FROM avansi WHERE sifra_clana ='$opera'";
$podaci	= mysqli_query($veza1,$upis31);   
while ($row31 = mysqli_fetch_array($podaci)){
	   $sika2=$sika2+$row31['iznos_uplate'];
	   $sika3=$sika3+$row31['iskoristeno'];
}
$svzat=$sika2-$sika3;
$godin=date("Y");
$platicla="";
if ($nacnate<"4"){
	if ($sika1>0 and $svzat>0){
		$totsvo="";
		$naplay="";
		$sadje=date("Y-m-d");
		$sadsa=date("H:i");
		$upitox1="SELECT * FROM rezervacije WHERE sifra_clana='$opera' and status='0' and tip_termina='1' and datum<='$fixica' and tip_placanja='1' ORDER BY datum";
		$podaci	= mysqli_query($veza1,$upitox1);   
		while ($terow = mysqli_fetch_array($podaci)){
			   $datrez=$terow['datum'];       
			   $rteren=$terow['teren'];       
			   $rsatni=$terow['termin'];      
			   $tkojee=$terow['prezime_ime']; 
			   $satnic=$terow['satnica'];      
			   $iznoss=$terow['cijena']; 
			   $idbroj=$terow['id']; 
			   $porez=$iznoss-($iznoss/($pdvst/100+1));
			   if ($datrez<$sadje){
				   if ($svzat>=($totsvo+$iznoss)){
						$xedos=date("Y-m-d H:i:s");
						$rezer1 = "UPDATE rezervacije SET status='1', nacin_placanja='3', naplatio='5', naplaceni_iznos='$iznoss', datum_placanja='$xedos' WHERE teren='$rteren' and termin='$rsatni' and datum='$datrez'";
						$podaci1 = mysqli_query($veza1,$rezer1);   
						if ($logdato=="1"){
							$logvri=date("Y-m-d H:i:s");
							$logdat1="INSERT INTO log VALUES ('$logvri', '5', '$tkojee', '3', '$rteren', '$rsatni', '$iznoss', '4', '3', '$datrez')";
							$podaci2 = mysqli_query($veza1,$logdat1);   
						}
						$rezer11 = "INSERT INTO avansi VALUES ('$opera', '$tkojee', '$xedos', '', '$iznoss', '13', '', '$idbroj', '$datrez', '$rteren', '$rsatni', '', '', '', '$xedos', '')";
						$podaci3 = mysqli_query($veza1,$rezer11);   
						$totsvo  = $totsvo+$iznoss;
						$naplay  = $naplay+$iznoss;
				   }
			   }
		}
		if ($fiskali>0 and $naplay>0){
			$kokos	= "G";
			$stopic = $pdvst/100+1;
			$osnova = round($naplay/$stopic,2);
			$ukpore = $naplay-$osnova;
	
			$upito4 = "SELECT MAX(racun) AS racko FROM naplata WHERE datum LIKE '$godin%'";
			$podac4 = mysqli_query($veza1,$upito4);   
			$terow4	= mysqli_fetch_array($podac4);
			$racun  = $terow4['racko']+1;
	
			$osnov1 = number_format($osnova,2,'.','');
			$porez1 = number_format($ukpore,2,'.','');
			$ukrac1 = number_format($naplay,2,'.','');
			if (!$oibcla){
				$oibcla=$oibbrf;
			}
			if ($putcer){
				require_once('class.FiskalPHP.php');
				$fiskal = new FiskalPHP('LIVE', NULL, NULL, NULL, '/usr/bin/');
				$fiskal->eOIBObveznika    = $oibbrf;
				$fiskal->certURI          = 'certs/'.$putcer;
				$fiskal->cert_pwd         = $pascer;
				$fiskal->eUSustPdv        = 'true';
				$fiskal->eDatVrijeme      = time();
				$datr1=date("Y-m-d");
				$vrije=date("H:i:s");
				$sadaa=date("Y-m-d H:i:s");
				$fiskal->eOznSlijed       = 'P';
				$fiskal->eBrOznRac        = $racun;
				$fiskal->eOznPosPr        = $klusif;
				$fiskal->eOznNapUr        = '1';
				$fiskal->eIznosUkupno     = $ukrac1;
				$fiskal->eNacinPlac       = $kokos;
				$fiskal->eOibOper         = $oibcla;
				$fiskal->eNakDost         = 'false';
				$fiskal->ePDV			  = array();
				if ($porez1+$porez2+$porez5<>0){
				    if ($porez1<>0){
					    $fiskal->ePDV[] = array('Stopa'=>'25.00','Osnovica'=>$osnov1,'Iznos'=>$porez1);
				    }
				    if ($porez1<>0){
					    $fiskal->ePDV[] = array('Stopa'=>'25.00','Osnovica'=>$osnov1,'Iznos'=>$porez1);
				    }
				    if ($porez2<>0){
					    $fiskal->ePDV[] = array('Stopa'=>'10.00','Osnovica'=>$osnov2,'Iznos'=>$porez2);
				    }
				    if ($porez5<>0){
					    $fiskal->ePDV[] = array('Stopa'=>'5.00','Osnovica'=>$osnov5,'Iznos'=>$porez5);
				    }
				    if ($potros<>0){
					    $fiskal->ePNP   = array();
					    $fiskal->ePNP[] = array('Stopa'=>'3.00','Osnovica'=>$osnpot,'Iznos'=>$potros);
				    } 
				} else {
					$fiskal->ePDV    = NULL;
				}
				$fiskal->eParagonBrRac	  = $racun.'/'.$klusif.'/1';
				$fiskal->RacunNS          = 'tnas';
				$XML = $fiskal->RacunZahtjev();
				$fiskal->outputXmlSignedFile = 'potpisana_poruka_phpShell2.xml';
				$fiskal->inputXmlFile        = 'testRacun.xml';
				file_put_contents($fiskal->inputXmlFile, $XML);
				$IdPoruke = $fiskal->get_IdPoruke();
				$ZKI = $fiskal->get_ZKI();
				$potpisano = $fiskal->sign_XML($fiskal->racunID);
				if ($potpisano){
				    $signedStoredXML = file_get_contents($fiskal->outputXmlSignedFile);
				    $request = $fiskal->send_Soap_Request($signedStoredXML);
				    if ($request){
				        if ($reqResult = $fiskal->get_Soap_Result()){
				        } else {
						    file_put_contents('greske/greske.log', 'Nije uspjelo: '. print_r($fiskal->get_Errors(TRUE),1) );
						}
					} else {
						file_put_contents('greske/greske.log', $fiskal->get_Errors(TRUE));
					    $fiskal->empty_Errors(); 
					}
				} else {
					file_put_contents('greske/greske.log', $fiskal->get_Errors(TRUE));
				    $fiskal->empty_Errors(); 
				}
				$jiric=$reqResult['Jir'];
				$zkiic=$ZKI;
				$ideic=$IdPoruke;
				$upisntj = "INSERT INTO jir VALUES ('$klusif','$opera','$sadaa','$racun','$ideic','$zkiic','$jiric','$naplay','$ukpore','','')";
				$podaci1 = mysqli_query($veza1,$upisntj);
	
				$rezer2  ="INSERT INTO naplata VALUES ('$racun', '$rteren', '$rsatni', '$termin', '$zadan', '$vrije', '$opera', '$naplay', '$ukpore', '$opera', '$clapre', '13', '', '', '', '$xedos', '')";
				$podaci2 = mysqli_query($veza1,$rezer2);  
				if ($logdato=="1"){
					$logvri  = date("Y-m-d H:i:s");
					$logdat  ="INSERT INTO log VALUES ('$logvri', '$opera', '$tkoje', '4', '$rteren', '$rsatni', '$naplay', '$stoje', '$nacpla', '$zadan')";
					$podaci3 = mysqli_query($veza1,$logdat);   
				}
			}
		}
		$sika1="";
		$sika2="";
		$sika3="";
		$sika4="";
		$svzat="";
		$neplaceno="";
		$upis3	= "SELECT SUM(cijena) AS duguje FROM rezervacije WHERE sifra_clana ='$opera' and status='0' and tip_termina='1' and datum<='$fixica' and tip_placanja<'3'";
		$podaci	= mysqli_query($veza1,$upis3);   
		$row3	= mysqli_fetch_array($podaci);
	    $sika1	= $row3['duguje'];
	
		$upis31="SELECT * FROM avansi WHERE sifra_clana ='$opera'";
		$podaci	= mysqli_query($veza1,$upis31);   
		while ($row31 = mysqli_fetch_array($podaci)){
			   $sika2=$sika2+$row31['iznos_uplate']; 
			   $sika3=$sika3+$row31['iskoristeno'];  
		}
	}
}
$neplaceno=$sika3+$sika1-$sika2;
if ($claopome>0){
	$upito25= "SELECT sifra_clana FROM clanarina WHERE clan_sifra='$opera' and godina='$godin'";
	$podaci	= mysqli_query($veza1,$upito25);   
	$row3	= mysqli_fetch_array($podaci);
    $nesto  = $row3['sifra_clana'];
	if ($nesto<0){
		$platicla="11";
	}
}  
				//satnica po terenima 
				$imaga="";
				$daxax=date("Y-m-d");
				$upitow="SELECT teren AS nesto FROM raspored WHERE datum='$daxax'";
				$podaci5 = mysqli_query($veza1,$upitow);   
				$werow	 = mysqli_fetch_array($podaci5);
				$imaga=$werow['nesto'];
				if ($imaga){ 
														
				} 		



	// ----- GLAVNA PETLJA -------
	// ---- rasporedi po danima ------

	$sifraterena = 0;

	if (isset($_GET["sifraterena"])){
		$sifraterena = $_GET["sifraterena"];
	}

			$jsonosnovni = "[{";
			$statuspolja = "0";
			
			$zadan  = date("Y-m-d");
			$sirin  = round(636/$redan,0);
			$upitox4= "SELECT * FROM tereni WHERE tip_terena>'0' and status>'0' and sifra='$sifraterena' ORDER BY sifra";
			$podaci0= mysqli_query($veza1,$upitox4);   
			while ($xerow4 = mysqli_fetch_array($podaci0)){
				   $nazter=$xerow4['naziv'];
				   $sifter=$xerow4['sifra'];
				   $oznter=$xerow4['oznaka'];
				   $tipter=$xerow4['tip_terena'];
				   $sifsat=$xerow4['sifra'];
				   $rassat=substr($xerow4['bez_rasvjete_do'],0,5);
				   /*
					echo "<div align='center'>";
				   		echo "<font class='terenfont'>";
							echo $nazter;
						echo "</font>";
					echo "</div>";
					echo "<div class='table-responsive' align='center'>";
				   		echo "<table class='table table-bordered max-width-1010-flex boxshadowpanel1'>";
							echo "<thead class='backgroundplava terminiterenafont' align='center'>";
							echo "<tr>";
								echo "<th class='max-width-table terminiterenafont' rowspan='2'>".$rek018."</th>";
								echo "<th class='terminiterenafont' colspan='".$redan."'>".$dod034."</th>";
							echo "</tr>";
							echo "<tr>";
					*/
								$sadaa=0;
								$prida=date("d.m.Y");
								$zadan=date("Y-m-d");
								
								
								//--- DRUGA PETLJA DATUMI - ZAGLAVLJE TABELE --------
								$nazivdana = '';
								$ii = 1;
								while ($sadaa<$redan){
									   //echo "<th class='terminiterenafont' width='".$sirin."'>".substr($prida,0,5)."<br>";
										   $danka=date("l", mktime(0, 0, 0, substr($zadan,5,2), substr($zadan,8,2), substr($zadan,0,4))); 
											   if ($danka=="Monday"){
													if ($jezik<"2"){
														$nazivdana = "Ponedjeljak";
													} elseif($jezik=="2"){
														$nazivdana = "Monday";
													} elseif($jezik=="3"){
														$nazivdana = "Montag";
													} else {
														$nazivdana = "Monday";
													}
												} elseif($danka=="Tuesday"){
													if ($jezik<"2"){
														$nazivdana = "Utorak";
													} elseif($jezik=="2"){
														$nazivdana = "Tuesday";
													} elseif($jezik=="3"){
														$nazivdana = "Dienstag";
													} else {
														$nazivdana = "Tuesday";
													}
												} elseif($danka=="Wednesday"){
													if ($jezik<"2"){
														$nazivdana = "Srijeda";
													} elseif($jezik=="2"){
														$nazivdana = "Wednesday";
													} elseif($jezik=="3"){
														$nazivdana = "Mittwoch";
													} else {
														$nazivdana = "Wednesday";
													}
												} elseif($danka=="Thursday"){
													if ($jezik<"2"){
														$nazivdana = "Četvrtak";
													} elseif($jezik=="2"){
														$nazivdana = "Thursday";
													} elseif($jezik=="3"){
														$nazivdana = "Donnerstag";
													} else {
														$nazivdana = "Thursday";
													}
												} elseif($danka=="Friday"){
													if ($jezik<"2"){
														$nazivdana = "Petak";
													} elseif($jezik=="2"){
														$nazivdana = "Friday";
													} elseif($jezik=="3"){
														$nazivdana = "Freitag";
													} else {
														$nazivdana = "Friday";
													}
												} elseif($danka=="Saturday"){
													if ($jezik<"2"){
														$nazivdana = "Subota";
													} elseif($jezik=="2"){
														$nazivdana = "Saturday";
													} elseif($jezik=="3"){
														$nazivdana = "Samstag";
													} else {
														$nazivdana = "Saturday";
													}
												} else {
													if ($jezik<"2"){
														$nazivdana = "Nedjelja";
													} elseif($jezik=="2"){
														$nazivdana = "Sunday";
													} elseif($jezik=="3"){
														$nazivdana = "Sontag";
													} else {
														$nazivdana = "Sunday";
													}
												}
									   //echo "</th>";
									   $jsonosnovni = $jsonosnovni . '"dan' . strval($ii) . '":"'. substr($prida,0,5) . '","nazivdana'.strval($ii).'":"' . $nazivdana;
									   if($ii < 4) {
										 $jsonosnovni = $jsonosnovni . '",';
									   } else {
										   $jsonosnovni = $jsonosnovni . '"';
									   } 
									   $sadaa=$sadaa+1;
									   $dadan=substr($prida,0,2)+1;
									   $damje=substr($prida,3,2);
									   $dagod=substr($prida,6,4);
									   $idess=date ("m-d-Y", mktime (0,0,0,$damje,$dadan,$dagod));
									   $zadan=substr($idess,6,4)."-".substr($idess,0,2)."-".substr($idess,3,2);
									   $prida=substr($idess,3,2).".".substr($idess,0,2).".".substr($idess,6,4);
									   $ii++;
								}// KRAJ DRUGE PETLJE
								
							$jsonosnovni = $jsonosnovni . ',"redovi":[';
							
							$upitox="SELECT * FROM termini2 WHERE status>'0' and teren='$sifter' ORDER BY sifra";
							$podaci1 = mysqli_query($veza1,$upitox);   
							
							//TRECA PETLJA PODACI REDOVA TEBELE
							$aa = 1;
							while ($xerow = mysqli_fetch_array($podaci1)){
								   if($aa>1){
										$jsonosnovni = $jsonosnovni . ",";   
								   }
								   
								   
								   $siftmn=$xerow['sifra'];
								   $termin=$xerow['satnica'];
								   
								   //ubacivanje satnice u json********************************
								   $jsonosnovni = $jsonosnovni . '{"vreme":"' . $termin . '",';

								   $lampa=substr($termin,0,5);							   
								   //echo "<tbody>";
								   //echo "<tr>";
										//echo "<td class='terminivrijemefont' align='center'>".$termin."</td>";
										$sadaa=0;
										$prida=date("d.m.Y");
										$zadan=date("Y-m-d");
										$pocet=date("Y-m-d");
										
										//CETVRTA PETLJA POLJA I STATUSI*************************
										$jj = 1;
										while ($sadaa<$redan){
											//ubacuje zarez posle svakog polja osim zadnjeg
											if($jj > 1){
												$jsonosnovni = $jsonosnovni . ',';
											}
											
											   $upito24 ="SELECT * FROM rezervacije WHERE termin='$siftmn' and teren='$sifter' and datum='$zadan'";
											   $podaci4 = mysqli_query($veza1,$upito24);   
											   $terow	= mysqli_fetch_array($podaci4);
											   $clann=$terow['sifra_clana'];
											   $igrac=$terow['prezime_ime'];
											   $kojid=$terow['id'];
											   $natpx=$terow['prezime_ime']." - ".$terow['rez11'];
											   $natpy=$terow['rez11'];
											   $luka1=$terow['tip_termina'];
											   $dozvola="";
											    if ($dancla){
													$upitox20 = "SELECT COUNT(sifra_clana) AS zbirno FROM rezervacije WHERE sifra_clana='$opera' and datum='$zadan'";
													$podaci20 = mysqli_query($veza1,$upitox20);   
													$terox20  = mysqli_fetch_array($podaci20);
													$brdrez	  = $terox20['zbirno'];
													if ($brdrez>=$dancla){
														$dozvola="nemozevise";
													}
												}

											      
												if (!$igrac){
													$slika="bi bi-calendar-plus imagessve";
												} elseif ($luka1=="1"){
													$slika="bi bi-person-lines-fill imagesindividualno";
												} elseif ($luka1=="2"){
													$slika="bi bi-file-font imagesiskolatenisa";
												} elseif ($luka1=="3"){
													$slika="bi bi-people-fill imagesitrening";
												} elseif ($luka1=="4"){
													$slika="bi bi-trophy imagessve";
												} else {
													$slika="bi bi-person-lines-fill imagesindividualno";
												}
											   $otkaz=$satot*3600;
											   $satii=date("H:i");
											   $time1=date('H:i',time()+$otkaz);
											   //echo "<td width='".$sirin."'><center>";
													if ($clann==$opera){
														if ($satot){
															if ($time1>$lampa and $sadaa<1){
																$statuspolja="4";
																//echo "<i class='bi bi-person-bounding-box imagesmojtermin' data-bs-toggle='tooltip' data-bs-placement='bottom' title='".$dod044."'></i>";
															} else {
																if ($otknapo>0){
																	if ($zadan==$pocet and $satii>$termin){ 
																		$statuspolja="4";
																		//<a href="rekrerezultat1.php?idbroj=  echo $kojid;  " onclick="NewWindow(this.href,'mywin','350','650','yes','center'); return false" onfocus="this.blur()"><i class='bi bi-person-bounding-box imagesmojtermin' data-bs-toggle='tooltip' data-bs-placement='bottom' title="  echo $nap054  "></i></a>
																	} else { 
																		$statuspolja="5";
																		//<a href="rekreotk.php?idbroj=  echo $kojid;  " onclick="NewWindow(this.href,'mywin','350','540','yes','center'); return false" onfocus="this.blur()"><i class='bi bi-person-bounding-box imagesmojtermin' data-bs-toggle='tooltip' data-bs-placement='bottom' title='  echo $nap037  '></i></a> 
																	}
																} else {
																	$statuspolja="4";
																	//echo "<a href='rekreacija.php?sql3=del&amp;idbroj=".$kojid."' onclick=\"return confirm('".$igrac.", ".$rek022." ".$sifter." ".$rek023." ".$siftmn."'); return false;\"><i class='bi bi-person-bounding-box imagesmojtermin' data-bs-toggle='tooltip' data-bs-placement='bottom' title='".$dod058.": ".$natpy."'></i></a>";
																}
															}
														} else {
															if ($satii<$lampa){
																if ($otknapo>0){ 
																	$statuspolja="5";
																	//<a href="rekreotk.php?idbroj=<?php echo $kojid; " onclick="NewWindow(this.href,'mywin','350','540','yes','center'); return false" onfocus="this.blur()"><i class='bi bi-person-bounding-box imagesmojtermin' data-bs-toggle='tooltip' data-bs-placement='bottom' title='<?php echo $nap037
																} else {
																	$statuspolja="4";
																	//echo "<a href='rekreacija.php?sql3=del&amp;idbroj=".$kojid."' onclick=\"return confirm('".$igrac.", ".$rek022." ".$sifter." ".$rek023." ".$siftmn."'); return false;\"><i class='bi bi-person-bounding-box imagesmojtermin' data-bs-toggle='tooltip' data-bs-placement='bottom' title='".$dod058.": ".$natpy."'></i></a>";
																}
															} else {
																$statuspolja="5";
																//echo "<i class='bi bi-person-bounding-box imagesmojtermin'></i>";
															}
														}
													} else {
														if (!$igrac){
															if ($predrez<"2"){
																if ($rassat and $rassat<$lampa){
																	//sijalica - neosvetljen
																	$statuspolja="9";
																	// danas - prošlo vrijeme za rezervaciju - tu ubaci novu ikonu
																	//echo "<i class='bi bi-lightbulb-off imagesnedostupanteren' data-bs-toggle='tooltip' data-bs-placement='bottom' title='".$ppk064.$rassat."'></i>";
																} else {
																	if (!$dozvola){
																		if ($satii>$lampa and $zadan==$fixica){
																			$statuspolja = "0";
																		} else { 
																		    $statuspolja = "1";
																		}
																	    //<a href="rekreacijax1.php?bteren=<?php echo $sifter &bsatni=<?php echo $siftmn &bkada=<?php echo $zadan " onclick="NewWindow(this.href,'name','350','620','yes');return false"><i class='bi bi-calendar-plus imagesslobodantermin' data-bs-toggle='tooltip' data-bs-placement='bottom' title='<?php echo $dod045 '></i></a>
																	} else {
																		$statuspolja = "0";
																		//echo "<i class='bi bi-x-circle imagesnedostupanteren' data-bs-toggle='tooltip' data-bs-placement='bottom' title='".$upu033."'></i>";
																	}
																}
															} else {
																if ($rassat and $rassat<$lampa){		// danas - prošlo vrijeme za rezervaciju - tu ubaci novu ikonu
																	////$statuspolja = "9"; ////
																	$statuspolja = "0";
																	//echo "<i class='bi bi-lightbulb-off imagesnedostupanteren' data-bs-toggle='tooltip' data-bs-placement='bottom' title='".$ppk064.$rassat."'></i>";
																} else {
																	if (!$dozvola){
																		if ($satii>$lampa and $zadan==$fixica){
																			$statuspolja = "0";
																			//echo "<i class='bi bi-x-circle imagesnedostupanteren' data-bs-toggle='tooltip' data-bs-placement='bottom' title='".$upu033."'></i>";
																		} else { 
																			$statuspolja = "1";
																		    //<a href="rekreacijax1p.php?bteren=<?php echo $sifter 
																		}
																	//<a href="rekreacijax1p.php?bteren=<?php echo $sifter &bsatni=<?php echo $siftmn &bkada=<?php echo $zadan " onclick="NewWindow(this.href,'name','350','640','yes');return false"><i class='bi bi-calendar-plus imagesslobodantermin' data-bs-toggle='tooltip' data-bs-placement='bottom' title='<?php echo $dod045 '></i></a>
																	} else {
																		$statuspolja = "0";
																		//echo "<i class='bi bi-x-circle imagesnedostupanteren' data-bs-toggle='tooltip' data-bs-placement='bottom' title='".$upu033."'></i>";
																	}
																}
															}
														} else {
															$statuspolja = "4";
															//echo "<i class='".$slika."' data-bs-toggle='tooltip' data-bs-placement='bottom' title='".$igrac."'></i>";
														}
													}
											   //echo "</td>";
											   //uzimanje polja i statusa ********************************
												$jsonosnovni = $jsonosnovni . '"polje'.$jj.'":[{"datum":"'.substr($prida,0,2).'.'.substr($prida,3,2).'.'.substr($prida,6,4).
															'","status":"'.$statuspolja.'"}]';	   
											   
											   $statuspolja = "0";
											   $sadaa=$sadaa+1;
											   $dadan=substr($prida,0,2)+1;
											   $damje=substr($prida,3,2);
											   $dagod=substr($prida,6,4);
											   $idess=date ("m-d-Y", mktime (0,0,0,$damje,$dadan,$dagod));
											   $zadan=substr($idess,6,4)."-".substr($idess,0,2)."-".substr($idess,3,2);
											   $prida=substr($idess,3,2).".".substr($idess,0,2).".".substr($idess,6,4);
											
											
											$jj++;
										}
								   $jsonosnovni = $jsonosnovni . "}";
								$aa++;
							} 
				   $sadaa=$sadaa+1;
				   $dadan=substr($zadan,8,2)+1;
				   $damje=substr($zadan,5,2);
				   $dagod=substr($zadan,0,4);
			} 
			$jsonosnovni = $jsonosnovni . "]}]";
		echo $jsonosnovni;

?>