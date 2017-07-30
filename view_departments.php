

<!DOCTYPE html>
<html>
<head>
	<title>Departments Page</title>
	<script>
		function confirm_delete() {
			return confirm('Are you sure want to delete this Faculty?');
		}
	</script>
</head>
<body>

<center>

	<h2>View  table</h2>	
<br>


<table border="1" cellspacing="0" cellpadding="5">
	<tr>
		<th>Serial No</th>
		<th>Department Name</th>
		<th>Department Code</th>
		<th>Department Abbreviation</th>
		<th>Action</th>
	</tr>

	<?php 

		    if (isset($_GET['fac_name'])) {
		        echo $_GET['fac_name'].'<br/>';
		    }else{
		        // Fallback behaviour goes here
		    }
		

		$conn = oci_connect("result", "result", "localhost/orcl");

		$curs = oci_new_cursor($conn);
	
		$sql = "BEGIN view_departments(:p_fac_name, :dept_view_cursor, :p_exc); END;";

		$stid = oci_parse($conn, $sql);

		// oci_bind_by_name($stmt,':p_oname',$fac_old_name,32);

		oci_bind_by_name($stid,':p_fac_name',$p_fac_name,32);
		oci_bind_by_name($stid,':dept_view_cursor',$curs,-1, OCI_B_CURSOR);
		oci_bind_by_name($stid,':p_exc',$message,32);
		// oci_bind_by_name($stid,':dept_view_cursor',$curs,-1, OCI_B_CURSOR);;
		// oci_bind_by_name($stid,':p_exc',$curs,-1, OCI_B_CURSOR);

		// Assign a value to the input 
		
		// $p_fac_name_v = $procedure_fac_name_v;
		
		$a = oci_execute($stid);
		if ($a==true) {
			echo "$message";
		}
		else
			echo "$message";


		oci_execute($curs);  // Execute the REF CURSOR like a normal statement id

		// $row = oci_fetch_array($curs, OCI_RETURN_NULLS+OCI_ASSOC);
		

		while ($row = oci_fetch_array($curs, OCI_RETURN_NULLS+OCI_ASSOC)) {
		
	?>
		
		<tr>
		
		<td><?php echo $row['ROWNUM']; ?></td>
		<td><?php echo $row['DEPT_NAME']; ?></td>
		<td><?php echo $row['DEPT_CODE']; ?></td>
		<td><?php echo $row['DEPT_ABBR']; ?></td>
		
				
		<td>
			<!-- Insert-->
			<!-- <a href="insert_departments.php?fac_name=<?php echo $row['DEPT_NAME']; ?>" target="#">Insert</a>&nbsp;|&nbsp; -->
			<!-- View departments content-->
			<a href="view_departments.php?dept_name=<?php echo $row['DEPT_NAME']; ?>" target="#">View</a>&nbsp;|&nbsp;
			<!-- Update-->
			<a href="update_departments.php?dept_name=<?php echo $row['DEPT_NAME']; ?>" target="#">Update</a>&nbsp;|&nbsp;
			<!-- Delete-->
			<a onclick="return confirm_delete();" href="delete_departments.php?dept_name=<?php echo $row['DEPT_NAME']; ?>" target="#">Delete</a>
			
		</td>
		</tr>
		
		<?php

		}
	
		

		?>
	
	
</table>

<br>

<button onclick="window.location.href='insert_departments.php'">Insert Depertment</button>

<button onclick="window.location.href='home.php'">Back 2 main page</button>

</center>


</body>
</html>
</body>
</html>