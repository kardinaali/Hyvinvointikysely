<?php
print "<!DOCTYPE html>
	<html>
	<head>
	<title>Hyvinvointikysely</title>";
print "<link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\">";
print "</head>";
//print "<body style=\"text-align: center; background-color: #efefef;\">";
print "<body style=\"text-align: center; background-color: #efefef;\">";
print "<table class=\"kokosivu\">";
print "<tr><td class=\"kielisolu\"><a class=\"linkki\" href=\"lomake.php?kieli=2&direction=rtl\">سؤال اليوم</a> - arabia</td></tr>"; // Arabia
print "<tr><td class=\"kielisolu\"><a class=\"linkki\" href=\"lomake.php?kieli=5&direction=ltr\">Af-soomaali</a> - somali</td></tr>";  // Somalia
print "<tr><td class=\"kielisolu\"><a class=\"linkki\" href=\"lomake.php?kieli=6&direction=rtl\">کوردی سۆرانی</a> - kurdi</td></tr>";  // Kurdi
print "<tr><td class=\"kielisolu\"><a class=\"linkki\" href=\"lomake.php?kieli=4&direction=rtl\">زبان دری</a> - dari</td></tr>";  // Dari
print "<tr><td class=\"kielisolu\"><a class=\"linkki\" href=\"lomake.php?kieli=7&direction=rtl\">فارسی</a> - persia</td></tr>";  // Persia
print "<tr><td class=\"kielisolu\"><a class=\"linkki\" href=\"lomake.php?kieli=1&direction=ltr\">English</a> - englanti</td></tr>"; // Englanti
print "<tr><td class=\"kielisolu\"><a class=\"linkki\" href=\"lomake.php?kieli=3&direction=ltr\">Français</a> - ranska</td></tr>";  // Ranska
print "<tr><td class=\"kielisolu\"><a class=\"linkki\" href=\"lomake.php?kieli=0&direction=ltr\">Suomi</a></td></tr>";  // Suomi
//print "<tr><td class=\"kielisolu\">Käännös: ranskan \"ei mitään\", \"näköongelma\", darin \"Olen käynyt koulua____vuotta\"</td></tr>";
print "</table>";

// Laskuri_lkm
$lkmloki = 'lokilkm.txt';
$lkmdata = file_get_contents ( $lkmloki );

// Laskuri_pvm
$pvmloki = 'lokipvm.txt';
$pvmdata = file_get_contents($pvmloki);

print "<div style=\"position: absolute; top: 97%; left: 1%; color: #bbb;\">" . $pvmdata . ": " . $lkmdata . "</div>";


print "</body></html>";
?>
