<?php
	session_start();
	require 'dbconfig/config.php';
	$prodid = "";
	$nam = "";
	$bran = "";
	$cat = "";
	$amt = "";
	$dis = "";
	$billno = "";
	$date = "";
	$total_value = "";
	if(isset($_POST['search']))
	{
			$billno = $_POST['billno'];
			$date = $_POST['date'];
			$prodid = $_POST['productid'];
			$query = "SELECT * FROM product WHERE product_id LIKE '$prodid'";
			$query_run = mysqli_query($con,$query);
			
			if(mysqli_num_rows($query_run) > 0){
			while($row=mysqli_fetch_array($query_run))
			{
				$nam = $row['name'];
				$bran = $row['brand'];
				$cat = $row['category'];
				$amt = $row['amount'];
				$dis = $row['discount'];
				
				
			}
			}
			else {
				echo'<script type="text/javascript"> alert("Product ID does not exist.") </script> ';
			}
			
			
	}	


	if(isset($_POST['add_btn']))
		{
			//echo'<script type="text/javascript"> alert("Sign up button clicked") </script> ';
			$var = "1";
			$billno= $_POST['billno'];
			$date= $_POST['date'];
			$productid= $_POST['productid'];
			$proname= $_POST['proname'];
			$brand= $_POST['brand'];
			$category= $_POST['category'];
			$amount = $_POST['amount'];
			$discount = $_POST['discount'];
			$quantity= $_POST['quantity'];
			$query = "SELECT * FROM bill WHERE bill_id LIKE '$billno' AND date NOT LIKE '$date' ";
			$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run) > 0){
				echo'<script type="text/javascript"> alert("Same bill no exists with another date.Try another bill no.") </script> ';
			}
			else{
				
				$query = "INSERT INTO bill values('$billno','$date')";
				$query_run = mysqli_query($con,$query);
				$tot = ($amount - $amount*$discount)*$quantity; 
				
				$query = "insert into receipt values('$billno','$productid','$quantity','$tot')";
				$query_run = mysqli_query($con,$query);
				$query = "SELECT quantity FROM product WHERE product_id LIKE '$productid'";
				$query_run = mysqli_query($con,$query);
				if(mysqli_num_rows($query_run) > 0)
				{
					while($row=mysqli_fetch_array($query_run))
					{
						$qty = $row['quantity'];
						
					}
				}
				$newquan = $qty - $quantity;
				if($newquan >= 0)
				{
						$query = "UPDATE product SET quantity = '$newquan', date = '$date' WHERE product_id LIKE '$productid'";
						$query_run = mysqli_query($con,$query);
						$query = "SELECT receipt.product_id,product.name,product.brand,product.category,product.amount,product.discount,receipt.quantity,receipt.total_price FROM product,receipt WHERE receipt.bill_id LIKE '$billno' AND product.product_id = receipt.product_id";
						$query_run = mysqli_query($con,$query);
						if(mysqli_num_rows($query_run) > 0)
						{
											
											echo "<table id = 'abc2' class = 'x2' align='center' border-collapse: collapse' >;
											<tr>	
											<th>Product ID</th>
											<th>Name</th>
											<th>Brand</th>
											<th>Category</th>
											<th>Amount</th>
											<th>Discount</th>
											<th>Quantity</th>
											<th>Total Price</th>
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
											echo "<td>" . $row['total_price'] . "</td>";
											
											echo "</tr>";
											}
											echo "</table>";

											mysqli_close($con);
						}
						else
										{
											echo'<script type="text/javascript"> alert("Error.") </script> ';
										}
									
				}
				else
				{
					echo'<script type="text/javascript"> alert("Not that much stock available.") </script> ';
				}
				
			}
		}
		if(isset($_POST['total_btn'])){
			$billno= $_POST['billno'];
			$query = "select sum(total_price) as Total from receipt where bill_id LIKE '$billno'";
			$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run) == 1){
				$row = $query_run->fetch_assoc();
				$total_value = $row['Total'];
			}
		}
		
?>

<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="css/style12.css" type="text/css"/>
	<title></title>
</head>
<body>
<nav>
<ul id="menuContainer">
<?php include_once("home.php");?>
</ul>
</nav>
<form action = "bill.php" method = "post">
	<div id="bodyContainer0">
		<h2>Bill</h2>
		<label id ="bill1"><b>Bill No:</label>
		<input name = "billno" type ="text" id="bill2" value = "<?php echo $billno;?>" required/>
		<label id="bdate1"><b>Date:</label>
		<input name = "date" type ="date" id="bdate2" value = "<?php echo $date;?>" required/>
		
		<input name = "total_value" type ="text" id="tot2" value = "<?php echo $total_value;?>" disabled/>
		<form>
			<fieldset>
					<legend id ="set" >Product Details:</legend>
				<label id="bpro1"><b>Product ID:</label>
				<input name = "productid" type ="text" id="bpro2" value = "<?php echo $prodid;?>" /><br>
				<input name = "search" type ="submit" id ="search" value="Search"/>
				<label id="bnam1"><b>Product<br>Name:</label>
				<input name = "proname" type ="text" id="bnam2" value = "<?php echo $nam;?>"/><br>
				<label id="bbran1"><b>Brand:</label>
				<input name = "brand" type ="text" id="bbran2" value = "<?php echo $bran;?>"/><br>
				<label id="bcat1"><b>Category:</label>
				<input name = "category" type ="text" id="bcat2" value = "<?php echo $cat;?>"/><br>
				<label id="bamt1"><b>Amount:</label>
				<input name = "amount" type ="text" id="bamt2" value = "<?php echo $amt;?>" /><br>
				<label id="bdis1"><b>Discount:</label>
				<input name = "discount" type ="text" id="bdis2" value = "<?php echo $dis;?>" /><br>
				<label id="bquan1"><b>Quantity:</label>
				<input name = "quantity" type ="text" id="bquan2" /><br>
				<input name="add_btn" type ="submit" id ="add_btn" value="Add"/><br>
				<input name = "reset_btn" type ="submit" id ="reset_btn" value="Reset"/>
			</fieldset>
				<input name="total_btn" type ="submit" id ="total_btn" value="Total"/><br>
		</form>
	
			
	</div>
</form>
</body>
</html>