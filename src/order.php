<!DOCTYPE html>
<?php
	include "lib.php";
?>

<html>
	
	<head>
		<link rel="stylesheet" href="style.css">
		<div id="header"></div>
	</head>
	
	<body>
		<?php
			if(sessionLogin()){
					$order_data = getCart();
				
				SQL("USE ".$GLOBALS['shopdb']);
				$uid = $_COOKIE["sessionMail"];
				foreach($order_data as $d){
					$id = $d[0];
					$name = SQL_row("SELECT AName FROM artikel where ANr = $id");
					echo "<p>$name   --   $d[1]</p>";
				}
				
				if(isset($_POST['confirm_order'])){
					order(SQL_row("SELECT SNr FROM schueler WHERE SMail='$uid'"), $order_data);
				}
				else{
					echo "
					<form method=POST>
						<input type=submit name='confirm_order' value='COFIRM ORDER' />
					</form>
					";
				}
				
			}
			else{
				echo "NOT LOGGED IN, acces denied !";
			}
			
			
		?>	
		<script src="header.js"></script>
		
	</body>
	
	
</html>