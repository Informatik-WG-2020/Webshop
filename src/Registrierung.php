<HTML>
<HEAD>
	<link rel="stylesheet" href="style.css">
</HEAD>
<BODY>
	<div id="header"></div>
	<center><br><br>
		<?php 
		$conn = mysql_connect("127.0.0.1", "root", "") or die("keine Verbindung");
		mysql_select_db("webshop", $conn) or die("Datenbank nicht gefunden");
		$query = "SELECT SMail FROM schueler WHERE SMail LIKE '$_POST[EMail]'";
		$result = mysql_query($query, $conn) or die("SQL-Abfrage gescheitert(1)");

		if(mysql_fetch_array($result))
		{
			echo"E-Mail Adresse bereits vorhanden";
		}
		else
		{
			$query='INSERT INTO schueler (SName, SVorname, SMail, SPassword,KName) 
			VALUES ("'.$_POST["Name"].'","'.$_POST["Vorname"].'","'.$_POST["EMail"].'","'.SHA1($_POST["Passwort"]).'","'.$_POST["Klasse"].'")';
			$result2 = mysql_query($query, $conn) or die("SQL-Abfrage gescheitert(2)");
			echo"Registrierung erfolgreich!";
		};

		?>
	<br>
	<p><a href="Registrierung.html">Zur&uuml;ck zur Registrierung</a></p>   <p><a href="Anmeldung.html">Zur Anmeldung</a></p>
	<script src="header.js"></script>
	</BODY>
</HTML>
