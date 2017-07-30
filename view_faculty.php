
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Faculty Page</title>
	<link rel="stylesheet" type="text/css" href="css/style_view_depertment.css">
	
	<script>
		function confirm_delete() {
			return confirm('Are you sure want to delete this Faculty?');
		}
	</script>
	
	
</head>
<body>
<center>
<h2>Faculty Table</h2>

<br>

<table border="1" cellspacing="0" cellpadding="5">
	<tr>
		<th>Serial No</th>
		<th>Faculty Name</th>
		<th>Action</th>
	</tr>
	
	<?php


			$conn = oci_connect("result", "result", "localhost/orcl"); // Create connection to Oracle

			$curs = oci_new_cursor($conn);

			$query = "BEGIN view_faculty(:fac_view_cursor); END;";

			$stid = oci_parse($conn, $query);
			oci_bind_by_name($stid,':fac_view_cursor',$curs,-1, OCI_B_CURSOR);
			oci_execute($stid);


			oci_execute($curs);  // Execute the REF CURSOR like a normal statement id

			
			
			while ($row = oci_fetch_array($curs, OCI_RETURN_NULLS+OCI_ASSOC)) 
			{
?>
			<tr>
			<div class="abc">
				
			</div>
			<td><?php echo $row['ROWNUM']; ?></td>
			<td><?php echo $row['FAC_NAME']; ?></td>
			
			
			<td>

				<a href="insert_faculty.php?fac_name=<?php echo $row['FAC_NAME']; ?>" target="#">Insert</a>&nbsp;|&nbsp;
				<a href="view_departments.php?fac_name=<?php echo $row['FAC_NAME']; ?>" target="#">View</a>&nbsp;|&nbsp;
				<a href="update_faculty.php?fac_name=<?php echo $row['FAC_NAME']; ?>" target="#">Update</a>&nbsp;|&nbsp;
				<a onclick="return confirm_delete();" href="delete_faculty.php?fac_name=<?php echo $row['FAC_NAME']; ?>" target="#">Delete</a>

			</td>
			</tr>
			<?php
			}
			
	 
	?>
			
</table>

<br>
<button onclick="window.location.href='home.php'">Back to Main Page</button>
</center>

</body>
</html>