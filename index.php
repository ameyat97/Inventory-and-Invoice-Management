<?php
	session_start();
	require 'dbconfig/config.php'
?>

<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="css/style10.css" type="text/css"/>
	<title>MY Home Page</title>
</head>
<body>
<nav>
<ul id="menuContainer">
<?php include_once("menu_template.php");?>
</ul>
</nav>
<div id="bodyContainer">
	
	<center>
		<h4>Welcome
		<?php echo $_SESSION['username'] ?>
		</h4>
	</center>
	<h2>Profile Details</h2>
	
	<form class="myform" action="index.php" method="post">
	
	<label id="name1"><b>Name:</label>
	<input name = "name" type ="text" id="name2" required/><br>
	<label id="mob1"><b>Mobile No:</label>
	<input name = "mobile" type ="tel" pattern ="^\d{10}$" id="mob2" required/><br>
	<label id="add1"><b>Address:</label>
	<textarea id = "myTextArea"
                  rows = "2"
                  cols = "20" name = "address" required/></textarea>
	
	<label id="em1"><b>E-mail:</label>
	<input name = "email" type ="email" pattern ="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$" id="em2" required/><br>
	<label id="dob1"><b>Date Of Birth:</label>
	<input name = "DOB" type ="date" id="dob2" required/><br>
	<label id="age1"><b>Age:</label>
	<input type="number" size="3" name="age" min="18" max="75" value = "30" id = "age2" required/><br>
	
	<label id="doj1"><b>Date Of Joining:</label>
	<input name = "DOJ" type ="date"  id="doj2" required/><br>
	<label id="gen"><b>Gender:</label>
		<input id = "gen1" type="radio" name="gender" value="male"><p id = "gen11"> Male</p></input><br>
		<input id = "gen2" type="radio" name="gender" value="female"> <p id = "gen22">Female</p></input><br>
		<input id = "gen3" type="radio" name="gender" value="other"> <p id = "gen33">Other</p></input><br>
		<input name = "submit_btn" type ="submit" id ="submit_btn1" value="Submit"/>
		<input name = "clear_btn" type ="reset" id ="clear_btn1" value="Clear"/>
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
			$DOJ = $_POST['DOJ'];
			$age= $_POST['age'];
			$gender= $_POST['gender'];
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
				//$query = "SELECT id from admin WHERE username LIKE $_SESSION['username'] AND password LIKE $_SESSION['password'] "
				$username = $_SESSION['username'];
				$query = "insert into profile values('$username','$name','$mobile','$address','$email','$DOB','$DOJ','$age','$gender')";
				$query_run = mysqli_query($con,$query);
				if($query_run)
				{
					echo'<script type="text/javascript"> alert("Thank you for profile details.") </script>';
				}
				else
				{
					$query = "UPDATE profile set name = '$name',mobile_no = '$mobile',address = '$address',email = '$email',DOB = '$DOB',DOJ = '$DOJ',age = '$age',gender = '$gender' WHERE username LIKE '$username'";
					$query_run = mysqli_query($con,$query);
					if($query_run){
					echo'<script type="text/javascript"> alert("Your profile details are updated.") </script> ';
					}
					else{
						echo'<script type="text/javascript"> alert("Error.") </script> ';
					}
				}
			}

		}
	?>
	
</div>
</body>
</html>