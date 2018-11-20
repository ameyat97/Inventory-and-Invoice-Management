<?php
	session_start();
	require 'dbconfig/config.php'
?>

<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="css/style10.css" type="text/css"/>
	<title>Staff Management</title>
</head>
<body>
<nav>
<ul id="menuContainer">
<?php include_once("menu_template.php");?>
</ul>
</nav>
<div id="bodyContainer">
	
		<h2>Add Staff</h2>
		<form class="myform" action="staff.php" method="post">
			<label id="snam1"><b>Name:</label>
			<input name = "name" type ="text" id="snam2" required/><br>
			<label id="sadd1"><b>Address:</label>
			<textarea id = "myTextArea1"
                  rows = "2"
                  cols = "20" name = "address" required/></textarea>
	
			<label id="smob1"><b>Mobile No:</label>
			<input name = "mobile" type ="tel" pattern ="^\d{10}$" id="smob2" required/><br>
			<label id="sem1"><b>Email ID:</label>
			<input name = "email" type ="email" pattern ="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$" id="sem2" required/><br>
			<label id="sgen"><b>Gender:</label>
			<input type="radio" id ="sgen1" name="gender" value="male"><p id="sgen11"> Male</p><br>
			<input type="radio" id="sgen2" name="gender" value="female"> <p id="sgen22">Female</p><br>
			<input type="radio" id="sgen3" name="gender" value="other"> <p id="sgen33">Other</p><br>
			<label id="sdob1"><b>Date Of Birth:</label>
			<input name = "DOB" type ="date" id="sdob2" required/><br>
			<label id="sage1"><b>Age:</label>
			<input type="number" size="3" name="age" min="18" max="99" value = "30" id = "sage2" required/><br>
			<label id="sdoj1"><b>Date Of Joining:</label>
			<input name = "DOJ" type ="date" id="sdoj2" required/><br>
			<label id="sal1"><b>Salary:</label>
			<input type="number"  name="salary" min="0"  id = "sal2" required/><br>
			<input name = "submit_btn" type ="submit" id ="submit_btn2" value="Add Staff"/>
			<input name = "clear_btn" type ="reset" id ="clear_btn2" value="Clear"/>
		</form>
		<?php
		if(isset($_POST['submit_btn']))
		{
			//echo'<script type="text/javascript"> alert("Sign up button clicked") </script> ';
			$name= $_POST['name'];
			$mobile= $_POST['mobile'];
			$address= $_POST['address'];
			$email= $_POST['email'];
			$DOB = $_POST['DOB'];
			$age = $_POST['age'];
			$DOJ = $_POST['DOJ'];
			$gender= $_POST['gender'];
			$salary= $_POST['salary'];
			$currdate = date("m/d/Y");
			if(strtotime($currdate) < strtotime($DOB))
			{
				echo'<script type="text/javascript"> alert("Date of Birth is greater than current date.") </script>';
			}
			else if(strtotime($DOJ) < strtotime($DOB))
			{
				echo'<script type="text/javascript"> alert("Enter either valid date of birth or date of joining.") </script>';
			}
			else
			{
				$query = "insert into staff values('','$name','$address','$mobile','$email','$gender','$DOB','$age','$DOJ','$salary')";
				$query_run = mysqli_query($con,$query);
				if($query_run)
				{
					echo'<script type="text/javascript"> alert("New staff is successfully added.") </script>';
				}
				else
				{
					echo'<script type="text/javascript"> alert("Error") </script> ';
				}
			}
		}
	?>
	
</div>
</body>
</html>