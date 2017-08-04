<?php

if(isset($_POST['form_login'])) 
{
	
	try {	
		
		if(empty($_POST['username'])) {
			throw new Exception('Username can not be empty');
		}
		
		if(empty($_POST['password'])) {
			throw new Exception('Password can not be empty');
		}

		$user_name=$_POST["username"];
		$user_pass=$_POST["password"];
	
		
		$conn = oci_connect("$user_name", "$user_pass", "localhost/orcl");
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }else
          echo 'Succesfully connected with Oracle DB';
		//$conn = oci_connect("admin", "admin", "localhost/RPDB");

		//$query = " SELECT * from users WHERE userid='".$nis."' and password='".$password."'";
		//$query= " select * from user_info WHERE user_name='$user_name' and user_password='$user_pass'";
		$query="select user name from dual";
    	$result = oci_parse($conn, $query);
    	oci_execute($result);
    	$tmpcount = oci_fetch($result);
    	if ($tmpcount==1) {
        session_start();
        header("location: home.php");
        $_SESSION['name'] = $user_name;
      }
    	else
    	{
        echo "Login Failed";
    	}
		
   	}
	
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
	
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login Page</title>
    

    <link href="css/style_login_page.css" rel="stylesheet" type="text/css"/>
    
  </head>

  <body>

  <?php
  if(isset($error_message))
  {
    echo $error_message;
  }
  ?>
  <br>

  <form action="" method="post">

    <h1>Welcome to Result Processing System.</h1>

    <div class="container">
      <input type="text" placeholder="Username" name="username" required>

      <input type="password" placeholder="Password" name="password" required>

      <button type="submit" name="form_login">Login</button>
    </div>

    <!-- <p>Not registered? <a href="#"><span> Sign Up Here</a></span></p> -->

  </form>

  </body>

</html>