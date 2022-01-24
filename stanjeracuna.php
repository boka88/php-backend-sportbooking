<?php 
date_default_timezone_set('Europe/Zagreb'); 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");


//**********************************************************
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
//***********************************************************	

if (!$opera or !$klusif){
    echo("<SCRIPT TYPE=\"text/javascript\">window.location.replace('greska.php');</SCRIPT>");
}
//------------------------------
$jsonosnovni = '[{';
//------------------------------
$danod="";
$dando="";
$iivan="";

	$zadan="";
	if (isset($_GET["danod"])){
		$danod = $_GET["danod"];
	} else {
		$danod = "";
	}
	if (isset($_GET["dando"])){
		$dando = $_GET["dando"];
	} else {
		$dando = "";
	}
	if (isset($_GET["grupica"])){
		$grupica = $_GET["grupica"];
	} else {
		$grupica = "";
	}
	$iivan="1234";

if (!$danod){
	$upitoy = "SELECT MIN(datum) AS datko FROM rezervacije";
	$podaci	= mysqli_query($veza1,$upitoy);   
	$teroy	= mysqli_fetch_array($podaci);
	$danod	= substr($teroy['datko'],8,2).".".substr($teroy['datko'],5,2).".".substr($teroy['datko'],0,4);
	$dando	= date("d.m.Y");
}
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
$svota=""; 
/*
*	Pregled uplata i plaćanja  	($dod094)
*		prezime ime				($clapre)
*			PERIOD
*			? danod
*			? dando
*
*/

//<!-- Glavni dio -->
if ($grupica){
	//echo $grupica."<br>";
}
//TABELA UPLATA CLANARINE
//<th class='stanjeracunaterenifont'> echo $sta004 </th>
//<th class='stanjeracunaterenifont'> echo $ava010 </th>
//<th class='stanjeracunaterenifont'> echo $ava012 </th>

			$jsonosnovni = $jsonosnovni . '"uplate":[';  
			$brojredovauplate = 0;
				$brojj="0";
				$stanje=0;
				$ukupn=0;
				$brojx = 0;
				$iiznos='';
				$uukupno='';
				$datod=substr($danod,6,4)."-".substr($danod,3,2)."-".substr($danod,0,2);
				$datdo=substr($dando,6,4)."-".substr($dando,3,2)."-".substr($dando,0,2);
				$query6 = "SELECT * FROM clanarina WHERE datum>='$datod' and datum<='$datdo' and clan_sifra='$opera' ORDER BY datum";
				$podac6	= mysqli_query($veza1,$query6);
				
				$brojredovauplate = mysqli_num_rows($podac6);				
				if($brojredovauplate > 0){
					
					while ($row = mysqli_fetch_array($podac6)){
						   $brojx=$brojx+1;
						   $ukupn=$ukupn+$row['iznos'];
						   $xadan=substr($row['datum'],8,2).".".substr($row['datum'],5,2).".".substr($row['datum'],0,4);
						   if($brojx>1){
								$jsonosnovni = $jsonosnovni . ',';
						   }
						   $iiznos='';
						   $uukupno='';
						   if ($row['iznos']>0){
							   $iiznos=number_format($row['iznos'],2,',','.');
						   }
						   if ($ukupn>0){
							   $uukupno=number_format($ukupn,2,',','.');
						   }

						$jsonosnovni = $jsonosnovni . '{"rbr":"'.$brojx.'","datum":"'.$xadan.'","uplaceno":"'.
							$iiznos.'","stanje":"'.$uukupno.'"}';    
					
					} //end while
				}else{
					$jsonosnovni = $jsonosnovni . '{"rbr":" ","datum":" ","uplaceno":" ","stanje":" "}';
				}
				$jsonosnovni = $jsonosnovni . '],'; 
				
			//AVANSI
			/*
					<th class='stanjeracunaterenifont'>&nbsp;</th>
					<th class='stanjeracunaterenifont'><?php echo $sta004 ?></th>
					<th class='stanjeracunaterenifont'><?php echo $ava010 ?></th>
					<th class='stanjeracunaterenifont'><?php echo $ava011 ?></th>
					<th class='stanjeracunaterenifont'><?php echo $ava012 ?></th>
			*/
			$jsonosnovni = $jsonosnovni . '"avansi":[';  
			$brojredovaavansi = 0;
			    $brojj=0;
				$stanje=0;
				$brojx = 0;
				$avizn = 0;
				$avpot = 0;
				$datod=substr($danod,6,4)."-".substr($danod,3,2)."-".substr($danod,0,2);
				$datdo=substr($dando,6,4)."-".substr($dando,3,2)."-".substr($dando,0,2);
				$query6 = "SELECT * FROM avansi WHERE datum>='$datod' and datum<='$datdo' and sifra_clana='$opera' ORDER BY datum, iskoristeno";
				$podac6	= mysqli_query($veza1,$query6);   
				
				$brojredovaavansi = mysqli_num_rows($podac6);	
				$uplaceno = '';
				$iskoristeno = '';
				$stanjeavansa = '';
					if($brojredovaavansi > 0){						
						while ($row = mysqli_fetch_array($podac6)){
							$brojx=$brojx+1;
							if($brojx>1){
									$jsonosnovni = $jsonosnovni . ',';
							}
							$avizn=$avizn+$row['iznos_uplate'];
							$avpot=$avpot+$row['iskoristeno'];
							$ukupn=$ukupn+$row['cijena'];
							$xadan=substr($row['datum'],8,2).".".substr($row['datum'],5,2).".".substr($row['datum'],0,4);
							$stanje=$stanje+$row['iznos_uplate']-$row['iskoristeno'];
							$uplaceno = '';
							$iskoristeno = '';
							if ($row['iznos_uplate']>0){
								   $uplaceno = number_format($row['iznos_uplate'],2,',','.');
							} 
							if ($row['iskoristeno']>0){
								   $iskoristeno = number_format($row['iskoristeno'],2,',','.');
							} 
							if ($stanje>0){
								   $stanjeavansa = number_format($stanje,2,',','.');
							} 
						
							$jsonosnovni = $jsonosnovni . '{"rbr":"'.$brojx.'","datum":"'.$xadan.'","uplaceno":"'.
							$uplaceno.'","iskoristeno":"'.$iskoristeno.'","stanje":"'.$stanjeavansa.'"}';    

						
						} //end while ************
					}else{
						$jsonosnovni = $jsonosnovni . '{"rbr":" ","datum":" ","uplaceno":" "'.
							',"iskoristeno":" ","stanje":" "}';    
					}
					$jsonosnovni = $jsonosnovni . '],'; 
					
			//NEPLACENE REZERVACIJE
			/*
					<th class='stanjeracunaterenifont'>&nbsp;</th>
					<th class='stanjeracunaterenifont'><?php echo $sta004 ?></th>
					<th class='stanjeracunaterenifont'><?php echo $rac017 ?></th>
					<th class='stanjeracunaterenifont'><?php echo $nap028 ?></th>
					<th class='stanjeracunaterenifont'><?php echo $nep009 ?></th>
					<th class='stanjeracunaterenifont'><?php echo $ava012 ?></th>
			*/
		
			$jsonosnovni = $jsonosnovni . '"rezervacije":[';  
			$brojredovarez = 0;
				$cijenarez='';
				$stanjerez='';
				
			    $brojj="0";
				$ukupnr=0;
				$brojx = 0;
				$rezdu = 0;
				$datod=substr($danod,6,4)."-".substr($danod,3,2)."-".substr($danod,0,2);
				$datdo=substr($dando,6,4)."-".substr($dando,3,2)."-".substr($dando,0,2);
				$query6 = "SELECT * FROM rezervacije WHERE datum>='$datod' and datum<='$datdo' and sifra_clana='$opera' and status='0' and cijena>'0' and tip_termina<'3' ORDER BY datum, termin, teren";
				$podac6	= mysqli_query($veza1,$query6);   
				$brojredovarez = mysqli_num_rows($podac6);	
						
					if($brojredovarez > 0){						
						while ($row = mysqli_fetch_array($podac6)){
							   $brojx=$brojx+1;
								if($brojx>1){
									$jsonosnovni = $jsonosnovni . ',';
								}

							   $ukupnr=$ukupnr+$row['cijena'];
							   $xadan=substr($row['datum'],8,2).".".substr($row['datum'],5,2).".".substr($row['datum'],0,4);
								if ($row['status']<'1'){
									$rezdu=$rezdu+$row['cijena'];
								}
								   if ($row['cijena']>0){
									   $cijenarez = number_format($row['cijena'],2,',','.');
								   } 
								   if ($ukupnr>0){
									   $stanjerez = number_format($ukupnr,2,',','.');
								   } 
								$jsonosnovni = $jsonosnovni . '{"rbr":"'.$brojx.'","datum":"'.$xadan.'","teren":"'.
								$row['teren'].'","termin":"'.$row['satnica'].'","cijena":"'.$cijenarez.'","stanje":' .
								'"'.$stanjerez.'"}';    
								   
						}//end while 
					}else{
						$jsonosnovni = $jsonosnovni . '{"rbr":" ","teren":" ","datum":" '.
							'","termin":" ","cijena":" ","stanje":" "}';    
					}
	
					//ubaceno da se vidi saldo uplate - dug*****************************************
					//$ukupn=0;	ukupne uplate
					//$stanje=0; ukupno uplaceni avansi
					//$ukupnr=0; ukupan dug za rezervacije
					$saldo=0;
					$strsaldo='';
					$saldo = $avizn-$avpot-$rezdu;
					if($saldo>0){
						
					}else{
						$saldo=$avpot+$rezdu-$avizn;
					}
					
					//$saldo = $ukupn + $stanje - $ukupnr;
					$strsaldo = number_format($saldo,2,',','.');
					
					$jsonosnovni = $jsonosnovni . ']},{"saldo":"'.$strsaldo.'"}]';
					echo $jsonosnovni;
?>