<?php
	include('db_config.php');

	$user= trim($_POST['user']);
	$pass1= trim($_POST['pass1']);
	$pass2= trim($_POST['pass2']);

	// echo $pass1;

	if($user=='' || $pass1!=$pass2 || $pass1==''){
		header("Location: registration.php");
		// echo "Failed";
		exit();
	}

	$query= "select * from site_users where user='$user'";

	$result= mysqli_query($link,$query);
	$cnt= mysqli_num_rows($result);

	if($cnt>0){
		header("Location: registration.php");
		// echo "Failed";
		exit();
	}

	$query= "insert into site_users VALUES ('$user','$pass1',1000)";
	$result= mysqli_query($link,$query);

	// echo $result;
	header("Location: movies.php");

?>