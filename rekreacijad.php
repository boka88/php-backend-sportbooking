<?php 
include 'connect.php';

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
$brterena=0;

$upito11  = "SELECT COUNT(sifra) AS brojka FROM tereni WHERE tip_terena>'0' and status>'0'";
$podaci11 = mysqli_query($veza1,$upito11);   
$tero11   = mysqli_fetch_array($podaci11);
$brterena = $tero11['brojka'];
$sirin	  = round(636/$brterena,0);

$canka	  = date("Y-m-d");
$zadan	  = date("Y-m-d");
$brdrez	  = 0;
$upito20  = "SELECT sifra_clana FROM rezervacije WHERE sifra_clana='$opera' and datum='$zadan'";
$podaci	  = mysqli_query($veza1,$upito20);   
while ($stmt = mysqli_fetch_array($podaci)){
	   $brdrez=$brdrez+1;
}
if ($brdrez>=$dancla){
	$dozvola="9";
}
$lovva="";
$brojy="";
$brojyy2="";
$lovva=$nacinpl;
$zlock2=date("Y-m-d");
$zlocko=date("Y")."-01-01";
if ($uplcla2>"2000"){
	$query6 = "SELECT prezime_ime FROM naplata WHERE termin='99' and datum>='$zlocko' and clan_sifra='$opera'";
	$podaci	= mysqli_query($veza1,$query6);   
	$row	= mysqli_fetch_array($podaci);
    $brojy	= $row['prezime_ime'];
	if ($brojy and $necnap>0){
		$brojyy2="11";
	}
}

$termin="";
$cijena="";
$bteren="";
$bsatni="";
$rezer="";
$plati="";
$sika1="";
$sika2=0;
$sika3=0;
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

$upis3="SELECT SUM(cijena) as ccc FROM rezervacije WHERE sifra_clana ='$opera' and status='0' and tip_termina<'3' and datum<='$fixica' and tip_placanja<'3'";
$podaci	= mysqli_query($veza1,$upis3);   
$row3	= mysqli_fetch_array($podaci);

//---------------------------
$sika1=$row3['ccc'];
//print_r($sika1,$row3);

$upis31="SELECT * FROM avansi WHERE sifra_clana ='$opera'";
$podaci	= mysqli_query($veza1,$upis31);   
//1print_r($podaci['lengths']);
	while ($row31 = mysqli_fetch_array($podaci)){
		   $sika2=$sika2+$row31['iznos_uplate'];
		   //-------------------------------------
		   //print_r($sika2);
		   $sika3=$sika3+$row31['iskoristeno'];
		   //-------------------------------------
	}
	$svzat=$sika2-$sika3;
	if ($sika1>0 and $svzat>0){
		$totsvo=0;
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
			   $porez=$iznoss-($iznoss/($pdvst/100+1));
			   if ($datrez<$sadje){
				   if ($svzat>=($totsvo+$iznoss)){
						$xedos=date("Y-m-d H:i:s");
						$rezer1 = "UPDATE rezervacije SET status='1', nacin_placanja='3', tip_placanja='3', naplatio='5', naplaceni_iznos='$iznoss', datum_placanja='$xedos' WHERE teren='$rteren' and termin='$rsatni' and datum='$datrez'";
						$podaci1 = mysqli_query($veza1,$rezer1);   
						if ($logdato=="1"){
							$logvri=date("Y-m-d H:i:s");
							$logdat1="INSERT INTO log VALUES ('$logvri', '5', '$tkojee', '3', '$rteren', '$rsatni', '$iznoss', '4', '3', '$datrez')";
							$podaci2 = mysqli_query($veza1,$logdat1);   
						}
						$rezer11="INSERT INTO avansi VALUES ('$opera', '$tkojee', '$xedos', '', '$iznoss', '$datrez', '', '1', '', '', '', '', '', '', '$xedos', '')";
						$podaci3 = mysqli_query($veza1,$logdat1);   
						$totsvo=$totsvo+$iznoss;
				   }
			   }
		}
		$sika1="";
		$sika2=0;
		$sika3=0;
		$sika4="";
		$svzat="";
		$neplaceno="";
		$upis3="SELECT SUM(cijena) as ccc FROM rezervacije WHERE sifra_clana ='$opera' and status='0' and tip_termina='1' and datum<='$fixica' and tip_placanja<'3'";
		$podaci	= mysqli_query($veza1,$upis3);   
		$row3	= mysqli_fetch_array($podaci);
		$sika1=$row3['ccc'];

		$upis31="SELECT * FROM avansi WHERE sifra_clana ='$opera'";
		$podaci	= mysqli_query($veza1,$upis31);   
		while ($row31 = mysqli_fetch_array($podaci)){
			   $sika2=$sika2+$row31['iznos_uplate']; 
			   $sika3=$sika3+$row31['iskoristeno'];  
		}
	}
$neplaceno=$sika3+$sika1-$sika2;
$claopomena="";
if ($claopome>0){
	$upito25="SELECT sifra_clana FROM rezervacije WHERE sifra_clana='$opera' and datum='$zadaf'";
	$podaci	= mysqli_query($veza1,$upito25);   
	$row3	= mysqli_fetch_array($podaci);
    $nesto=$row3['sifra_clana'];
	if ($nesto){
		$claopomena="+";
	}
} 
	//GLAVNI JSON OBJEKAT KOJI SE PRAVI RUCNO *******************************
	$jsonglavni = "[";
	//BROJI DANE OD 1 DO 4
	$ii = 1;	//strval($ii);
	$iired = 1;	//broji redove
	$iipolje = 1; //broji polja u jednom redu
	$nazivdana = "";
	//da li je teren zauzet ili nije (koja slika)
	$statuspolja = 1;
	//*******************************************************************
	$sadaa=0;
	$kadaa=date("Y-m-d");
	$dadan=date("d");
	$damje=date("m");
	$dagod=date("Y");
	$spored=0;
	
	//PETLJA ZA DANE - TABELE ***********************************************
	while ($sadaa<$redan){
		if ($ii > 1){
			$jsonglavni = $jsonglavni . ',';
		}
		
		   $idess=date ("m-d-Y", mktime (0,0,0,$damje,$dadan,$dagod));
		   $zadan=substr($idess,6,4)."-".substr($idess,0,2)."-".substr($idess,3,2);
		   $prida=substr($idess,3,2).".".substr($idess,0,2).".".substr($idess,6,4);
		   $danka=date("l", mktime(0, 0, 0, $damje, $dadan, $dagod)); 
			
			$jsonglavni = $jsonglavni . '{"opera":' . $_SESSION['opera'] . ',';
			$jsonglavni = $jsonglavni . '"clapre":"' . $_SESSION['clapre'] . '",';
			$jsonglavni = $jsonglavni . '"prava":' . $_SESSION['prava'] . ',';
			$jsonglavni = $jsonglavni . '"klusif":' . $_SESSION['klusif'] . ',';
			$jsonglavni = $jsonglavni . '"nacinpl":' . $_SESSION['nacinpl'] . ',';
			$jsonglavni = $jsonglavni . '"jezik":' . $_SESSION['jezik'] . ',';
			$jsonglavni = $jsonglavni . '"klubbaza":"' . $_SESSION['klubbaza'] . '",';
			$jsonglavni = $jsonglavni . '"oibcla":"' . $_SESSION['oibcla'] . '",';
			$jsonglavni = $jsonglavni . '"dan":' . strval($ii) . ',';
		   //DATUM IZNAD TABELE ***************************************************
		   
			   if ($danka=="Monday"){
					if ($jezik<"2"){
						$nazivdana = "Ponedjeljak ";
					} elseif($jezik=="2"){
						$nazivdana = "Monday ";
					} elseif($jezik=="3"){
						$nazivdana = "Montag ";
					} else {
						$nazivdana = "Monday ";
					}
				} elseif($danka=="Tuesday"){
					if ($jezik<"2"){
						$nazivdana = "Utorak ";
					} elseif($jezik=="2"){
						$nazivdana = "Tuesday ";
					} elseif($jezik=="3"){
						$nazivdana = "Dienstag ";
					} else {
						$nazivdana = "Tuesday ";
					}
				} elseif($danka=="Wednesday"){
					if ($jezik<"2"){
						$nazivdana = "Srijeda ";
					} elseif($jezik=="2"){
						$nazivdana = "Wednesday ";
					} elseif($jezik=="3"){
						$nazivdana = "Mittwoch ";
					} else {
						$nazivdana = "Wednesday ";
					}
				} elseif($danka=="Thursday"){
					if ($jezik<"2"){
						$nazivdana = "Cetvrtak, ";
					} elseif($jezik=="2"){
						$nazivdana = "Thursday, ";
					} elseif($jezik=="3"){
						$nazivdana = "Donnerstag ";
					} else {
						$nazivdana = "Thursday ";
					}
				} elseif($danka=="Friday"){
					if ($jezik<"2"){
						$nazivdana = "Petak ";
					} elseif($jezik=="2"){
						$nazivdana = "Friday ";
					} elseif($jezik=="3"){
						$nazivdana = "Freitag ";
					} else {
						$nazivdana = "Friday ";
					}
				} elseif($danka=="Saturday"){
					if ($jezik<"2"){
						$nazivdana = "Subota ";
					} elseif($jezik=="2"){
						$nazivdana = "Saturday ";
					} elseif($jezik=="3"){
						$nazivdana = "Samstag ";
					} else {
						$nazivdana = "Saturday ";
					}
				} else {
					if ($jezik<"2"){
						$nazivdana = "Nedjelja ";
					} elseif($jezik=="2"){
						$nazivdana = "Sunday ";
					} elseif($jezik=="3"){
						$nazivdana = "Sonta, ";
					} else {
						$nazivdana = "Sunday ";
					}
				}
				// OVDE UZIMA DATUM $prida *********************
				//$jsonglavni = $jsonglavni . '"nazivdana":"'. $nazivdana .'","datum":"'. $prida.'","redovi":[';
				$jsonglavni = $jsonglavni . '"nazivdana":"'. $nazivdana .'","datum":"'. $prida.'"';
				
		   //OVDE POCINJE TABELA****************************************************
						$sql2="";
						$broter="1";
						$sifte="";
						$upitox4 = "SELECT * FROM tereni WHERE tip_terena>'0' and status>'0' ORDER BY sifra";
						$podaci4 = mysqli_query($veza1,$upitox4);   
						while ($xerow4 = mysqli_fetch_array($podaci4)){
							   if ($xerow4['tip_terena']=="1"){
								   //echo "<th class='terminiterenafont' width='".$sirin."'>".$xerow4['oznaka']."</th>";
							   } else {
								   //echo "<th class='terminiterenafont' width='".$sirin."'>".$xerow4['oznaka']."</th>";
							   }
						}
					
					$upitox="SELECT * FROM termini WHERE status>'0' ORDER BY sifra";
					$podaci1 = mysqli_query($veza1,$upitox);  
					$iired = 1;					
					//PETLJA ZA REDOVE*****************************************************
					while ($xerow = mysqli_fetch_array($podaci1)){
						   $sifte=$xerow['sifra'];
						   $termi=$xerow['satnica'];
						   
								/*if ($iired > 1){
									$jsonglavni = $jsonglavni . ',';
								}*/
						   
						   
						   if ($sadaa<1){
							   $lampa=substr($xerow['satnica'],0,5);							   
						   } else {
							   $lampa="";
						   }
						   //*********************** VREME TERMINA *********************************
							//$jsonglavni = $jsonglavni . '{"red":'.strval($iired).',"vreme":'.'"'. $termi .'",';	
							$iired = $iired + 1;
							//**********************************************************************
								$broter=1;
								$upitox42 = "SELECT * FROM tereni WHERE tip_terena>'0' and status>'0' ORDER BY sifra";
								$podaci42 = mysqli_query($veza1,$upitox42);   
								
								//PETLJA ZA JEDAN CEO RED JEDNOG TERMINA ******************************
								$iipolje = 1;
								while ($xerow42 = mysqli_fetch_array($podaci42)){
									/*if($iipolje > 1){
										$jsonglavni = $jsonglavni . ',';
									}*/
									$broter=$xerow42['sifra'];
									   $raster=$xerow42['rasvjeta'];
									   $rassat=substr($xerow42['bez_rasvjete_do'],0,5);
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
											$upito24 = "SELECT * FROM rezervacije WHERE termin='$sifte' and teren='$broter' and datum='$zadan'";
										    $podaci4 = mysqli_query($veza1,$upito24);   
										    $teroj4	 = mysqli_fetch_array($podaci4);
										    $clann   = $teroj4['sifra_clana'];
										    $igrac   = $teroj4['prezime_ime'];
										    $kojid   = $teroj4['id'];
										    $natpx   = $teroj4['prezime_ime']." - ".$terow['rez11'];
										    $natpy   = $teroj4['rez11'];
	
											if (!$igrac){
												$slika="bi bi-plus-square imagessve";
												//$statuspolja = 10;
											} elseif ($terow[7]=="1"){
												$slika="bi bi-person-lines-fill imagesindividualno";
												//$statuspolja = 1;
											} elseif ($terow[7]=="2"){
												$slika="bi bi-file-font imagesiskolatenisa";
												//$statuspolja = 2;
											} elseif ($terow[7]=="3"){
												$slika="bi bi-people-fill imagesitrening";
												//$statuspolja = 3;
											} elseif ($terow[7]=="4"){
												$slika="bi bi-trophy imagessve";
												//$statuspolja = 4;
											} else {
												$slika="bi bi-person-lines-fill imagesindividualno";
												//$statuspolja = 5;
											}
											$otkaz=$satot*3600;
											$time1=date('H:i',time()+$otkaz);
											$satii=date("H:i");
											if ($sadaa>0){
												$time1="";
											}
											if ($dozvola){								// koliko termina moze rezervirati
												if ($teroj4['sifra_clana']==$opera){	// vlastiti termini
													if ($zadan==$kadaa){				// danasnji dan
														if ($satii<$lampa){				// ako termin jos nije poceo
															if ($satot){				// ako je odredjen broj sati za otkazivanje
																if ($time1>$lampa){		// ako je sada+otkaz veci od pocetka termina - nema otkaza
																	//moj termin
																	$statuspolja = 4;
																	//echo "<i class='bi bi-person-bounding-box imagesmojtermin' title='".$dod044."'></i>";
																} else {
																	//moj termin moze se otkazati
																	$statuspolja = 5;
																	/*
																	if ($otknapo>0){ ?>
																		<a href="rekreotk.php?idbroj=<?php echo $kojid; ?>" onclick="NewWindow(this.href,'mywin','350','560','yes','center'); return false" onfocus="this.blur()"><i class='bi bi-person-bounding-box imagesmojtermin' title="<?php echo $nap037 ?>"></i></a><?php
																	} else {
																		//echo "<a href='rekreacija.php?sql3=del&amp;idbroj=".$kojid."' onclick=\"return confirm('".$teroj4['prezime_ime'].", ".$rek022." ".$teroj4['teren']." ".$rek023." ".$teroj4['satnica']."'); return false;\"><i class='bi bi-person-bounding-box imagesmojtermin' title='".$rek024."'></i></a>";
																	}
																	*/
																}
															} else {
																if ($satii<$lampa){		// satnica prije pocetka termina - slobodan otkaz
																	if ($otknapo>0){
																		$statuspolja = 5;
																		//moj termin moze se otkazati
																		//<a href="rekreotk.php?idbroj=<?php echo $kojid; " onclick="NewWindow(this.href,'mywin','350','560','yes','center'); return false" onfocus="this.blur()"><i class='bi bi-person-bounding-box imagesmojtermin' title="<?php echo $nap037 ?>"></i></a><?php
																	} else {
																		//moj teren
																		$statuspolja = 4;
																		//echo "<a href='rekreacija.php?sql3=del&amp;idbroj=".$kojid."' onclick=\"return confirm('".$teroj4['prezime_ime'].", ".$rek022." ".$teroj4['teren']." ".$rek023." ".$teroj4['satnica']."'); return false;\"><i class='bi bi-person-bounding-box imagesmojtermin' title='".$rek024."'></i></a>";
																	}
																} else {
																	//moj teren
																	$statuspolja = 4;
																	//echo "<i class='bi bi-person-bounding-box imagesmojtermin'></i>";
																}
															}
														} else {
															$statuspolja = 5;
															/*
															?>
															<a href="rekrerezultat1.php?idbroj=<?php echo $kojid; ?>" onclick="NewWindow(this.href,'mywin','350','680','yes','center'); return false" onfocus="this.blur()"><i class='bi bi-person-bounding-box imagesmojtermin' title="<?php echo $nap054 ?>"></i></a><?php
															*/
														}
													} else {								// otkazivanje za naredne dane
														if ($otknapo>0){ 
															//ista slika kao 4 samo moze otkazati
															$statuspolja = 5;
															/*
															?>
															<a href="rekreotk.php?idbroj=<?php echo $kojid; ?>" onclick="NewWindow(this.href,'mywin','350','560','yes','center'); return false" onfocus="this.blur()"><i class='bi bi-person-bounding-box imagesmojtermin' title="<?php echo $nap037 ?>"></i></a><?php
															*/
														} else {
															// moj zauzet teren
															$statuspolja = 4;
															//echo "<a href='rekreacija.php?sql3=del&amp;idbroj=".$kojid."' onclick=\"return confirm('".$teroj4['prezime_ime'].", ".$rek022." ".$teroj4['teren']." ".$rek023." ".$teroj4['satnica']."'); return false;\"><i class='bi bi-person-bounding-box imagesmojtermin' title='".$rek024."'></i></a>";
														}
													}
												} else {
													if (!$igrac){
														$statuspolja = 0;
														//echo "<i class='bi bi-x-circle imagesnedostupanteren'  title='".$upu033."'></i>";
													} else {
														//zauzet teren slika igraca
														$statuspolja = 2;
														//echo "<i class='".$slika."' title='".$igrac."'></i>";
													}
												}
											} else {
												if ($teroj4['sifra_clana']==$opera){
													if ($satot){
														if ($time1>$lampa){
															$statuspolja = 4;
															//echo "<i class='bi bi-person-bounding-box imagesmojtermin' title='".$dod044."'></i>";
														} else {
															if ($otknapo>0){ 
																$statuspolja = 5;
																/*
																?>
																<a href="rekreotk.php?idbroj=<?php echo $kojid; ?>" onclick="NewWindow(this.href,'mywin','350','560','yes','center'); return false" onfocus="this.blur()"><i class='bi bi-person-bounding-box imagesmojtermin' title="<?php echo $nap037 ?>"></i></a><?php
																*/
															} else {
																$statuspolja = 5;
																/*
																echo "<a href='rekreacija.php?sql3=del&amp;idbroj=".$kojid."' onclick=\"return confirm('".$teroj4['prezime_ime'].", ".$rek022." ".$teroj4['teren']." ".$rek023." ".$teroj4['satnica']."'); return false;\"><i class='bi bi-person-bounding-box imagesmojtermin' title='".$rek024."'></i></a>";
																*/
															}
														}
													} else {
														if ($satii<$lampa){
															if ($otknapo>0){ 
																$statuspolja = 5;
																/*
																?>
																<a href="rekreotk.php?idbroj=<?php echo $kojid; ?>" onclick="NewWindow(this.href,'mywin','350','560','yes','center'); return false" onfocus="this.blur()"><i class='bi bi-person-bounding-box imagesmojtermin' title="<?php echo $nap037 ?>"></i></a><?php
																*/
															} else {
																$statuspolja = 4;
																//echo "<a href='rekreacija.php?sql3=del&amp;idbroj=".$kojid."' onclick=\"return confirm('".$teroj4['prezime_ime'].", ".$rek022." ".$teroj4['teren']." ".$rek023." ".$teroj4['satnica']."'); return false;\"><i class='bi bi-person-bounding-box imagesmojtermin' title='".$rek024."'></i></a>";
															}
														} else {
															//echo "<i class='bi bi-person-bounding-box imagesmojtermin'></i>";
														}
													}
												} else {
													if (!$igrac){
														if ($sadaa<1){
															if ($satii<$lampa){
																if ($predrez<"2"){ 
																	/*
																	?>
																    <a href="rekreacijax2.php?bteren=<?php echo $broter ?>&bsatni=<?php echo $sifte ?>&bkada=<?php echo $zadan ?>" onclick="NewWindow(this.href,'name','350','660','yes');return false"><i class='bi bi-plus-square imagesslobodantermin' title='<?php echo $dod045 ?>'></i></a><?php
																	*/
																} else { 
																	/*
																	?>
																    <a href="rekreacijax2p.php?bteren=<?php echo $broter ?>&bsatni=<?php echo $sifte ?>&bkada=<?php echo $zadan ?>" onclick="NewWindow(this.href,'name','350','570','yes');return false"><i class='bi bi-plus-square imagesslobodantermin' title='<?php echo $dod045 ?>'></i></a><?php
																	*/
																}
															} else {
																$statuspolja = 0;
																//echo "<i class='bi bi-x-circle imagesnedostupanteren' title='".$upu033."'></i>";
															}
														} else { 
															if ($predrez<"2"){
																//slobodan termin
																$statuspolja = 1;																
																/*
																?>
															    <a href="rekreacijax2.php?bteren=<?php echo $broter ?>&bsatni=<?php echo $sifte ?>&bkada=<?php echo $zadan ?>" onclick="NewWindow(this.href,'name','350','660','yes');return false"><i class='bi bi-plus-square imagesslobodantermin' title='<?php echo $dod045 ?>'></i></a><?php
																*/
															} else { 
																//slobodan termin
																$statuspolja = 1;
																/*
																?>
															    <a href="rekreacijax2p.php?bteren=<?php echo $broter ?>&bsatni=<?php echo $sifte ?>&bkada=<?php echo $zadan ?>" onclick="NewWindow(this.href,'name','350','570','yes');return false"><i class='bi bi-plus-square imagesslobodantermin' title='<?php echo $dod045 ?>'></i></a><?php
																*/
															}
														}
													} else {
														$statuspolja = 2;
														//echo "<i class='".$slika."' title='".$igrac."'></i>";
													}
												}
											}
										//UBACUJE POLJA *****************************************************
											$upitox444 = "SELECT * FROM tereni WHERE sifra=".$broter;
											$podaci444 = mysqli_query($veza1,$upitox444);   
										    $teroj444	 = mysqli_fetch_array($podaci444);
										    $oznakaterena   = $teroj444['oznaka'];
										    $nazivterena   = $teroj444['naziv'];
										
										//$jsonglavni = $jsonglavni . '"polje'.$broter.'":' . $statuspolja;	
										
									$iipolje = $iipolje + 1;
								}
							//$jsonglavni = $jsonglavni . '}';
									
				    }
					$sadaa=$sadaa+1;
					$dadan=substr($zadan,8,2)+1;
					$damje=substr($zadan,5,2);
					$dagod=substr($zadan,0,4);
		$ii = $ii + 1;
		//$jsonglavni = $jsonglavni . ']}';
		$jsonglavni = $jsonglavni . '}';
		
	} 
	$jsonglavni = $jsonglavni . "]";
	echo $jsonglavni;

?>