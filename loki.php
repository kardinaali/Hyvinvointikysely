<?php

// Laskuri_lkm
$lkmloki = 'lokilkm.txt';
$lkmdata = file_get_contents ( $lkmloki );

// Laskuri_pvm
$pvmloki = 'lokipvm.txt';
$pvmdata = file_get_contents($pvmloki);

print "<!DOCTYPE html>
	<html>
	<head>
	<title>Hyvinvointikyselyn loki</title>";
print "</head><body style=\"´text-align: left;\">";
print "<table style=\"margin: auto; width: 50%; border-collapse: collapse; text-align: center; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);\">";
print "<tr><td style=\"border: solid 1px #666;\">Kone: " . gethostname() . "</td></tr>";
print "<tr><td style=\"border: solid 1px #666;\">Viimeisin tulostus: " . $pvmdata . "</td></tr>";
print "<tr><td style=\"border: solid 1px #666;\">Tulostuksia: " . $lkmdata . "</td></tr>";
print "</table></body></html>";

?>
