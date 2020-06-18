<!DOCTYPE html>
<?php
	include "lib.php";
	
	function pageForm(){
		$page=0;
		if(isset($_GET["page"])){
			$page = $_GET["page"];
		}
		
		
		echo("
			<form action=shop.php?page=$page action=GET />
				<input type=submit name=page value=".($page-1)." />
				<input type=submit name=page value=".($page+1)." />
			</form>
		");
	}
	
?>

<html>
	
	
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="style.css">
		<div id="header"></div>
		<br><br>
		<script>
			function setCookie(name,value,days) {
				var expires = "";
				if (days) {
					var date = new Date();
					date.setTime(date.getTime() + (days*24*60*60*1000));
					expires = "; expires=" + date.toUTCString();
				}
				document.cookie = name + "=" + (value || "")  + expires + "; path=/";
			}
			
			function addToCart(aid){
				var data = document.getElementById("count_"+aid).value;
				if(data == ""){
					data = "1";
				}
				setCookie("cart_"+aid, data, 1);
				var tr = document.getElementById("div_"+aid);
				tr.style.background = "red";
			}
			
		</script>
	</head>
	
	<body>
		<form action="order.php">
			<input type=submit value="ORDER NOW" />
		</form>
		
		<?php
			pageForm();
			$start = 0;
			$page_size = 15;
			
			if(isset($_GET["page"])){
				$start = $page_size * ($_GET["page"]);
				echo $start;
			}
			else if(isset($_GET["sub"])){
				$start = 0;
			}
			if($start < 0){
				$start = 0;
			}
			
			
			SQL("USE ".$GLOBALS['shopdb']);
			$articles = SQL_all("SELECT ANr as aid, APreis as price, ABild as path, AName as name, ALieferumfang as size FROM artikel LIMIT $start, $page_size");
			
			
			
			foreach($articles as $a){
				echo "
				<div id=div_".$a['aid']." style='display:block;'>
					'".$a['name']."'<br />
					".$a['price']." / ".$a['size']."<br />
					<textarea>
						'DEAFASR GVWRSBzviodhgo3h'
					</textarea>
					<image src='".$a['path']."'/>
					<input type=num id=count_".$a['aid'].">
					<button onclick=addToCart(".$a['aid'].")>ORDER</button>
				</div><br><br>";
				}
		
		?>
		<form action="order.php">
			<input type=submit value="ORDER NOW" />
		</form>	
		<?php
			pageForm();
		?>
		<script src="header.js"></script>
	</body>
	
	
</html>