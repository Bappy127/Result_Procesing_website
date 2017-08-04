<?php 

	$conn = oci_connect("result", "result", "localhost/orcl");

	$sql = 'BEGIN sayHello(:name, :message); END;';
	$stmt = oci_parse($conn,$sql);
	// Bind the input parameter
	oci_bind_by_name($stmt,':name',$name,32);
	// Bind the output parameter
	oci_bind_by_name($stmt,':message',$message,32);
	// Assign a value to the input
	session_start();
	//collect user name
	$sql2='select user name from dual';
	$stmt2=oci_parse($conn,$sql2);
	oci_execute($stmt2);
	$a=oci_fetch_array($stmt2);
	foreach ($a as $item) {
		$name=$item;
		break;
	}
		
	oci_execute($stmt);
	//echo "$message";

?>


<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		
		<link rel="stylesheet" type="text/css" href="css/style_home.css">
	</head>

	<body>
		
		<?php
			include_once 'logout.php';
		?>

		<div class="abc">
			<h1><?php echo "$message"."<br>"."<br>"; ?></h1>
		</div>
	
		<div class="button">
			<button id="button1" onclick="window.location.href='view_faculty.php'">View All faculties</button>
			<button id="button2" onclick="window.location.href='insert_faculty.php'">Insert Faculty</button>
		</div>
		
	</body>
</html>