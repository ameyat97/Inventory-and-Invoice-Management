<?php
	session_start();
	require 'dbconfig/config.php'
?>

<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="css/style10.css" type="text/css"/>
	<title>Staff Details</title>
</head>
<body>
<nav>
<ul id="menuContainer">
<?php include_once("menu_template.php");?>
</ul>
</nav>
<div id="bodyContainer2">
	
		<h2>View Staff Details</h2>
		<form class = "myform" action="staff_details.php" method="post">
		<label id="sd1"><b>Staff ID:</label>
		<input name = "staffid" type ="text" id="sd2"/><br>
		<input name = "submit_btn" type ="submit" id ="search_btn1" value="Search"/>
		</form>
		<br><br><br><br>
		<?php
		if(isset($_POST['submit_btn']))
		{
			//echo'<script type="text/javascript"> alert("Sign up button clicked") </script> ';
			$staffid= $_POST['staffid'];
		
			
			$query = "SELECT * FROM staff WHERE staff_id LIKE '$staffid'";
			$query_run = mysqli_query($con,$query);
			if(mysqli_num_rows($query_run) > 0)
							{
								
								echo "<table align='center' id = 'abc1' class = 'x1' border-collapse: collapse'>
								<tr>
								<th>Staff ID</th>
								<th>Name</th>
								<th>Address</th>
								<th>Mobile no</th>
								<th>Email</th>
								<th>Gender</th>
								<th>Date Of Birth</th>
								<th>Age</th>
								<th>Date Of Joining</th>
								<th>Salary</th>
								</tr>";
								
								
								while($row = mysqli_fetch_array($query_run))
								{
								echo "<tr>";
								echo "<td>" . $row['staff_id'] . "</td>";
								echo "<td>" . $row['name'] . "</td>";
								echo "<td>" . $row['address'] . "</td>";
								echo "<td>" . $row['mobile_no'] . "</td>";
								echo "<td>" . $row['email'] . "</td>";
								echo "<td>" . $row['gender'] . "</td>";
								echo "<td>" . $row['DOB'] . "</td>";
								echo "<td>" . $row['age'] . "</td>";
								echo "<td>" . $row['DOJ'] . "</td>";
								echo "<td>" . $row['salary'] . "</td>";
								echo "</tr>";
								}
								echo "</table>";

								mysqli_close($con);
							}
							
							
							else
							{
								echo'<script type="text/javascript"> alert("Staff ID does not exist.") </script> ';
							}

		}
	?>
			
	
</div>
</body>
</html>