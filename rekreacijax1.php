<?php 
	include("connect.php");  
	$rsatni = "";
	$rteren = "";
	$datrz = "";
	$upiso = "";
	$cijena="";
	$cijen2="";
	$tkoje="";
	$vrpla="";
	$termin="";
	$zadan="";
	$clacij="";
	$protiv="";
	if (isset($_POST['submit'])) {
		if (isset($_POST["rteren"])){
			$rteren = $_POST["rteren"];
		} else {
			$rteren = "";
		}
		if (isset($_POST["rsatni"])){
			$rsatni = $_POST["rsatni"];
		} else {
			$rsatni = "";
		}
		if (isset($_POST["termin"])){
			$termin = $_POST["termin"];
		} else {
			$termin = "";
		}
		if (isset($_POST["danre"])){
			$danre = $_POST["danre"];
		} else {
			$danre = "";
		}
		if (isset($_POST["lmter1"])){
			$lmter1 = $_POST["lmter1"];
		} else {
			$lmter1 = "";
		}
		if (isset($_POST["terpi"])){
			$terpi = $_POST["terpi"];
		} else {
			$terpi = "";
		}
		if (isset($_POST["cijena"])){
			$cijena = $_POST["cijena"];
		} else {
			$cijena = "";
		}
		if (isset($_POST["protiv"])){
			$protiv = $_POST["protiv"];
		} else {
			$protiv = "";
		}
		if ($nacnate=="4" or $nacnate=="5"){
			if ($rteren and $rsatni and substr($danre,6,4)>'2018' and $opera){
				$jadan	  = substr($danre,6,4)."-".substr($danre,3,2)."-".substr($danre,0,2);
				$danas	  = date("Y-m-d H:i:s");
				$upisiga  = "INSERT INTO rezervacije VALUES ('$jadan', '$rteren', '$rsatni', '$opera', '$clapre', '$termin', '$cijena', '1', '', '', '1', '$lmter1', '$opera', '', '$cijena', '', '$danas','','','$terpi','','','','$protiv','')";
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
						$upisiga1  = "INSERT INTO rezervacije VALUES ('$jadan', '$rteren', '$termi1', '$opera', '$clapre', '$satnica', '$cijena', '1', '', '', '1', '$lmter1', '$opera', '', '$cijena', '', '$danas','','','$terpi','','','','$protiv','')";
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
						$upisiga2  = "INSERT INTO rezervacije VALUES ('$jadan', '$rteren', '$termi2', '$opera', '$clapre', '$satnica', '$cijena', '1', '', '', '1', '$lmter1', '$opera', '', '$cijena', '', '$danas','','','$terpi','','','','$protiv','')";
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
						$upisiga3  = "INSERT INTO rezervacije VALUES ('$jadan', '$rteren', '$termi3', '$opera', '$clapre', '$satnica', '$cijena', '1', '', '', '1', '$lmter1', '$opera', '', '$cijena', '', '$danas','','','$terpi','','','','$protiv','')";
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
				    echo("<SCRIPT TYPE=\"text/javascript\">window.opener.location.reload(); self.close();</SCRIPT>");
				} else {
				    echo("<SCRIPT TYPE=\"text/javascript\">alert('".$tez002."');</SCRIPT>");
				}
			} else {
			    echo("<SCRIPT TYPE=\"text/javascript\">alert('".$tez004."');</SCRIPT>");
			}
		} else {
			if ($rteren and $rsatni and substr($danre,6,4)>'2020' and $opera and $cijena){
				$jadan=substr($danre,6,4)."-".substr($danre,3,2)."-".substr($danre,0,2);
				$danas=date("Y-m-d H:i:s");
				$upisiga="INSERT INTO rezervacije VALUES ('$jadan', '$rteren', '$rsatni', '$opera', '$clapre', '$termin', '$cijena', '1', '', '', '1', '$lmter1', '$opera', '', '$cijena', '', '$danas','','','','','','','$protiv','')";
				$zapisito = mysqli_query($veza1,$upisiga);
				echo $upisiga;
	
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
						$upisiga1  = "INSERT INTO rezervacije VALUES ('$jadan', '$rteren', '$termi1', '$opera', '$clapre', '$satnica', '$cijena', '1', '', '', '1', '$lmter1', '$opera', '', '$cijena', '', '$danas','','','$terpi','','','','$protiv','')";
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
						$upisiga2  = "INSERT INTO rezervacije VALUES ('$jadan', '$rteren', '$termi2', '$opera', '$clapre', '$satnica', '$cijena', '1', '', '', '1', '$lmter1', '$opera', '', '$cijena', '', '$danas','','','$terpi','','','','$protiv','')";
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
						$upisiga3  = "INSERT INTO rezervacije VALUES ('$jadan', '$rteren', '$termi3', '$opera', '$clapre', '$satnica', '$cijena', '1', '', '', '1', '$lmter1', '$opera', '', '$cijena', '', '$danas','','','$terpi','','','','$protiv','')";
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
				    echo("<SCRIPT TYPE=\"text/javascript\">window.opener.location.reload(); self.close();</SCRIPT>");
				} else {
				    echo("<SCRIPT TYPE=\"text/javascript\">alert('".$tez002."');</SCRIPT>");
				}
			} else {
			    echo("<SCRIPT TYPE=\"text/javascript\">alert('".$tez004."');</SCRIPT>");
			}
		}
	}
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
	    echo("<SCRIPT TYPE=\"text/javascript\">alert('".$dod023."');self.close();</SCRIPT>");
	}

	// provjera koja je vrsta terena i ispod termina
	$upitob1	= "SELECT tip_terena FROM tereni WHERE sifra='$bteren'";
	$resultatb1 = mysqli_query($veza1,$upitob1);
	$terob1		= mysqli_fetch_array($resultatb1);
	$tixter		= $terob1['tip_terena'];

	$upitob		= "SELECT * FROM termini2 WHERE sifra='$bsatni' and teren='$bteren'";
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
			// traži u tabli cjenik kolika je cjena
			$upitobac="SELECT * FROM termini2 WHERE sifra='$bsatni' and teren='$bteren'";
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
		} else {
			if ($uplclan<$fifica){
				// da li je prošao rok za naplatu terena te da li je plaćena članarina - ako nije onda je cjena duplo
				$sadaa=date("Y");
				$platio="";
				$razlog="";
				$upitobac="SELECT datum FROM naplata WHERE clan_sifra='$opera' and datum LIKE '$sadaa%'";
				$resultatbac = mysqli_query($veza1,$upitobac);
				$terobac= mysqli_fetch_array($resultatbac);
				$platio=$terobac['datum'];
				if (!$platio){
					$cijena=$cijena*2;
					$razlog=$dod084;
				}
			}
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
	if ($nemozerez){
		?>
			<div align="center">
				<div class="shadowboxnaslovna padding-15">
					<font class="naslovpop-upfont">
						<?php echo $novo11; ?>
					</font>
				</div>
			</div><br>
					<?php
					if ($brdrez>=$dancla){
						echo "<div align='center' class='padding-bottom-10'><font class='rekreacijax1font'>".$dod066."</font></div>";
					} else {
					    echo "<div class='padding-10' align='center'><div class='alert alert-danger' role='alert'>".$doz009." <b>".$valpl." ".number_format($saldo,2,',','.')."</b>.<br>".$dod090." <b>".$valpl." ".$izndug."</b>.<br>".$dod083."</div></div>";
					} ?>
					<div align="center">
						<input type='submit' value='<?php echo $dod091 ?>' name='submit' onclick='self.close()' class='button1-2'>
					</div>
				<?php
		} else {
			$danre=substr($zadan,8,2).".".substr($zadan,5,2).".".substr($zadan,0,4);	?>

	<!-- Glavni dio -->

	<div align="center">
		<div class="shadowboxnaslovna padding-15">
			<font class="naslovpop-upfont">
				<?php echo $novo11; ?>
			</font>
		</div>
	</div>

	<div align="center" class="padding-10">
		<input type="hidden" name="rsatni" value="<?php echo $bsatni ?>">
		<input type="hidden" name="lmter1" value="<?php echo $lmter1 ?>">
		<input type="hidden" name="terpi"  value="<?php echo $terpi ?>">

		<div class="padding-bottom-10">
			<font class="rekreacijax1font">
				<?php echo $teo012 ?>
			</font><br>
			<input type="text" name="clapre" readonly class="form-control cursor-not-allowed" value="<?php echo $clapre ?>" onkeypress="return handleEnter(this, event)" >
		</div>

		<div class="padding-bottom-10">
			<font class="rekreacijax1font">	
				<?php echo $tez006 ?>
			</font><br>
			<input type="text" name="rteren" readonly class="form-control cursor-not-allowed" value="<?php echo $bteren ?>" onkeypress="return handleEnter(this, event)" >
		</div>

		<div class="padding-bottom-10">
			<font class="rekreacijax1font">	
				<?php echo $tez007 ?>
			</font><br>
			<input type="text" name="termin" readonly class="form-control cursor-not-allowed" value="<?php echo $termin ?>" onkeypress="return handleEnter(this, event)" >
		</div>
	
		<div class="padding-bottom-10">
			<font class="rekreacijax1font">					
				<?php echo $tez008 ?>
			</font><br>
			<input type="text" name="danre" readonly class="form-control cursor-not-allowed" value="<?php echo $danre ?>" onkeypress="return handleEnter(this, event)" >
		</div>

		<div class="padding-bottom-10">
			<font class="rekreacijax1font">	
				<?php echo $nal008." ".$valpl ?>
			</font><br>
			<input type="text" name="cijena" readonly class="form-control cursor-not-allowed" value="<?php echo $cijena ?>" onkeypress="return handleEnter(this, event)" >
		</div>

		<div class="padding-bottom-10">
			<font class="rekreacijax1font">					
				<?php echo $dod058 ?>
			</font><br>
			<input type="text" name="protiv" class="form-control" value="<?php echo $protiv ?>" onkeypress="return handleEnter(this, event)" >
		</div><?php
		if ($dancla>1){
			echo "<div class='padding-bottom-10'>";
				echo "<font class='rekreacijax1font'>".$dod102."</font><br>";
				if ($dancla>1){
					$terbr	 = $bsatni+1;
					$upito9	 = "SELECT id AS imaliga FROM rezervacije WHERE teren='$bteren' and datum='$zadan' and termin='$terbr'";
					$result9 = mysqli_query($veza1,$upito9);
					$tero9	 = mysqli_fetch_array($result9);
					$slobo9	 = $tero9['imaliga'];

					if ($slobo9<1){
						$upit9   = "SELECT * FROM termini WHERE sifra='$terbr'";
						$resul9  = mysqli_query($veza1,$upit9);
						$ter9    = mysqli_fetch_array($resul9);
						$satn9   = $ter9['satnica'];
	
					    echo "<input type='checkbox' name='nama1' value='1' onkeypress='return handleEnter(this, event)'>&nbsp;&nbsp;&nbsp;";
					    echo $rac017.": ".$bteren." - ".$rac018.": ".$satn9."<br>";
					}
				}
				if ($dancla>2){
					$terbr    = $bsatni+2;
					$upito10  = "SELECT id AS imaliga FROM rezervacije WHERE teren='$bteren' and datum='$zadan' and termin='$terbr'";
					$result10 = mysqli_query($veza1,$upito10);
					$tero10	  = mysqli_fetch_array($result10);
					$slobo10  = $tero10['imaliga'];

					if ($slobo10<1){
						$upit10  = "SELECT * FROM termini WHERE sifra='$terbr'";
						$resul10 = mysqli_query($veza1,$upit10);
						$ter10   = mysqli_fetch_array($resul10);
						$satn10  = $ter10['satnica'];
	
					    echo "<input type='checkbox' name='nama2' value='1' onkeypress='return handleEnter(this, event)'>&nbsp;&nbsp;&nbsp;";
					    echo $rac017.": ".$bteren." - ".$rac018.": ".$satn10."<br>";
					}
				}
				if ($dancla>3){
					$terbr    = $bsatni+3;
					$upito11  = "SELECT id AS imaliga FROM rezervacije WHERE teren='$bteren' and datum='$zadan' and termin='$terbr'";
					$result11 = mysqli_query($veza1,$upito11);
					$tero11	  = mysqli_fetch_array($result11);
					$slobo11  = $tero11['imaliga'];

					if ($slobo11<1){
						$upit11  = "SELECT * FROM termini WHERE sifra='$terbr'";
						$resul11 = mysqli_query($veza1,$upit11);
						$ter11   = mysqli_fetch_array($resul11);
						$satn11  = $ter11['satnica'];
	
					    echo "<input type='checkbox' name='nama3' value='1' onkeypress='return handleEnter(this, event)'>&nbsp;&nbsp;&nbsp;";
					    echo $rac017.": ".$bteren." - ".$rac018.": ".$satn11."<br>";
					}
				}
			echo "linija 537";
		}					
					
		if ($lmter1){ 
				echo "upozorenje 541:" .$novo68;
			</font><br>
		}
		if ($razlog){
			echo "upozorenje545:>".$razlog;
		}
					
		}
?>