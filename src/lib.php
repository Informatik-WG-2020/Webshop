
<?php
	$DB = mysql_connect("localhost", "root") ;
	$usertable = "users";
	$article_table = "artikel";
	$shopdb = "webshop";
	
	//oTOu : (OID auto incr, UID)
	//orders : (OID prim key, AID, n)
	
	
	//filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
	
	function SQL($command){
		mysql_query($command) or die (mysql_error($GLOBALS["DB"]));
	}
	
	function SQL_array($command){
		$result = mysql_query($command) or die (mysql_error($GLOBALS["DB"]));
		return mysql_fetch_array($result);
	}
	
	function SQL_row($command){
		$result = mysql_query($command) or die (mysql_error($GLOBALS["DB"]));
		$result = mysql_fetch_row($result);
		$result = $result[0];
		return $result;
	}
	function SQL_all($command){
		$result = mysql_query($command) or die (mysql_error($GLOBALS["DB"]));
		//return mysql_fetch_all($result, MYSQL_BOTH);
		$out = array();
		
		while( $o = mysql_fetch_row($result, MYSQL_BOTH)){
			array_push($out, $o);
		}
		return $out;
	}
	
	
	
	function order($uid, $articles){ //[[id, n], [id2, n2]]
		
		if(sizeof($articles) == 0){
			echo "NO ARTICLES TO ORDER !";
			return;
		}
		SQL("USE ".$GLOBALS['shopdb']);
		//CREATE ORDER
		//SQL("INSERT INTO oTOu(UID) VALUES($uid)");
		//$oid = SQL_row("SELECT OID FROM oTOu WHERE UID='$uid' ORDER BY OID DESC LIMIT 1");
		foreach($articles as $a){ //a = [ID, n]
			//$count = SQL_row("SELECT n FROM orders WHERE OID=$oid and AID=$a[0]");
			if($a[1] > 0){
				//if($count == ''){ //if not orderd
					//SQL("INSERT INTO orders(AID, n, OID) VALUES($a[0], $a[1], $oid)");
					SQL("INSERT INTO bestellt (SNr, ANr, bZeitpunkt, bAnzahl) VALUES ($uid, $a[0], CURRENT_TIMESTAMP, $a[1])");
				//}
				//else{
					//SQL("UPDATE TABLE orders SET n=$count+$a[1] WHERE OID=$oid and AID=$a[0]");
				//}
			}
			else{
				echo "a[1] <= 0";
			}
		}
	}
	
	function getCart($username = ""){
		$out = array();
		foreach($_COOKIE as $key => $value){
			if(mb_substr($key, 0, 5+strlen($username)) == "cart_".$username){ //sucht cart_ - cookie der mit dem username übereinstimmt
				array_push($out, array(mb_substr($key, 5+strlen($username)), $value));
			}
		}
		return $out;
	}
	
	function sessionLogin(){
		if(isset($_COOKIE["sessionMail"]) and isset($_COOKIE["sessionHash"])){
			echo "OK";
		}
		else{
			echo "FAIL";
			return false;
		}
		
		$mail = $_COOKIE["sessionMail"];
		$hash = $_COOKIE["sessionHash"];
		
		mysql_query("USE ".$GLOBALS['shopdb']);
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
	
	
?>