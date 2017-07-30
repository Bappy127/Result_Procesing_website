
<?php

if(isset($_POST['form_faculty_insert']))
{
	

	try
	{
		if(empty($_POST['faculty_name'])) {
			throw new Exception('Faculty name can not be empty');
		}



		$faculty_name = $_POST["faculty_name"];

		$conn = oci_connect("result", "result", "localhost/orcl");


		$sql= 'BEGIN  insert_faculty(:p_name,:message);END;';

		$stmt = oci_parse($conn,$sql);


		//  Bind the input parameter
		oci_bind_by_name($stmt,':p_name',$fac_name,64);
		
		// Bind the output parameter
		oci_bind_by_name($stmt,':message',$message,64);

		// Assign a value to the input 
		$fac_name = $faculty_name;
		


		$a = oci_execute($stmt);
		if ($a == true)
		{
			echo "$message";
		}
	
	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}



}	
	
?>







<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Insert Page</title>
	<link rel="stylesheet" type="text/css" href="css/style_inser_faculty.css">
</head>
<body>


<br>
<center>
<form action="" method="post">
<table>
	<tr id="abc">
		<td>Faculty name: </td>
		<td><input type="text" name="faculty_name"> <input type="submit" value="Insert" name="form_faculty_insert"></td>
		
	</tr>
	
	<tr id="abcd">
		<td></td>
		<!-- <td><input type="submit" value="Insert" name="form_faculty_insert"></td> -->
	</tr>
	
</table>
</form>


<br>
<button onclick="window.location.href='view_faculty.php'"> Back </button>
<button onclick="window.location.href='home.php'">Back to Main Page</button>

</center>
</body>
</html>