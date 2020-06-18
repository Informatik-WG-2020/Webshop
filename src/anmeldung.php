<HTML>
	<body>
	<?php
	
		/*In die Datenbank müssen noch SMail, SPassword und SSession eingefügt werden!
		SMail: typ: varchar(40)
		SPassword: typ: varchar("Anzahl der erlaubten Zeichen der Registrierungs-Gruppe")
		SSession: "Fragen an die Webshop-Gruppe"*/
		
		//NEW COOKIE
		function setSession($email){
			$hash = sha1(rand());
			mysql_query("UPDATE schueler SET SSession = '$hash' WHERE SMail = '$email'");
			
			setcookie("sessionHash", $hash, time()+3600);
			setcookie("sessionMail", $email, time()+3600);
		}
		
		//LOGIN COOKIE
		function sessionLogin(){
			if((isset($_COOKIE["sessionMail"]) and isset($_COOKIE["sessionHash"])) != true){
				return false;
			}
			$mail = $_COOKIE["sessionMail"];
			$hash = $_COOKIE["sessionHash"];
			
			mysql_query("USE shop");
			
			$sql = mysql_query("SELECT SSession FROM schueler WHERE SMail = '$mail'");
			$sql = mysql_fetch_row($sql);
			$sql = $sql[0];
			if($sql == $hash){
				return true;
			}				
			else{
				return false;
			}
		}
		
		//mit Server verbinden
		$conn = mysql_connect("127.0.0.1", "root", "");
		if (!$conn)
			die('Keine Verbindung möglich: ' . mysql_error());
		
		//Datenbank auswählen
		mysql_select_db("webshop", $conn);
		if (!mysql_select_db('webshop'))
			die('Konnte Schema nicht selektieren: ' . mysql_error());
		
		//Abfrage
		$hash = sha1($_POST['Password']);
		$query1 = "SELECT SMail FROM schueler WHERE SMail = '$_POST[Email]'";
		$query2 = "SELECT SPassword FROM schueler WHERE SMail = '$_POST[Email]'";
		$result1 = mysql_query($query1, $conn);
		$result2 = mysql_query($query2, $conn);
		if (!$result1) 
			die('Konnte Abfrage nicht ausf&uumlhren:' . mysql_error());
		if (!$result2) 
			die('Konnte Abfrage nicht ausf&uumlhren:' . mysql_error());
		
		//Vergleich
		$a = "1";
		if(isset($_POST["Email"]) and isset($_POST["Password"])){
			$mail = mysql_result($result1,0);
			$pwd = mysql_result($result2,0);
			
			if(($_POST['Email'] != $mail) AND (sha1($_POST['Password']) != $pwd))
			{
				echo"Die E-Mail oder das Passwort ist falsch!";
				header('Refresh: 3, anmeldung.html');
				$a++;
			}
			else//(($_POST['Email'] == mysql_result($result1,0)) AND (sha1($_POST['Password']) == mysql_result($result2,0)))
			{
				header('Refresh: 0, webshop.html');
				setSession($mail);
				$a++;
			}
		}
		else{
			echo "NO DATA FOUND";
			header('Refresh: 3, anmeldung.html');
		}
		if($a == 1){
			echo"Die E-Mail oder das Passwort ist falsch!";
			header('Refresh: 3, anmeldung.html');
		}
		
	?>
</HTML>