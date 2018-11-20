<?php
	session_start();
	require 'dbconfig/config.php'
?>

<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="css/style13.css" type="text/css"/>
	<title>Inventory</title>
</head>
<body>
<nav>
<ul id="menuContainer">
<?php include_once("menu_template.php");?>
</ul>
</nav>
<div id="bodyContainer3">
	
		<h2>Inventory</h2>
		<form class="myform" action="inventory.php" method="post">
		<label id="pro1"><b>Product ID:</label>
		<input name = "productid" type ="text" id="pro2"/><br>
		<input name = "submit_btn1" type ="submit" id ="search_btn21" value="Search"/><br>
		<label id="pronam1"><b>Product Name:</label>
		<input name = "productname" type ="text" id="pronam2"/><br>
		<input name = "submit_btn2" type ="submit" id ="search_btn22" value="Search"/><br>
		<label id="procat1"><b>Product Category:</label>
		<input name = "productcat" type ="text" id="procat2"/><br>
		<input name = "submit_btn3" type ="submit" id ="search_btn23" value="Search"/><br>
		<input name = "clear_btn" type ="submit" id ="clear_btn5" value="Clear"/>
		</form>
		<?php
		if(isset($_POST['submit_btn1']))
		{
			//echo'<script type="text/javascript"> alert("Sign up button clicked") </script> ';
			$productid= $_POST['productid'];
		
			
			$query = "SELECT * FROM product WHERE product_id LIKE '$productid'";
			$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run) > 0)
			{
								
								echo "<table id = 'abc' class = 'x' align='center' border-collapse: collapse' >;
								<tr>	
								<th>Product ID</th>
								<th>Name</th>
								<th>Brand</th>
								<th>Category</th>
								<th>Amount</th>
								<th>Discount</th>
								<th>Quantity</th>
								<th>Date</th>
								</tr>";

								while($row = mysqli_fetch_array($query_run))
								{
								echo "<tr>";
								echo "<td>" . $row['product_id'] . "</td>";
								echo "<td>" . $row['name'] . "</td>";
								echo "<td>" . $row['brand'] . "</td>";
								echo "<td>" . $row['category'] . "</td>";
								echo "<td>" . $row['amount'] . "</td>";
								echo "<td>" . $row['discount'] . "</td>";
								echo "<td>" . $row['quantity'] . "</td>";
								echo "<td>" . $row['date'] . "</td>";
								echo "</tr>";
								}
								echo "</table>";

								mysqli_close($con);
			}
			else
							{
								echo'<script type="text/javascript"> alert("No such product ID.") </script> ';
							}

		}
		
		if(isset($_POST['submit_btn2']))
		{
			//echo'<script type="text/javascript"> alert("Sign up button clicked") </script> ';
			$productname= $_POST['productname'];
		
			
			$query = "SELECT * FROM product WHERE name LIKE '$productname'";
			$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run) > 0)
			{
				
								
								echo "<table id = 'abc' class = 'x' align='center' border-collapse: collapse' >;
								<tr>	
								<th>Product ID</th>
								<th>Name</th>
								<th>Brand</th>
								<th>Category</th>
								<th>Amount</th>
								<th>Discount</th>
								<th>Quantity</th>
								<th>Date</th>
								</tr>";

								while($row = mysqli_fetch_array($query_run))
								{
								echo "<tr>";
								echo "<td>" . $row['product_id'] . "</td>";
								echo "<td>" . $row['name'] . "</td>";
								echo "<td>" . $row['brand'] . "</td>";
								echo "<td>" . $row['category'] . "</td>";
								echo "<td>" . $row['amount'] . "</td>";
								echo "<td>" . $row['discount'] . "</td>";
								echo "<td>" . $row['quantity'] . "</td>";
								echo "<td>" . $row['date'] . "</td>";
								echo "</tr>";
								}
								echo "</table>";

								mysqli_close($con);
							}
			else
							{
								
								echo'<script type="text/javascript"> alert("No such product name.") </script> ';
							}
			
		}
		if(isset($_POST['submit_btn3']))
		{
			//echo'<script type="text/javascript"> alert("Sign up button clicked") </script> ';
			$productcat= $_POST['productcat'];
		
			
			$query = "SELECT * FROM product WHERE category LIKE '$productcat'";
			$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run) > 0)
			{
								
								echo "<table id = 'abc' class = 'x' align='center' border-collapse: collapse' >;
								<tr>	
								<th>Product ID</th>
								<th>Name</th>
								<th>Brand</th>
								<th>Category</th>
								<th>Amount</th>
								<th>Discount</th>
								<th>Quantity</th>
								<th>Date</th>
								</tr>";

								while($row = mysqli_fetch_array($query_run))
								{
								echo "<tr>";
								echo "<td>" . $row['product_id'] . "</td>";
								echo "<td>" . $row['name'] . "</td>";
								echo "<td>" . $row['brand'] . "</td>";
								echo "<td>" . $row['category'] . "</td>";
								echo "<td>" . $row['amount'] . "</td>";
								echo "<td>" . $row['discount'] . "</td>";
								echo "<td>" . $row['quantity'] . "</td>";
								echo "<td>" . $row['date'] . "</td>";
								echo "</tr>";
								}
								echo "</table>";

								mysqli_close($con);
			}
			else
							{
								echo'<script type="text/javascript"> alert("No such product category.") </script> ';
							}

		}
		if(isset($_POST['clear_btn'])){
			ob_flush();
		}
	?>

</div>
</body>
</html>