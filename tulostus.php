<?php
include ("kielet.php");
date_default_timezone_set('Europe/Helsinki');
$pvm = date('d.m.Y');
$lokipvm = date('d.m.Y H:i:s');
$kieli = $_GET["kieli"];
$latina = array("0","1","3","5");

// Laskuri_lkm
$lokilkm = 'lokilkm.txt';
$lkmdata = file_get_contents ( $lokilkm );
$lkmdata = intval($lkmdata) + 1;
file_put_contents($lokilkm, $lkmdata);

// Laskuri_pvm
$pvmloki = 'lokipvm.txt';
file_put_contents($pvmloki, $lokipvm);

// Vastausmuuttujien könttäväsäys
for ($i=1; $i<148; $i++)
		{
		${'kys'.$i} = $_POST['kys'.$i];  if (empty(${'kys'.$i})) { ${'kys'.$i} = "-"; }
		}

// Poikkeukselliset asetukset
$kys7b = $_POST["kys16a"]; // Muu kieli, mikähän se mahtaa olla
$kys16a = $_POST["kys16a"]; $kys16b = $_POST["kys16b"]; if (empty($kys16b) OR !empty($kys16a)) { $kys16b = "0"; } // Lapset
$kys25b = $_POST["kys25b"]; if (empty($kys25b)) { $kys25b = "ei"; } // Latina
$kys25c = $_POST["kys25c"]; if (empty($kys25c)) { $kys25c = "ei"; } // Englanti
$kys31b = $_POST["kys31b"]; if (empty($kys31b)) { $kys31b = "0"; } // Kouluvuosia darille ja persialle
$kys32 = $_POST["kys32"]; if (empty($kys32)) { $kys32 = "0"; } // Kouluvuosia


// Yhden tulostusrivin monivastaukset
$taulukot = array(array("27","31","koulu"), array("34","37","suku"), array("48","62","sairaus"), array("63","76","oireet"), array("83","87","allergiat"), array("93","98","rokot"), array("99","103","use"), array("124","129","eh"), array("134","142","ohjaus"), array("143","146","aika"));
foreach ($taulukot as $taulukko)
	{
	for ($i=$taulukko[0]; $i<$taulukko[1]; $i++)
		{
		${'kys'.$i} = $_POST['kys'.$i];
		if (${'kys'.$i} == "ei") { ${'kys'.$i} = ""; }
		if (!empty(${'kys'.$i})) { ${$taulukko[2]} .= ${'kys'.$i} . ", "; }
		}
	${$taulukko[2]} = rtrim(${$taulukko[2]}, ', '); if (empty(${$taulukko[2]})) { ${$taulukko[2]} = "-"; }
	}



print "<!DOCTYPE html>
	<html>
	<head>
	<title>Hyvinvointikysely</title>";
print "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">";
print "<link rel=\"stylesheet\" type=\"text/css\" href=\"printer.css\" media=\"print\">";
print "<META HTTP-EQUIV=\"refresh\" CONTENT=\"10; URL=index.php\">";
print "<style>B { font-weight: normal; }</style>";
print "</head><body style=\"padding-top: 20px;\" onload=\"window.print();\">";

print "<button class=\"button button_close\" onclick=\"location.href='index.php';\"><span class=\"kaannos\">" . $sulje2[$kieli] . "</span><br><span class=\"suomi\">" . $sulje2[0] . "</span></button><p>";

print "<div class=\"hvk\">HYVINVOINTIKYSELY: " . $pvm . "</div>";


// Perustiedot
for ($i=1; $i<9; $i++)
	{
	print "<div class=\"rivi\">" . ${'kysymys'.$i}[0] . ": " . ${'kys'.$i} . "</div>";
	}

// Siviilisääty -> kys9
print "<div class=\"rivi o\">Siviilisääty: " . $kys9 . "</div>";

// Lapsia
print "<div class=\"rivi o\">Lapsia: " . $kys16b . "</div>";

// Status
for ($i=17; $i<26; $i++)
	{
	print "<div class=\"rivi\">" . ${'kysymys'.$i}[0] . ": " . ${'kys'.$i} . "</div>";
	}
if (!in_array($kieli,$latina))
	{
	print "<div class=\"rivi\">Osaan latinalaiset aakkoset: " . $kys25b . "</div>";
	}
if ($kieli != "1")
	{
	print "<div class=\"rivi\">Osaan englantia: " . $kys25c . "</div>";
	}

// Koulutustausta
print "<div class=\"rivi o\">Koulutustausta: " . $koulu . "</div>";
// vastausmuotoilu darille ja persialle
if ($kieli == "4" OR $kieli == "7")
	{
	print "<div class=\"rivi o\">Olen käynyt koulua: " . $kys31b . " vuotta</div>";
	}
else
	{
	print "<div class=\"rivi o\">Olen käynyt koulua: " . $kys32 . " vuotta</div>";
	}

// Perhe ja sukulaiset Suomessa
print "<div class=\"rivi o\">Minulla on Turussa tai lähialueella: " . $suku . "</div>";

// Perhe ja sukulaiset muualla
print "<div class=\"rivi o\">Minulla on ydinperheeni jäseniä muualla kuin Suomessa: " . $kys38 . "</div>";

// Yleinen vointi
print "<div class=\"rivi o\">Yleinen vointini on: " . $kys40 . "</div>";

// Liikun päivittäin
print "<div class=\"rivi o\">Liikun päivittäin: " . $kys44 . "</div>";

// Todettu sairaus tai vamma
print "<div class=\"rivi o\">Minulla on todettu seuraava vamma tai sairaus: " . $sairaus . "</div>";

// Oireet
print "<div class=\"rivi o\">Tällä hetkellä minulla on seuraavia oireita: " . $oireet . "</div>";

// Sairaala ja lääkitys
for ($i=76; $i<82; $i++)
	{
	print "<div class=\"rivi\">" . ${'kysymys'.$i}[0] . ": " . ${'kys'.$i} . "</div>";
	}

// Allergiat
print "<div class=\"rivi o\">Minulla on todettu allergiat: " . $allergiat . "</div>";

// Hampaat
print "<div class=\"rivi o\">Hampaat: " . $kys87 . "</div>";

// Rokotukset
print "<div class=\"rivi o\">Olen saanut rokotuksia: " . $rokot . "</div>";

// Käytän
print "<div class=\"rivi o\">Käytän: " . $use . "</div>";


// Tuberkuloosikysely
for ($i=104; $i<115; $i++)
	{
	print "<div class=\"rivi\">" . ${'kysymys'.$i}[0] . ": " . ${'kys'.$i} . "</div>";
	}

// VAIN naisille
print "<div class=\"rivi\">Olen raskaana: " . $kys117 . "</div>";
print "<div class=\"rivi\">Viimeiset kuukautiset, päivämäärä: " . $kys118 . "</div>";
print "<div class=\"rivi\">Kuukautisten alkamisikä: " . $kys119 . "</div>";
print "<div class=\"rivi\">Kuukautisten loppumisikä: " . $kys120 . "</div>";
print "<div class=\"rivi\">Minulla on vaikeita kuukautiskipuja: " . $kys121 . "</div>";
print "<div class=\"rivi\">Minulla on gynekologisia vaivoja: " . $kys122 . "</div>";
print "<div class=\"rivi o\">Käytän ehkäisyä: " . $eh . "</div>";
print "<div class=\"rivi o\">Minulle on tehty ympärileikkaus: " . $kys129 . "</div>";
print "<div class=\"rivi o\">Raskaudet, määrä: " . $kys130 . "</div>";
print "<div class=\"rivi o\">Synnytykset, määrä: " . $kys131 . "</div>";

// MYÖS miehille
print "<div class=\"rivi o\">Tarvitsen ohjausta ja neuvontaa seuraavissa asioissa: " . $ohjaus . "</div>";

print "<div class=\"rivi o\">Tarvitsen ajan: " . $aika . "</div>";

// Lomakkeen täyttäminen
print "<div class=\"rivi o\">Tämän lomakkeen täyttäminen oli: " . $kys147 . "</div>";


print "</body></html>";
?>
