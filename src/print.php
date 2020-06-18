<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css">
</head>
<body>
	<div id="header"></div>
	<br><br>
	<?php 
		$conn = mysql_connect("localhost", "root") or die("keine Verbindung");
		mysql_select_db("webshop", $conn) or die("Datenbank nicht gefunden");
		$query = "SELECT bAnzahl, a.ANr, AName, bZeitpunkt, APreis, s.SNr, SName, KName, SVorname FROM bestellt b JOIN Artikel a on b.ANr = a.ANr JOIN schueler s ON s.SNr = b.SNr ORDER BY s.KName, SName, SVorname, b.SNr";
		$result = mysql_query($query, $conn) or die("Abfrage gescheitert");
		$snr = 0;
		
		while ($datensatz = mysql_fetch_array($result))
		{
			$newSnr = $datensatz["SNr"];

			if ($snr == 0)
			{
				echo("<h3>" . $datensatz['SName'] . ", " . $datensatz['SVorname'] . " (" . $datensatz['KName'] . ")</h3><table border=\"1\"><tr><th>Anzahl</th><th>ANr</th><th>AName</th><th>Einzelpreis</th><th>Gesamtpreis</th><th>Bestellzeitpunkt</th></tr>");
				$snr = $newSnr;
			}
			
			if ($newSnr != $snr)
			{
				echo("</table><br><h3>" . $datensatz['SName'] . ", " . $datensatz['SVorname'] . " (" . $datensatz['KName'] . ")</h3><table border=\"1\"><tr><th>Anzahl</th><th>ANr</th><th>AName</th><th>Einzelpreis</th><th>Gesamtpreis</th><th>Bestellzeitpunkt</th></tr>");
				$snr = $newSnr;
			}
			$preis = $datensatz['APreis'] * $datensatz['bAnzahl'];
			echo("<tr><td>" . $datensatz['bAnzahl'] . "</td><td>" . $datensatz['ANr'] . "</td><td>" . $datensatz['AName'] . "</td><td>" . $datensatz['APreis'] . " €</td><td>" . $preis . " €</td><td>" . $datensatz['bZeitpunkt'] . "</td></tr>");		
		}
		if ($snr != 0) echo("</table>");
		else echo("<h2>Es sind keine Bestellungen in der Datenbank vorhanden!</h2>")
	?>
	<script src="header.js"></script>
</body>
</html>