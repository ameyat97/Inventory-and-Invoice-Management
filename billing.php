<?php
	session_start();
	require 'dbconfig/config.php'
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cashier Login Page</title>
	<link rel="stylesheet" href="css/style11.css">
</head>
<body style="background-color:#8e44ad">

	<div id="main-wrapper">
		<center>
			<h2>Cashier Login Form</h2>
			<img src="images/image1.png" class="image1"/>
		</center>
		
		<form class="myform" action="billing.php" method="post">
			<label class="username"><b>Staff ID:</label><br>
			<input name = "staffid" type ="text" class="inputvalues" placeholder="Enter your Staff ID:" required/><br>
			<label class="password"><b>Password:</label><br>
			<input name ="password" type ="password" class="inputvalues" placeholder="Type your password" required/>
			<input name ="login" type ="submit" id ="signup_btn" value="Login"/><br>
			<a class = "forgot" href="#">Forgot Password?</a>
		</form>
		<?php
		if(isset($_POST['login']))
		{
			
			$staffid= $_POST['staffid'];
			$password= $_POST['password'];
			$query = "select staff_id from works WHERE staff_id = '$staffid' AND department_id = '2' ";
			$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0)
			{
				
			}
			else
			{
				//invalid
				echo'<script type="text/javascript"> alert("You are not cashier") </script>';
			}
			
			$query = "select * from cashierlogin WHERE staff_id = '$staffid' AND password = '$password' ";
			$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run)>0)
			{
				//valid
				$_SESSION['staff_id'] = $staffid;
				header('location:bill.php');
			}
			else
			{
				//invalid
				echo'<script type="text/javascript"> alert("Invalid credentials") </script>';
			}
		}
		
		?>
	</div>
</body>
</html>