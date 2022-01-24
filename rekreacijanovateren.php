<?php 
	include("connect.php"); 
	if ($tiprekw=="2"){
		//echo("<SCRIPT TYPE=\"text/javascript\">window.location.replace('rekreacijad.php');</SCRIPT>");
	}

	if (!$opera or $prava<>"1" or !$klusif){
		//echo("GRESKA");
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
$svzat=0;
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
$sika1=$row3['ccc'];

$upis31="SELECT * FROM avansi WHERE sifra_clana ='$opera'";
$podaci	= mysqli_query($veza1,$upis31);   
while ($row31 = mysqli_fetch_array($podaci)){
	   $sika2=$sika2+$row31['iznos_uplate'];
	   $sika3=$sika3+$row31['iskoristeno'];
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
$neplaceno=200.00;

// rasporedi po danima - za turnir - ako ima -->
			if ($porcla){ 
						$imaga="";
						$daxax=date("Y-m-d");
						$upitow="SELECT teren FROM raspored WHERE datum='$daxax'";
						$podaci5 = mysqli_query($veza1,$upitow);   
						$werow	 = mysqli_fetch_array($podaci5);
						$imaga=$werow['sifra'];
						if ($imaga){
						} 
			} 
//<!-- rasporedi po danima -->
			$upitox4="SELECT * FROM tereni WHERE tip_terena>'0' and status>'0' ORDER BY sifra";
			$podaci0= mysqli_query($veza1,$upitox4); 

			
	//GLAVNI JSON OBJEKAT KOJI SE PRAVI RUCNO *******************************
	$jsonglavni = '[';
	//UCITAVA TERENE
	$ii = 1;	//brojac terena
	$iired = 1;	//broji redove
	$iidatum = 1;	//broji datume
	$iipolje = 1; //broji polja u jednom redu
	$nazivdana = "";
	$nazivterena = "";
	//da li je teren zauzet ili nije (koja slika)
	$statuspolja = 0;
	//*******************************************************************
			while ($xerow4 = mysqli_fetch_array($podaci0)){
			
				   $nazter=$xerow4['naziv'];
				   $sifter=$xerow4['sifra'];
				   $oznter=$xerow4['oznaka'];
				   $tipter=$xerow4['tip_terena'];
				   $sifsat=$xerow4['sifra'];
				   
					// OVDE UZIMA NAZIV TERENA *****************************************************
					if ($ii>1){
						$jsonglavni = $jsonglavni . ']},';
					}
					$jsonglavni = $jsonglavni . '{"naziv":"'. $nazter . '",';
					//*******************************************************************************
								$sadaa=0;
								$sirin="";
								$prida=date("d.m.Y");
								
								//PETLJA ZA DATUME TERENA U ZAGLAVLJU TABELE ********************************
								
								$jsonglavni = $jsonglavni . '"datumi":{';
								$iidatum = 1;  //brojac za polja datum
								while ($sadaa<$redan){
									   //echo "<th class='terminiterenafont' width='".$sirin."'>".substr($prida,0,5)."</th>";
									   $sadaa=$sadaa+1;
									   $dadan=substr($prida,0,2)+1;
									   $damje=substr($prida,3,2);
									   $dagod=substr($prida,6,4);
									   $idess=date ("m-d-Y", mktime (0,0,0,$damje,$dadan,$dagod));
									   $zadan=substr($idess,6,4)."-".substr($idess,0,2)."-".substr($idess,3,2);
									   $prida=substr($idess,3,2).".".substr($idess,0,2).".".substr($idess,6,4);
									
									//UZIMA DATUME U JSON ZAGLAVLJE **************************************
									if ($iidatum == 1){
										$jsonglavni = $jsonglavni . '"datum'.strval($iidatum).'":"'.substr($prida,0,5) . '"';
									}else{
										$jsonglavni = $jsonglavni . ',"datum'.strval($iidatum).'":"'.substr($prida,0,5) . '"';
										
									}
									$iidatum = $iidatum + 1;
								}
								
								//********************************
								$jsonglavni = $jsonglavni . '}, "redovi":[';
								
							$upitox="SELECT * FROM termini2 WHERE status>'0' and teren='$sifter' ORDER BY sifra";
							$podaci1 = mysqli_query($veza1,$upitox);   
							
							//PETLJA ZA REDOVE SA TERMINOM I POLJIMA *************************************
							$iired = 1;
							while ($xerow = mysqli_fetch_array($podaci1)){
									   $siftmn=$xerow['sifra'];
									   $termin=$xerow['satnica'];
										$sadaa=0;
										$prida=date("d.m.Y");
										$zadan=date("Y-m-d");
										$pocet=date("Y-m-d");
										if ($iired > 1){
											$jsonglavni = $jsonglavni . ',';
										}
										
										//******************************************************************
										$jsonglavni = $jsonglavni . 
										'{"vreme":"'.$termin . '",';
										
										
										//PETLJA ZA STATUSE (POLJA)****************************
										
										
										$iipolje = 1;
										while ($sadaa<$redan){
											   $upito24 ="SELECT * FROM rezervacije WHERE termin='$siftmn' and teren='$sifter' and datum='$zadan'";
											   $podaci4 = mysqli_query($veza1,$upito24);   
											   $terow	= mysqli_fetch_array($podaci4);
											   $clann=$terow['sifra_clana'];
											   $igrac=$terow['prezime_ime'];
											   $kojid=$terow['id'];
											   $natpx=$terow['prezime_ime']." - ".$terow['rez11'];
											   $natpy=$terow['rez11'];
											   $luka1=$terow['tip_termina'];

											   if ($sadaa<1){
												   $lampa=substr($termin,0,5);							   
											   } else {
												   $lampa="";
											   }
											      
												if (!$igrac){
													$statuspolja = 0;
													$slika="bi bi-plus-square imagessve";
												} elseif ($luka1=="1"){
													$statuspolja = 1;
													$slika="bi bi-person-lines-fill imagesindividualno";
												} elseif ($luka1=="2"){
													$statuspolja = 2;
													$slika="bi bi-file-font imagesiskolatenisa";
												} elseif ($luka1=="3"){
													$statuspolja = 3;
													$slika="bi bi-people-fill imagesitrening";
												} elseif ($luka1=="4"){
													$statuspolja = 4;
													$slika="bi bi-trophy imagessve";
												} else {
													$statuspolja = 10;
													$slika="bi bi-person-lines-fill imagesindividualno";
												}
											   $otkaz=$satot*3600;
											   $satii=date("H:i");
											   $time1=date('H:i',time()+$otkaz);
											   //echo "<td width='".$sirin."'><center>";
													if ($clann==$opera){
														if ($satot){
															if ($time1>$lampa and $sadaa<1){
																$statuspolja = 5;
																//echo "<i class='bi bi-person-bounding-box imagesmojtermin' title='".$dod044."'></i>";
															} else {
																if ($otknapo>0){
																	if ($zadan==$pocet and $satii>$termin){
																			$statuspolja = 7;
																		/*
																		?>
																		<a href="rekrerezultat1.php?idbroj=<?php echo $kojid; ?>" onclick="NewWindow(this.href,'mywin','350','680','yes','center'); return false" onfocus="this.blur()"><i class='bi bi-person-bounding-box imagesmojtermin' title="<?php echo $nap054 ?>"></i></a><?php
																		*/
																	} else { 
																		$statuspolja = 8;
																		/*
																		?>
																		<a href="rekreotk.php?idbroj=<?php echo $kojid; ?>" onclick="NewWindow(this.href,'mywin','350','560','yes','center'); return false" onfocus="this.blur()"><i class='bi bi-person-bounding-box imagesmojtermin' title='<?php echo $dod058.": ".$natpy ?>'></i></a><?php
																		*/
																	}
																} else {
																	$statuspolja = 10;
																	//echo "<a href='rekreacija.php?sql3=del&amp;idbroj=".$kojid."' onclick=\"return confirm('".$igrac.", ".$rek022." ".$sifter." ".$rek023." ".$siftmn."'); return false;\"><i class='bi bi-person-bounding-box imagesmojtermin' title='".$dod058.": ".$natpy."'></i></a>";
																}
															}
														} else {
															if ($satii<$lampa){
																if ($otknapo>0){ 
																	$statuspolja = 6;
																	/*
																	?>
																	<a href="rekreotk.php?idbroj=<?php echo $kojid; ?>" onclick="NewWindow(this.href,'mywin','350','560','yes','center'); return false" onfocus="this.blur()"><i class='bi bi-person-bounding-box imagesmojtermin' title='<?php echo $dod058.": ".$natpy ?>'></i></a><?php
																	*/
																} else {
																	$statuspolja = 7;
																	//echo "<a href='rekreacija.php?sql3=del&amp;idbroj=".$kojid."' onclick=\"return confirm('".$igrac.", ".$rek022." ".$sifter." ".$rek023." ".$siftmn."'); return false;\"><i class='bi bi-person-bounding-box imagesmojtermin' title='".$dod058.": ".$natpy."'></i></a>";
																}
															} else {
																$statuspolja = 7;
																//echo "<i class='bi bi-person-bounding-box imagesmojtermin'></i>";
															}
														}
													} else {
														if (!$igrac){
															if ($sadaa<1){
																if ($satii<$lampa){
																	if ($predrez<"2"){ 
																		$statuspolja = 6;
																		/*
																		?>
																	    <a href="rekreacijax1.php?bteren=<?php echo $sifter ?>&bsatni=<?php echo $siftmn ?>&bkada=<?php echo $zadan ?>" onclick="NewWindow(this.href,'name','350','620','yes');return false"><i class='bi bi-plus-square imagesslobodantermin' title='<?php echo $dod045 ?>'></i></a><?php
																		*/
																	} else { 
																		$statuspolja = 7;
																		/*
																		?>
																	    <a href="rekreacijax1p.php?bteren=<?php echo $sifter ?>&bsatni=<?php echo $siftmn ?>&bkada=<?php echo $zadan ?>" onclick="NewWindow(this.href,'name','350','570','yes');return false"><i class='bi bi-plus-square imagesslobodantermin' title='<?php echo $dod045 ?>'></i></a><?php
																		*/
																	}
																} else {
																	$statuspolja = 5;
																	//echo "<i class='bi bi-x-circle imagesnedostupanteren' title='".$upu033."'></i>";
																}
															} else { 
																if ($predrez<"2"){
																	$statuspolja = 9;
																	/*
																	?>
																    <a href="rekreacijax1.php?bteren=<?php echo $sifter ?>&bsatni=<?php echo $siftmn ?>&bkada=<?php echo $zadan ?>" onclick="NewWindow(this.href,'name','350','620','yes');return false"><i class='bi bi-plus-square imagesslobodantermin' title='<?php echo $dod045 ?>'></i></a><?php
																	*/
																} else { 
																	$statuspolja = 8;
																	/*
																	?>
																    <a href="rekreacijax1p.php?bteren=<?php echo $sifter ?>&bsatni=<?php echo $siftmn ?>&bkada=<?php echo $zadan ?>" onclick="NewWindow(this.href,'name','350','510','yes');return false"><i class='bi bi-plus-square imagesslobodantermin' title='<?php echo $dod045 ?>'></i></a><?php
																	*/
																}
															}
														} else {
															$statuspolja = 5;
															//echo "<i class='".$slika."' title='".$igrac."'></i>";
														}
													}
													
											   $sadaa=$sadaa+1;
											   $dadan=substr($prida,0,2)+1;
											   $damje=substr($prida,3,2);
											   $dagod=substr($prida,6,4);
											   $idess=date ("m-d-Y", mktime (0,0,0,$damje,$dadan,$dagod));
											   $zadan=substr($idess,6,4)."-".substr($idess,0,2)."-".substr($idess,3,2);
											   $prida=substr($idess,3,2).".".substr($idess,0,2).".".substr($idess,6,4);
											
											//*******************************************************************************
											if ($iipolje == 1){
												$jsonglavni = $jsonglavni . '"polje'.strval($iipolje).'":' . $statuspolja;
											}else{
												$jsonglavni = $jsonglavni . ',"polje'.strval($iipolje).'":' . $statuspolja;
											}
											$iipolje = $iipolje + 1;
										}
											$jsonglavni = $jsonglavni . '}';
								
		
								//*******************************
								$iired = $iired + 1;
							}
							//*********************************
							
				   $sadaa=$sadaa+1;
				   $dadan=substr($zadan,8,2)+1;
				   $damje=substr($zadan,5,2);
				   $dagod=substr($zadan,0,4);
				   
				//ZATVARA TEREN *****************
					//$jsonglavni = $jsonglavni . "}";
				$ii = $ii + 1;
			} 

	//KRAJ JSON FAJLA***************
	$jsonglavni = $jsonglavni . "]}]";
	echo $jsonglavni;

?>