<?php


//catch value & set to a variable

if(isset($_REQUEST['fac_name'])) {
	$faculty_name = $_REQUEST['fac_name'];  //different name varriable 

	echo "$faculty_name"."<br>";
	$conn = oci_connect("result", "result", "localhost/orcl");

		
		$sql= 'BEGIN  del_faculty(:p_fname,:message);END;';

		$stmt = oci_parse($conn,$sql);

		//  Bind the input parameter
		oci_bind_by_name($stmt,':p_fname',$f_name,32);
		oci_bind_by_name($stmt,':message',$message,32);
		
		// Assign value
		$f_name = $faculty_name;
		
	
		oci_execute($stmt);

		
		header('location: view_faculty.php');



}
else {
	//header('location: showdata.php');
}



?>