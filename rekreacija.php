<?php include("connect.php"); 
if ($tiprekw<"2"){
	echo("<SCRIPT TYPE=\"text/javascript\">window.location.replace('rekreacijad.php');</SCRIPT>");
}

if (!$opera or $prava<>"1" or !$klusif){
    echo("<SCRIPT TYPE=\"text/javascript\">window.location.replace('greska.php');</SCRIPT>");
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
	$query6 = "SELECT prezime_ime FROM clanarina WHERE datum>='$zlocko' and clan_sifra='$opera'";
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

$upis3="SELECT SUM(cijena) FROM rezervacije WHERE sifra_clana ='$opera' and status='0' and tip_termina<'3' and datum<='$fixica' and tip_placanja<'3'";
$podaci	= mysqli_query($veza1,$upis3);   
$row3	= mysqli_fetch_array($podaci);
$sika1=$row3['cijena'];

$upis31="SELECT * FROM avansi WHERE sifra_clana ='$opera'";
$podaci	= mysqli_query($veza1,$upis31);   
while ($row31 = mysqli_fetch_array($podaci)){
	   $sika2=$sika2+$row31['iznos_uplate'];
	   $sika3=$sika3+$row31['iskoristeno'];
}
$svzat=$sika2-$sika3;
if ($sika1>0 and $svzat>0){
	$totsvo="";
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
	$sika2="";
	$sika3="";
	$sika4="";
	$svzat="";
	$neplaceno="";
	$upis3="SELECT SUM(cijena) FROM rezervacije WHERE sifra_clana ='$opera' and status='0' and tip_termina='1' and datum<='$fixica' and tip_placanja<'3'";
	$podaci	= mysqli_query($veza1,$upis3);   
	$row3	= mysqli_fetch_array($podaci);
    $sika1=$row3['cijena'];

	$upis31="SELECT * FROM avansi WHERE sifra_clana ='$opera'";
	$podaci	= mysqli_query($veza1,$upis31);   
	while ($row31 = mysqli_fetch_array($podaci)){
		   $sika2=$sika2+$row31['iznos_uplate']; 
		   $sika3=$sika3+$row31['iskoristeno'];  
	}
}
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
$neplaceno=$sika3+$sika1-$sika2; ?>
<!DOCTYPE html>
<html lang="hr">
	<head>
		<title>
			<?php echo $rek001 ?>
		</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" href="images/Header.png" type="image/x-icon">
		<link rel="shortcut icon" href="images/Header.png" type="image/x-icon">

		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
	</head>
<form action="rekreacija.php" method="post" name="rekreacija">
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-light">
	<div class="container-fluid">
		<div class="navbar-header"> 		
			<button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button><?php
			if ($tiprekw<"2"){ ?>
				<a class="navbar-brand" href="rekreacija.php">&nbsp;<img src="images/Header.png" width="21" height="21" class="margin-bottom-1-right-5" loading="lazy" title="Sportbooking"><?php echo $rek063 ?></a><?php
			} else { ?>
				<a class="navbar-brand" href="rekreacijad.php">&nbsp;<img src="images/Header.png" width="21" height="21" class="margin-bottom-1-right-5" loading="lazy" title="Sportbooking"><?php echo $rek063 ?></a><?php
			} ?>
		</div>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link active" href="rekreacija.php"><?php echo $rek064; ?></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						<?php echo $ppk007; ?>
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="cjenik.php"><?php echo $novo65 ?></a>
						<a class="dropdown-item" href="novosti.php"><?php echo $novo06 ?></a>
						<li><hr class="dropdown-divider"></li>
						<a class="dropdown-item" href="stanjeracuna.php"><?php echo $rek066 ?></a>
						<li><hr class="dropdown-divider"></li>
						<a class="dropdown-item" href="popisrezerviranja.php"><?php echo $doz031; ?></a>
						<a class="dropdown-item" href="poterenima.php"><?php echo $ppk119; ?></a>
						<li><hr class="dropdown-divider"></li>
						<a class="dropdown-item" href="rezultati.php"><?php echo $dod060; ?></a>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="poimenima.php"><?php echo $tre030; ?></a>
				</li>
				<!-- satnica po terenima --><?php
				$imaga="";
				$daxax=date("Y-m-d");
				$upitow="SELECT teren AS nesto FROM raspored WHERE datum='$daxax'";
				$podaci5 = mysqli_query($veza1,$upitow);   
				$werow	 = mysqli_fetch_array($podaci5);
				$imaga=$werow['nesto'];
				if ($imaga){ ?>
					<li class="nav-item">
						<a class="nav-link" href="raspored.php"><?php echo $novo59; ?></a>
					</li><?php
				} ?>
			</ul>
		</div>
	</div>

	<div class="p-2 bd-highlight fixedposition">
		<div class="dropdown">
			<button class="button1-1" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
				<svg class="width-height-navbaricon margin-bottom-xl-2-xs-0" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
					<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
					<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
				</svg>
				&nbsp;<?php echo $rek062; ?>
			</button>
			<div class="dropdown-menu dropdown-menu-end padding-15 postavkepanel" aria-labelledby="dropdownMenuButton">

				<div align="center"><?php
				if ($nacnate<4){ 
						echo "<a class='stanjeracunaprofilfont' href='stanjeracuna.php'>".$dod113.": ";
						  if ($neplaceno>0){
							  echo $rek008." - ".number_format($neplaceno,2,',','.')." ".$valpl;
						  } elseif ($neplaceno<0){
							  echo $rek007." - ".number_format($neplaceno,2,',','.')." ".$valpl;
						  } else {
							  echo $doz068;
						  }
						echo "</a>";
				}	?>
				</div>

				<li><hr class="dropdown-divider"></li>
				<div class="padding-bottom-10">
					<a class="button-postavke" href="osobnipodaci.php" align="center"><?php echo $rek034; ?></a>
				</div>

				<div class="padding-bottom-10">
					<a class="button-postavke" href="pravilnik.php" align="center"><?php echo $rek051; ?></a>
				</div>

				<div>
					<a class="button-postavke" href="pomoc.php" align="center"><?php echo $rek052; ?></a>
				</div>

				<li><hr class="dropdown-divider"></li>
				<div class="padding-bottom-10">
					<a class="button-odjava" href="../index.php" align="center">
						<?php echo $rek010; ?>
					</a>
				</div>

				<div class="padding-top-10" align="center">
					<font class="verzijafont"><?php echo $rek060 ?></font>
				</div>
			</div>
		</div>
	</div>
</nav><?php
echo "<div><br>";
	if (($neplaceno>$izndug and $izndug>0) or ($claopome and !$brojy) or ($logospo1 or $logospo2)){ 
		if ($neplaceno>$izndug and $izndug>0){
			echo "<div align='center'>";
				echo '<div class="alert alert-danger alert-dismissible fade show max-width-1009-flex boxshadowpanel1">';
					echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
				    echo "<svg xmlns='http://www.w3.org/2000/svg' width='22' height='22' style='color:#ff0000;' fill='currentColor' class='bi bi-exclamation-octagon' viewBox='0 0 16 16'><path fill-rule='evenodd' d='M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1L1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z'/><path d='M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z'/></svg>
						  &nbsp;&nbsp;<font class='opomenafont'>".$doz009."</font><font class='opomenafont1'> ".number_format($neplaceno,2,',','.')." ".$valpl."</font><font class='opomenafont'><br>".$dugopom."</font>";
				echo "</div>";
			echo "</div>";
		}
		if ($claopome and !$brojy and $canka>$uplclan){
			echo "<div align='center'>";
				echo '<div class="alert alert-danger alert-dismissible fade show max-width-1009-flex boxshadowpanel1">';
					echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
				    echo "<font class='opomenafont'>".$claopome."</font>";
				echo "</div>";
			echo "</div>";
		}
	}
	if ($logospo1 or $logospo2){  ?>
		<div class="container" align="center">
			<div class="row"><?php
				if ($logospo1){ ?>
					<div class="col-lg-6 padding-top-lg-0-md-10-bottom-lg-0-md-20">
						<div class="boxshadowpanel width-347">
							<div class="padding-10 max-height-200"><?php
								echo "<a href='".$webspon1."' target='_blank'>";
								echo "<img src='".$logospo1."' class='sponzorvelicinaslike'>";
								echo "</a>"; ?>
							</div>
						</div>
					</div><?php
				}
				if ($logospo2){ ?>
					<div class="col-lg-6">
						<div class="boxshadowpanel width-347">
							<div class="padding-10 max-height-200"><?php
								echo "<a href='".$webspon2."' target='_blank'>";
								echo "<img src='".$logospo2."' class='sponzorvelicinaslike' border='0' alt=''>";
								echo "</a>"; ?>
							</div>
						</div>
					</div><?php
					} ?>
				</div>
			</div>
		</div><?php	
	} ?>

<!-- Legenda-->

<div align="center">
	<div class="card boxshadowpanel max-width-1010-flex margin-top-25 margin-bottom-40">
		<div class="background-color-main card-header" align="center">
			<font class="legendafont">
				<?php echo $dod087 ?>
			</font><br>
			<font class="legendamalifont">
				<?php echo $dod088 ?>
			</font>
		</div>
		<div class="card-body">
			<div class="row g-2 row-cols-2 row-cols-lg-5 g-2 g-lg-3">
				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-2 padding-top-lg-0-md-10-xs-10 border-right-plavi1 border-right-plavi2" align="center">
					<i class='bi bi-plus-square imagesslobodantermin'></i><br>
					<font class="legendafont1"><?php echo $rek004 ?></font>
				</div>
				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-2 padding-top-lg-0-md-10-xs-10 border-right-plavi1" align="center">
					<i class='bi bi-person-bounding-box imagesmojtermin'></i><br>
					<font class="legendafont1"><?php echo $rek005 ?></font>
				</div>
				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-2 padding-top-lg-0-md-10-xs-10 border-right-plavi border-right-plavi2" align="center">
					<i class="bi bi-person-lines-fill imagesindividualno"></i><br>
					<font class="legendafont1"><?php echo $rek012 ?></font>
				</div>
				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-2 padding-top-lg-0-md-10-xs-10 border-right-plavi1" align="center">
					<i class="bi bi-file-font imagesiskolatenisa"></i><br>
					<font class="legendafont1"><?php echo $rek014 ?></font>
				</div>
				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-2 padding-top-lg-0-md-10-xs-10 border-right-plavi1 border-right-plavi2" align="center">
					<i class="bi bi-people-fill imagesitrening"></i><br>
					<font class="legendafont1"><?php echo $rek013 ?></font>
				</div>
				<div class="col-xs-6 col-sm-4 col-md-4 col-lg-2 padding-top-lg-0-md-10-xs-10" align="center">
					<i class='bi bi-trophy imagesnatjecanje'></i><br>
					<font class="legendafont1"><?php echo $rek015 ?></font>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- rasporedi po danima -->
			<?php
			$upitox4="SELECT * FROM tereni WHERE tip_terena>'0' and status>'0' ORDER BY sifra";
			$podaci0= mysqli_query($veza1,$upitox4);   
			while ($xerow4 = mysqli_fetch_array($podaci0)){
				   $nazter=$xerow4['naziv'];
				   $sifter=$xerow4['sifra'];
				   $oznter=$xerow4['oznaka'];
				   $tipter=$xerow4['tip_terena'];
				   $sifsat=$xerow4['sifra'];
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
								echo "<th class='terminiterenafont' colspan='".$terena."'>".$dod034."</th>";
							echo "</tr>";
							echo "<tr>";
								$sadaa=0;
								$prida=date("d.m.Y");
								while ($sadaa<$redan){
									   echo "<th class='terminiterenafont' width='".$sirin."'>".substr($prida,0,5)."</th>";
									   $sadaa=$sadaa+1;
									   $dadan=substr($prida,0,2)+1;
									   $damje=substr($prida,3,2);
									   $dagod=substr($prida,6,4);
									   $idess=date ("m-d-Y", mktime (0,0,0,$damje,$dadan,$dagod));
									   $zadan=substr($idess,6,4)."-".substr($idess,0,2)."-".substr($idess,3,2);
									   $prida=substr($idess,3,2).".".substr($idess,0,2).".".substr($idess,6,4);
								}
							echo "</tr>";
							echo "</thead>";
							$upitox="SELECT * FROM termini2 WHERE status>'0' and teren='$sifter' ORDER BY sifra";
							$podaci1 = mysqli_query($veza1,$upitox);   
							while ($xerow = mysqli_fetch_array($podaci1)){
								   $siftmn=$xerow['sifra'];
								   $termin=$xerow['satnica'];
								   echo "<tbody>";
								   echo "<tr>";
										echo "<td class='terminivrijemefont' align='center'>".$termin."</td>";
										$sadaa=0;
										$prida=date("d.m.Y");
										$zadan=date("Y-m-d");
										$pocet=date("Y-m-d");
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
													$slika="bi bi-plus-square imagessve";
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
											   echo "<td width='".$sirin."'><center>";
													if ($clann==$opera){
														if ($satot){
															if ($time1>$lampa and $sadaa<1){
																echo "<i class='bi bi-person-bounding-box imagesmojtermin' title='".$dod044."'></i>";
															} else {
																if ($otknapo>0){
																	if ($zadan==$pocet and $satii>$termin){ ?>
																		<a href="rekrerezultat1.php?idbroj=<?php echo $kojid; ?>" onclick="NewWindow(this.href,'mywin','350','650','yes','center'); return false" onfocus="this.blur()"><i class='bi bi-person-bounding-box imagesmojtermin' title="<?php echo $nap054 ?>"></i></a><?php
																	} else { ?>
																		<a href="rekreotk.php?idbroj=<?php echo $kojid; ?>" onclick="NewWindow(this.href,'mywin','350','540','yes','center'); return false" onfocus="this.blur()"><i class='bi bi-person-bounding-box imagesmojtermin' title='<?php echo $dod058.": ".$natpy ?>'></i></a><?php
																	}
																} else {
																	echo "<a href='rekreacija.php?sql3=del&amp;idbroj=".$kojid."' onclick=\"return confirm('".$igrac.", ".$rek022." ".$sifter." ".$rek023." ".$siftmn."'); return false;\"><i class='bi bi-person-bounding-box imagesmojtermin' title='".$dod058.": ".$natpy."'></i></a>";
																}
															}
														} else {
															if ($satii<$lampa){
																if ($otknapo>0){ ?>
																	<a href="rekreotk.php?idbroj=<?php echo $kojid; ?>" onclick="NewWindow(this.href,'mywin','350','540','yes','center'); return false" onfocus="this.blur()"><i class='bi bi-person-bounding-box imagesmojtermin' title='<?php echo $dod058.": ".$natpy ?>'></i></a><?php
																} else {
																	echo "<a href='rekreacija.php?sql3=del&amp;idbroj=".$kojid."' onclick=\"return confirm('".$igrac.", ".$rek022." ".$sifter." ".$rek023." ".$siftmn."'); return false;\"><i class='bi bi-person-bounding-box imagesmojtermin' title='".$dod058.": ".$natpy."'></i></a>";
																}
															} else {
																echo "<i class='bi bi-person-bounding-box imagesmojtermin'></i>";
															}
														}
													} else {
														if (!$igrac){
															if ($sadaa<1){
																if ($satii<$lampa){
																	if ($predrez<"2"){ ?>
																	    <a href="rekreacijax1.php?bteren=<?php echo $sifter ?>&bsatni=<?php echo $siftmn ?>&bkada=<?php echo $zadan ?>" onclick="NewWindow(this.href,'name','350','620','yes');return false"><i class='bi bi-plus-square imagesslobodantermin' title='<?php echo $dod045 ?>'></i></a><?php
																	} else { ?>
																	    <a href="rekreacijax1p.php?bteren=<?php echo $sifter ?>&bsatni=<?php echo $siftmn ?>&bkada=<?php echo $zadan ?>" onclick="NewWindow(this.href,'name','350','570','yes');return false"><i class='bi bi-plus-square imagesslobodantermin' title='<?php echo $dod045 ?>'></i></a><?php
																	}
																} else {
																	echo "<i class='bi bi-x-circle imagesnedostupanteren' title='".$upu033."'></i>";
																}
															} else { 
																if ($predrez<"2"){ ?>
																    <a href="rekreacijax1.php?bteren=<?php echo $sifter ?>&bsatni=<?php echo $siftmn ?>&bkada=<?php echo $zadan ?>" onclick="NewWindow(this.href,'name','350','620','yes');return false"><i class='bi bi-plus-square imagesslobodantermin' title='<?php echo $dod045 ?>'></i></a><?php
																} else { ?>
																    <a href="rekreacijax1p.php?bteren=<?php echo $sifter ?>&bsatni=<?php echo $siftmn ?>&bkada=<?php echo $zadan ?>" onclick="NewWindow(this.href,'name','350','510','yes');return false"><i class='bi bi-plus-square imagesslobodantermin' title='<?php echo $dod045 ?>'></i></a><?php
																}
															}
														} else {
															echo "<i class='".$slika."' title='".$igrac."'></i>";
														}
													}
											   echo "</td>";
											   $sadaa=$sadaa+1;
											   $dadan=substr($prida,0,2)+1;
											   $damje=substr($prida,3,2);
											   $dagod=substr($prida,6,4);
											   $idess=date ("m-d-Y", mktime (0,0,0,$damje,$dadan,$dagod));
											   $zadan=substr($idess,6,4)."-".substr($idess,0,2)."-".substr($idess,3,2);
											   $prida=substr($idess,3,2).".".substr($idess,0,2).".".substr($idess,6,4);
										}
								   echo "</center></tr>";
								   echo "</tbody>";
							} 
				   		echo "</table>";
				   echo "</div><br>";
				   $sadaa=$sadaa+1;
				   $dadan=substr($zadan,8,2)+1;
				   $damje=substr($zadan,5,2);
				   $dagod=substr($zadan,0,4);
			} ?>

<!-- Copyright (Bottom fixed) -->

<footer class="mt-auto text-align-center">
	<font class="footerfont">&#169; <?php echo date("Y"); ?> <a class="footerfont1" href="http://www.webured.com/" target="_blank"><?php echo $rek067 ?></a> - <?php echo $rek068 ?></font>
</footer>

<a id="button">
	<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-up-square-fill width-height-100%" viewBox="0 0 16 16">
		<path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 11.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
	</svg>
</a>

<!----- Script ----->

<script src="js/cshdoo.js"></script>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

<script>
var btn = $('#button');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});

</script>

<script>
var win = null;
function NewWindow(mypage,myname,w,h,scroll){
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	settings =	'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
	win = window.open(mypage,myname,settings)
}
</script>


</body>
</html>