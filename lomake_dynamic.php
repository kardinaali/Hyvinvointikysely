<?php
if (!isset($_GET["kieli"])) { $kieli = "0"; } else { $kieli = $_GET["kieli"]; }
if (!isset($_GET["direction"])) { $direction = "ltr"; } else { $direction = $_GET["direction"]; }
include ("kielet.php"); include ("headers.php"); include ("votsikko.php");

$latina = array("0","1","3","5"); // Latinalaisten aakkosten kielet

print "<!DOCTYPE html>
	<html>
	<head>
	<title>Hyvinvointikysely</title>";
print "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">";

print "<script type=\"text/javascript\" src=\"func_idle.js\"></script>"; // Tyhjäkäyntilaskurin käynnistäminen
print "<script type=\"text/javascript\" src=\"func_showhide.js\"></script>"; // Dynaaminen näyttäminen ja piilotus (radio)
print "<script type=\"text/javascript\" src=\"func_showhideCB.js\"></script>"; // Dynaaminen näyttäminen ja piilotus (checkbox)
print "<script type=\"text/javascript\">
function leavePage()
	{
	var painike = confirm('" . $oletkovarma[$kieli] . "');
	if ( painike == true )
		{
		location.href='index.php';
		}
	};
</script>";

print "<style>BODY {direction: " . $direction . ";} .hetu { width: 16px; }</style>";
if ($kieli == "0") { print "<style>.suomi { display: none; }</style>"; }
print "</head>";
print "<body onload=\"idle();\">";

print "<div class=\"header\">" . $header[($kieli*2)] . " / " . $header[($kieli*2)+1] . "</div>";

print "<div class=\"ohjeteksti\">" . $esipuhe[$kieli] . "<p>" . $lomakeohje[$kieli] . "</div>";

print "<form id=\"lomake\" action=\"tulostus.php?kieli=" . $kieli . "\" method=\"post\">";


// Perustiedot
for ($ih=1; $ih<9; $ih++)
	{
	print "<div class=\"kysymyslohko\">";
	print "<span class=\"kaannos\">" . ${'kysymys'.$ih}[$kieli] . "</span>";
	print "<br><span class=\"suomi\">" . ${'kysymys'.$ih}[0] . "</span><br>";
	print "<input class=\"textfield\" type=\"text\" name=\"kys" . $ih . "\">";
	print "</div>";
	}
	
// Siviilisääty
print "<div class=\"kysymyslohko\">";
print "<span class=\"kaannos\">" . $kysymys9[$kieli] . "</span>";
print "<br><span class=\"suomi\">" . $kysymys9[0] . "</span><p>";
print "<table class=\"osa\">";
for ($i=10; $i<15; $i++)
	{
	print "<td class=\"solu20\"><input type=\"radio\" value=\"" . ${'kysymys'.$i}[0] . "\" name=\"kys9\"> <span class=\"kaannos\">"
	. ${'kysymys'.$i}[$kieli] . "</span><br>";
	print "<span class=\"suomi\">" . ${'kysymys'.$i}[0] . "</span></td>";
	}
print "</tr></table></div>";

// Lapsia
print "<div class=\"kysymyslohko\">";
print "<span class=\"kaannos\">" . $kysymys15[$kieli] . "</span>";
print "<br><span class=\"suomi\">" . $kysymys15[0] . "</span><p>";
print "<input type=\"checkbox\" value=\"ei\" name=\"kys16a\"> <span class=\"kaannos\">" . $ei[$kieli] . "</span><span class=\"suomi\">&nbsp;&nbsp;"
. $ei[0] . "<span><p>";

/* Alasvetovalikko */

print "<select style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" name=\"kys16b\">";
print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"Ei valintaa\">" . $valitse[$kieli] . "</option>";
for ($i=1;$i<11;$i++)
	{
	print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"" . $i . "\"><div style=\"padding: 5px 20px 5px 20px !important; font-size: 11pt; text-align: center;\">" . $i . "</div></option>";
	}
print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"yli 10\">" . $yli10[$kieli] . "</option>";
print "</select>";

print "&nbsp;&nbsp;<span class=\"kaannos\">" . $kysymys16[$kieli] . "</span><span class=\"suomi\">&nbsp;&nbsp;"
. $kysymys16[0] . "<span>";
print "</div>";

// STATUS
print "<div class=\"kysymyslohko\"><table class=\"osa\">";
include("yesno.php");
for ($is=17; $is<26; $is++)
	{
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . ${'kysymys'.$is}[$kieli] . "</span><br>";
	print "<span class=\"suomi\">" . ${'kysymys'.$is}[0] . "</span></td>";
	print "<td class=\"solu ke\"><input type=\"radio\" value=\"kyllä\" name=\"kys".$is."\"></td><td class=\"solu ke\"><input type=\"radio\" value=\"ei\" name=\"kys".$is."\"></td></tr>";
	}

if (!in_array($kieli,$latina))
	{
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . $kysymys25b[$kieli] . "</span><br>";
	print "<span class=\"suomi\">" . $kysymys25b[0] . "</span></td>";
	print "<td class=\"solu\"><input type=\"radio\" value=\"kyllä\" name=\"kys25b\"></td><td class=\"solu\"><input type=\"radio\" value=\"ei\" name=\"kys25b\"></td></tr>";
	}
if ($kieli != "1")
	{
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . $kysymys25c[$kieli] . "</span><br>";
	print "<span class=\"suomi\">" . $kysymys25c[0] . "</span></td>";
	print "<td class=\"solu\"><input type=\"radio\" value=\"kyllä\" name=\"kys25c\"></td><td class=\"solu\"><input type=\"radio\" value=\"ei\" name=\"kys25c\"></td></tr>";
	}
print "</table></div>";

// Koulutustausta
print "<div class=\"kysymyslohko\">";
print "<span class=\"kaannos\">" . $kysymys26[$kieli] . "</span>";
print "<br><span class=\"suomi\">" . $kysymys26[0] . "</span><p>";
for ($i=27; $i<31; $i++)
{ print "<input type=\"checkbox\" name=\"kys".$i."\" value=\"" . ${'kysymys'.$i}[0] . "\"> <span class=\"kaannos\">" . ${'kysymys'.$i}[$kieli] . "</span>
<span class=\"suomi\"> " . ${'kysymys'.$i}[0] . "</span><br>"; }
// Kysymysrakenteen vaihto darille ja persialle
if ($kieli == "4" OR $kieli == "7")
	{
	print "&nbsp;<br><span class=\"kaannos\">" . $kysymys31b[$kieli] . "</span><br>";
	print "<span class=\"suomi\">" . $kysymys31b[0] . "</span><br>";
	print "<select style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" name=\"kys31b\">";
	print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"Ei valintaa\">" . $valitse[$kieli] . "</option>";
	for ($i=1;$i<11;$i++)
		{
		print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"" . $i . "\"><div style=\"padding: 5px 20px 5px 20px !important; font-size: 11pt; text-align: center;\">" . $i . "</div></option>";
		}
	print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"yli 10\">" . $yli10[$kieli] . "</option>";
	print "</select>";	
	}
else
	{
	print "&nbsp;<br><span class=\"kaannos\">" . $kysymys31[$kieli] . "</span><br>";
	print "<span class=\"suomi\">" . $kysymys31[0] . "</span><p>";
	print "<select style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" name=\"kys32\">";
	print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"Ei valintaa\">" . $valitse[$kieli] . "</option>";
	for ($i=1;$i<11;$i++)
		{
		print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"" . $i . "\"><div style=\"padding: 5px 20px 5px 20px !important; font-size: 11pt; text-align: center;\">" . $i . "</div></option>";
		}
	print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"yli 10\">" . $yli10[$kieli] . "</option>";
	print "</select>";
	print " <span class=\"kaannos\">" . $kysymys32[$kieli] . "</span>&nbsp;
	<span class=\"suomi\"> " . $kysymys32[0] . "</span>";
	print "</div>";
	}

// Perhe ja sukulaiset Suomessa
print "<div class=\"kysymyslohko\">";
print "<span class=\"kaannos\">" . $kysymys33[$kieli] . "</span>";
print "<br><span class=\"suomi\">" . $kysymys33[0] . "</span><p>";
print "<table class=\"osa\">";
include("yesno.php");
for ($i=34; $i<37; $i++)
	{ 
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . ${'kysymys'.$i}[$kieli] . "</span>";
	print "<br><span class=\"suomi\">" . ${'kysymys'.$i}[0] . "</span></td>";
	print "<td class=\"solu ke\"><input type=\"radio\" value=\"". ${'kysymys'.$i}[0] ."\" name=\"kys".$i."\"></td><td class=\"solu ke\"><input type=\"radio\" name=\"kys".$i."\" value=\"ei\"></td></tr>";
	}
print "</table>";
print "</div>";

// Perhe ja sukulaiset muualla
print "<div class=\"kysymyslohko\">";
print "<span class=\"kaannos\">" . $kysymys37[$kieli] . "</span>";
print "<br><span class=\"suomi\">" . $kysymys37[0] . "</span><br>";
print "&nbsp;<br><span class=\"kaannos\">" . $kysymys38[$kieli] . "</span> &nbsp;";
print "<span class=\"suomi\">" . $kysymys38[0] . "</span>&nbsp;";
print "<select style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" name=\"kys38\">";
print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"Ei valintaa\">" . $valitse[$kieli] . "</option>";
for ($i=1;$i<11;$i++)
	{
	print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"" . $i . "\"><div style=\"padding: 5px 20px 5px 20px !important; font-size: 11pt; text-align: center;\">" . $i . "</div></option>";
	}
print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"yli 10\">" . $yli10[$kieli] . "</option>";
print "</select>";
print "</div>";

// Yleinen vointi
print "<div class=\"kysymyslohko\">";
print "<span class=\"kaannos\">" . $kysymys39[$kieli] . "</span>";
print "<br><span class=\"suomi\">" . $kysymys39[0] . "</span><p>";
print "<table class=\"osa\"><tr>";
	print "<td class=\"solu33\"><input type=\"radio\" value=\"huono\" name=\"kys40\"> <span class=\"kaannos\">" . $kysymys40[$kieli] . "</span>";
	print "&nbsp; <span class=\"suomi\">" . $kysymys40[0] . "</span></td>";
	print "<td class=\"solu33\"><input type=\"radio\" value=\"kohtalainen\" name=\"kys40\"> <span class=\"kaannos\">" . $kysymys41[$kieli] . "</span>";
	print "&nbsp; <span class=\"suomi\">" . $kysymys41[0] . "</span></td>";
	print "<td class=\"solu33\"><input type=\"radio\" value=\"hyvä\" name=\"kys40\"> <span class=\"kaannos\">" . $kysymys42[$kieli] . "</span>";
	print "&nbsp; <span class=\"suomi\">" . $kysymys42[0] . "</span></td></tr>";
print "</table>";
print "</div>";

// Liikun päivittäin
print "<div class=\"kysymyslohko\">";
print "<span class=\"kaannos\">" . $kysymys43[$kieli] . "</span>";
print "<br><span class=\"suomi\">" . $kysymys43[0] . "</span><p>";
print "<table class=\"osa\"><tr>";
	print "<td class=\"solu33\"><input type=\"radio\" value=\"" . $kysymys44[0] . "\" name=\"kys44\"> <span class=\"kaannos\">" . $kysymys44[$kieli] . "</span>";
	print "&nbsp; <span class=\"suomi\">" . $kysymys44[0] . "</span></td>";
	print "<td class=\"solu33\"><input type=\"radio\" value=\"" . $kysymys45[0] . "\" name=\"kys44\"> <span class=\"kaannos\">" . $kysymys45[$kieli] . "</span>";
	print "&nbsp; <span class=\"suomi\">" . $kysymys45[0] . "</span></td>";
	print "<td class=\"solu33\"><input type=\"radio\" value=\"" . $kysymys46[0] . "\" name=\"kys44\"> <span class=\"kaannos\">" . $kysymys46[$kieli] . "</span>";
	print "&nbsp; <span class=\"suomi\">" . $kysymys46[0] . "</span></td></tr>";
print "</table>";
print "</div>";

// Todettu sairaus tai vamma
print votsikko(47);
include("yesno.php");
for ($i=48; $i<62; $i++)
	{
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . ${'kysymys'.$i}[$kieli] . "</span>";
	print "<br><span class=\"suomi\">" . ${'kysymys'.$i}[0] . "</span></td>";
	print "<td class=\"solu ke\"><input type=\"radio\" value=\"" . ${'kysymys'.$i}[0] . "\" name=\"kys".$i."\"></td><td class=\"solu ke\"><input type=\"radio\" name=\"kys".$i."\" value=\"ei\"></td></tr>";
	}
print "</table>";
print "</div>";

// Oireet
print votsikko(62);
include("yesno.php");
for ($i=63; $i<76; $i++)
	{
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . ${'kysymys'.$i}[$kieli] . "</span>";
	print "<br><span class=\"suomi\">" . ${'kysymys'.$i}[0] . "</span></td>";
	print "<td class=\"solu ke\"><input type=\"radio\" value=\"" . ${'kysymys'.$i}[0] . "\" name=\"kys".$i."\"></td><td class=\"solu ke\"><input type=\"radio\" name=\"kys".$i."\" value=\"ei\"></td></tr>";
	}
print "</table>";
print "</div>";

// Sairaala ja kidutisaatio
print "<div class=\"kysymyslohko\"><table class=\"osa\">";
include("yesno.php");
for ($is=76; $is<80; $is++)
	{
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . ${'kysymys'.$is}[$kieli] . "</span><br>";
	print "<span class=\"suomi\">" . ${'kysymys'.$is}[0] . "</span></td>";
	print "<td class=\"solu ke\"><input type=\"radio\" value=\"kyllä\" name=\"kys".$is."\"></td><td class=\"solu ke\"><input type=\"radio\" value=\"ei\" name=\"kys".$is."\"></td></tr>";
	}
print "</table></div>";

// Lääkitys
print "<div class=\"kysymyslohko\">";
print "<table class=\"osa\">";
include("yesno.php");
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . $kysymys80[$kieli] . "</span>";
	print "&nbsp; <span class=\"suomi\">" . $kysymys80[0] . "</span></td>";
	print "<td class=\"solu ke\"><input onclick=\"ShowHide('medic');\" id=\"medics_radio_yes\" type=\"radio\" value=\"kyllä\" name=\"kys80\"></td><td class=\"solu ke\"><input type=\"radio\" name=\"kys80\" onclick=\"ShowHide('medic');\" id=\"medics_radio_no\" value=\"ei\"></td></tr>";
print "</table><p><div id=\"medic\" class=\"shown\" style=\"display: none;\"><span class=\"kaannos\">" . $kysymys81[$kieli] . "</span><br><span class=\"suomi\">"
. $kysymys81[0] . "</span><p>";
print "<input type=\"text\" class=\"textfield\" name=\"kys81\"></div>";
print "</div>";

// Allergiat
print "<div class=\"kysymyslohko\">";
print "<span class=\"kaannos\">" . $kysymys82[$kieli] . "</span>";
print "<br><span class=\"suomi\">" . $kysymys82[0] . "</span><span style=\"float: right; margin-right: 30%;\"><span class=\"kaannos\">" . $kylla[$kieli];
print "</span> <span class=\"suomi\">" . $kylla[0] . "</span><input type=\"checkbox\" onclick=\"ShowHideCB('allergia');\" id=\"allergia_checkbox\"></span>";
print "<p><div style=\"display: none;\" class=\"shown\" id=\"allergia\"><table class=\"osa\">";

include("yesno.php");
for ($is=83; $is<87; $is++)
	{
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . ${'kysymys'.$is}[$kieli] . "</span><br>";
	print "<span class=\"suomi\">" . ${'kysymys'.$is}[0] . "</span></td>";
	print "<td class=\"solu ke\"><input type=\"radio\" value=\"" . ${'kysymys'.$is}[0] . "\" name=\"kys".$is."\"></td><td class=\"solu ke\"><input type=\"radio\" value=\"ei\" name=\"kys".$is."\"></td></tr>";
	}
print "</table></div></div>";

// Hampaat
print "<div class=\"kysymyslohko\">";
print "<span class=\"kaannos\">" . $kysymys87[$kieli] . "</span>";
print "<br><span class=\"suomi\">" . $kysymys87[0] . "</span><p>";
print "<table class=\"osa\"><tr>";
for ($i=88; $i<92; $i++)
	{
	print "<td class=\"solu25\"><input type=\"radio\" value=\"" . ${'kysymys'.$i}[0] . "\" name=\"kys87\"> <span class=\"kaannos\">" . ${'kysymys'.$i}[$kieli] . "</span>";
	print "<br><span class=\"suomi\">" . ${'kysymys'.$i}[0] . "</span></td>";
	}
print "</tr></table></div>";

// Rokotukset
print votsikko(92);
include("yesno.php");
for ($is=93; $is<98; $is++)
	{
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . ${'kysymys'.$is}[$kieli] . "</span><br>";
	print "<span class=\"suomi\">" . ${'kysymys'.$is}[0] . "</span></td>";
	print "<td class=\"solu ke\"><input type=\"radio\" value=\"" . ${'kysymys'.$is}[0] . "\" name=\"kys".$is."\"></td><td class=\"solu ke\"><input type=\"radio\" value=\"ei\" name=\"kys".$is."\"></td></tr>";
	}
print "</table></div>";

// Käytän
print votsikko(98);
include("yesno.php");
for ($is=99; $is<103; $is++)
	{
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . ${'kysymys'.$is}[$kieli] . "</span><br>";
	print "<span class=\"suomi\">" . ${'kysymys'.$is}[0] . "</span></td>";
	print "<td class=\"solu ke\"><input type=\"radio\" value=\"" . ${'kysymys'.$is}[0] . "\" name=\"kys".$is."\"></td><td class=\"solu ke\"><input type=\"radio\" value=\"ei\" name=\"kys".$is."\"></td></tr>";
	}
print "</table></div>";

// Tuberkuloosikysely
print votsikko(103);
include("yesno.php");
for ($it=104; $it<115; $it++)
	{
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . ${'kysymys'.$it}[$kieli] . "</span>";
	print "<br><span class=\"suomi\">" . ${'kysymys'.$it}[0] . "</span></td>";
	print "<td class=\"solu ke\"><input type=\"radio\" value=\"kyllä\" name=\"kys".$it."\"></td><td class=\"solu ke\"><input type=\"radio\" name=\"kys".$it."\" value=\"ei\"></td></tr>";
	}
print "</table>";
print "</div>";

// Vain naisille
print "<div class=\"kysymyslohko\">";
print "<span class=\"kaannos\">" . $kysymys115[$kieli] . "</span>";
print "<br><span class=\"suomi\">" . $kysymys115[0] . "</span><p>";
print "<table class=\"osa\">";
print "<tr><td class=\"solu50\"><span class=\"kaannos\">" . $kysymys116[$kieli] . "</span>";
print " &nbsp; <span class=\"suomi\">" . $kysymys116[0] . "</span></td>";
print "<td class=\"solu15\"><input type=\"radio\" value=\"kyllä\" name=\"kys117\"> <span class=\"kaannos\">" . $kylla[$kieli] . "</span> &nbsp; ";
print "<span class=\"suomi\">" . $kylla[0] . "</span></td>";
print "<td class=\"solu15\"><input type=\"radio\" value=\"ehkä\" name=\"kys117\"> <span class=\"kaannos\">" . $kysymys117[$kieli] . "</span> &nbsp; ";
print "<span class=\"suomi\">" . $kysymys117[0] . "</span></td>";
print "<td class=\"solu15\"><input type=\"radio\" value=\"ei\" name=\"kys117\"> <span class=\"kaannos\">" . $ei[$kieli] . "</span> &nbsp; ";
print "<span class=\"suomi\">" . $ei[0] . "</span></td></tr></table><br>";
// Kuukautiset1
for ($ih=118; $ih<121; $ih++)
	{
	print "<span class=\"kaannos\">" . ${'kysymys'.$ih}[$kieli] . "</span>";
	print "<br><span class=\"suomi\">" . ${'kysymys'.$ih}[0] . "</span><br>";
	print "<input class=\"textfield\" type=\"text\" name=\"kys" . $ih . "\">";
	print "<p>";
	}
// Kuukautiset2
print "<p><table class=\"osa\">";
include("yesno.php");
for ($it=121; $it<123; $it++)
	{
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . ${'kysymys'.$it}[$kieli] . "</span>";
	print "<br><span class=\"suomi\">" . ${'kysymys'.$it}[0] . "</span></td>";
	print "<td class=\"solu ke\"><input type=\"radio\" value=\"kyllä\" name=\"kys".$it."\"></td><td class=\"solu ke\"><input type=\"radio\" name=\"kys".$it."\" value=\"ei\"></td></tr>";
	}
print "</table><br>&nbsp;<br>";
print "<span class=\"kaannos\">" . $kysymys123[$kieli] . "</span><br><span class=\"suomi\">" . $kysymys123[0] . "</span><br>";
print "<table class=\"osa\">";
include("yesno.php");
for ($i=124; $i<129; $i++)
	{
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . ${'kysymys'.$i}[$kieli] . "</span>";
	print "<br><span class=\"suomi\">" . ${'kysymys'.$i}[0] . "</span></td>";
	print "<td class=\"solu ke\"><input type=\"radio\" value=\"" . ${'kysymys'.$i}[0] . "\" name=\"kys".$i."\"></td><td class=\"solu ke\"><input type=\"radio\" name=\"kys".$i."\" value=\"ei\"></td></tr>";
	}
print "</table><p>";

// Raskaudet ja synnytykset
print "<span class=\"kaannos\">" . $kysymys130[$kieli] . "</span>";
print "<br><span class=\"suomi\">" . $kysymys130[0] . "</span><br>";
print "<select style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" name=\"kys130\">";
print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"Ei valintaa\">" . $valitse[$kieli] . "</option>";
for ($i=1;$i<11;$i++)
	{
	print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"" . $i . "\"><div style=\"padding: 5px 20px 5px 20px !important; font-size: 11pt; text-align: center;\">" . $i . "</div></option>";
	}
print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"yli 10\">" . $yli10[$kieli] . "</option>";
print "</select>";
print "<p>";
	
print "<span class=\"kaannos\">" . $kysymys131[$kieli] . "</span>";
print "<br><span class=\"suomi\">" . $kysymys131[0] . "</span><br>";
print "<select style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" name=\"kys131\">";
print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"Ei valintaa\">" . $valitse[$kieli] . "</option>";
for ($i=1;$i<11;$i++)
	{
	print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"" . $i . "\"><div style=\"padding: 5px 20px 5px 20px !important; font-size: 11pt; text-align: center;\">" . $i . "</div></option>";
	}
print "<option style=\"padding: 5px 20px 5px 20px; font-size: 11pt; text-align: center;\" value=\"yli 10\">" . $yli10[$kieli] . "</option>";
print "</select>";
print "<p>";

// Ympärileikkaus
print "<table class=\"osa\">";
include("yesno.php");
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . $kysymys129[$kieli] . "</span>";
	print "&nbsp; <span class=\"suomi\">" . $kysymys129[0] . "</span></td>";
	print "<td class=\"solu ke\"><input type=\"radio\" value=\"kyllä\" name=\"kys129\"></td><td class=\"solu ke\"><input type=\"radio\" name=\"kys129\" value=\"ei\"></td></tr>";
print "</table></div>";


// MYÖS miehille
print "<div class=\"kysymyslohko\">";
print "<span class=\"kaannos\">" . $kysymys132[$kieli] . "</span>";
print "<br><span class=\"suomi\">" . $kysymys132[0] . "</span><p>";
print "<span class=\"kaannos\">" . $kysymys133[$kieli] . "</span>";
print "<br><span class=\"suomi\">" . $kysymys133[0] . "</span><p>";
print "<table class=\"osa\">";
include("yesno.php");
for ($it=134; $it<142; $it++)
	{
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . ${'kysymys'.$it}[$kieli] . "</span>";
	print "<br><span class=\"suomi\">" . ${'kysymys'.$it}[0] . "</span></td>";
	print "<td class=\"solu ke\"><input type=\"radio\" value=\"" . ${'kysymys'.$it}[0] . "\" name=\"kys".$it."\"></td><td class=\"solu ke\"><input type=\"radio\" name=\"kys".$it."\" value=\"ei\"></td></tr>";
	}
print "</table><p>";
print "<span class=\"kaannos\">" . $kysymys142[$kieli] . "</span>";
print "<br><span class=\"suomi\">" . $kysymys142[0] . "</span><br>";
print "<table class=\"osa\">";
include("yesno.php");
for ($it=143; $it<146; $it++)
	{
	print "<tr><td class=\"solu\"><span class=\"kaannos\">" . ${'kysymys'.$it}[$kieli] . "</span>";
	print "<br><span class=\"suomi\">" . ${'kysymys'.$it}[0] . "</span></td>";
	print "<td class=\"solu ke\"><input type=\"radio\" value=\"" . ${'kysymys'.$it}[0] . "\" name=\"kys".$it."\"></td><td class=\"solu ke\"><input type=\"radio\" name=\"kys".$it."\" value=\"ei\"></td></tr>";
	}
print "</table></div>";

// Lomakkeen täyttäminen
print "<div class=\"kysymyslohko\">";
print "<table class=\"osa\">";
print "<tr><td class=\"solu25\"><span class=\"kaannos\">" . $kysymys146[$kieli] . "</span>";
print "<br><span class=\"suomi\">" . $kysymys146[0] . "</span></td>";
print "<td class=\"solu25\"><input type=\"radio\" value=\"helppoa\" name=\"kys147\"> <span class=\"kaannos\">" . $kysymys147[$kieli] . "</span> &nbsp; ";
print "<span class=\"suomi\">" . $kysymys147[0] . "</span></td>";
print "<td class=\"solu25\"><input type=\"radio\" value=\"ei helppoa eikä vaikeaa\" name=\"kys147\"> <span class=\"kaannos\">" . $kysymys148[$kieli] . "</span><br>";
print "<span class=\"suomi\">" . $kysymys148[0] . "</span></td>";
print "<td class=\"solu25\"><input type=\"radio\" value=\"vaikeaa\" name=\"kys147\"> <span class=\"kaannos\">" . $kysymys149[$kieli] . "</span> &nbsp; ";
print "<span class=\"suomi\">" . $kysymys149[0] . "</span></td></tr></table><br>";
print "</div>";


print "<button class=\"button button_print\" type=\"submit\"><b>" . $tulosta[$kieli] . "</b><br><span style=\"color: yellow;\" class=\"suomi\">" . $tulosta[0] . "</span></button>";

print "</form>";

print "<button class=\"button button_close\" onclick=\"leavePage();\"><b>" . $sulje[$kieli] . "</b><br><span style=\"color: yellow;\" class=\"suomi\">" . $sulje[0] . "</span></button><p>";
print "</body></html>";

?>