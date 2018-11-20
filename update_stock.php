<?php
	session_start();
	require 'dbconfig/config.php';
	$prod = "";
	$qty = "";
	$new= "";
	$date = "";
	$newquan = "";
	if(isset($_POST['add_btn']))
			{
			
			$prod = $_POST['product'];
			$query = "SELECT quantity FROM product WHERE product_id LIKE '$prod'";
			$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run) > 0){
			while($row=mysqli_fetch_assoc($query_run))
			{
				$qty = $row['quantity'];
				
			}
			$new= $_POST['new'];
		
			
			$newquan = $new+$qty;
			$query = "UPDATE product SET quantity = '$newquan', date = now() WHERE product_id LIKE '$prod'";
			$query_run = mysqli_query($con,$query);
			if($query_run)
							{
								echo'<script type="text/javascript"> alert("Stock added.") </script>';
								
							}
							else
							{
								echo'<script type="text/javascript"> alert("Error") </script> ';
							}
			}		
			
			else{
				echo'<script type="text/javascript"> alert("Product ID does not exist.") </script>';
			}
			
			
	}
	if(isset($_POST['delete_btn']))
	{
			
			$prod = $_POST['product'];
			$query = "SELECT quantity FROM product WHERE product_id LIKE '$prod'";
			$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run) > 0)
			{
				while($row=mysqli_fetch_assoc($query_run))
				{
					$qty = $row['quantity'];
				}
				
				$new= $_POST['new'];
				
				$newquan = $qty - $new;
				if($newquan < 0){
					echo'<script type="text/javascript"> alert("Stock can not be deleted as new quantity value will become negative.Check previous and new update quantity value.") </script>';
					$newquan = $qty;
				}
				else{
					$query = "UPDATE product SET quantity = '$newquan', date = now() WHERE product_id LIKE '$prod'";
					$query_run = mysqli_query($con,$query);
					if($query_run)
					{
						echo'<script type="text/javascript"> alert("Stock deleted.") </script>';
										
					}
					else
					{
						echo'<script type="text/javascript"> alert("Error") </script> ';
					}
				}
			}		
			
			else{
				echo'<script type="text/javascript"> alert("Product ID does not exist.") </script>';
			}
	}
?>

<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="css/style10.css" type="text/css"/>
	<title>Update Stock</title>
</head>
<body>
<nav>
<ul id="menuContainer">
<?php include_once("menu_template.php");?>
</ul>
</nav>
<div id="bodyContainer5">
	
		<h2>Update Stock</h2>
		<form class="myform" action="update_stock.php" method="post">
			<label id="pro3"><b>Product ID:</label>
			<input name = "product" type ="text" id="pro4" value = "<?php echo $prod;?>" required/><br>
			<label id="quan1"><b>Update Quantity:</label>
			<input name = "new" type="text" id = "quan2" value = "<?php echo $new;?>" required/>
			<label id="date1"><b>Date:</label>
			<input name = "date" type ="text" id="date2" value = "<?php echo date("m/d/Y");?>"  disabled/><br>
			<input name = "add_btn" type ="submit" id ="update_btn1" value="Add"/>
			<input name = "delete_btn" type ="submit" id ="delete_btn1" value="Delete"/>
			<label id="pre1"><b>Previous Quantity:</label>
			<input name = "quantity" type ="text" id ="pre2" value="<?php echo $qty;?>" disabled/><br>
			<label id="new1"><b>New Quantity:</label>
			<input name = "newquan" type ="text" id ="new2" value="<?php echo $newquan;?>" disabled/><br>
			
		</form>
				
				
				
		
		
			
		
		
	
</div>
</body>
</html>