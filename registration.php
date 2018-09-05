<?php
	include('db_config.php');
	$msg='';

	if(isset($_POST['register'])){
		$user= trim($_POST['user']);
		$pass1= trim($_POST['pass1']);
		$pass2= trim($_POST['pass2']);

		if($user=='' || $pass2=='' || $pass1==''){
			$msg= 'Enter all fields';
		}
		elseif($pass1!=$pass2){
			$msg= 'Please re-type password correctly';
		}
		else{
			$query= "select * from site_users where user='$user'";

			$result= mysqli_query($link,$query);
			$cnt= mysqli_num_rows($result);

			if($cnt>0){
				$msg= 'Username already taken';
			}
			else{
				$query= "insert into site_users VALUES ('$user','$pass1',1000)";
				$result= mysqli_query($link,$query);
				header("Location: index.php");
			}
		}
	}

?>
<html>
	<head>
		<title>Movie</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="index.php" class="logo">Blockbuster</a>
					<nav id="nav"><!-- 
						<a href="index.php">Home</a>
						<a href="movies.php">Movies</a> -->
					</nav>
				</div>
			</header>
			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Banner -->
			<section id="banner">
				<div class="inner" align="center">	
					<div class="actions">
						<div class="loginWindow">
							<?php if($msg!=''){
									echo "
										<div class='alertWindow'>
											$msg
										</div>
									";
								}
							?>
							<form action="registration.php" method="POST">
								<label class="labeltext">Username:</label>
								<input class="inputfields" type="text" name="user">
								<label class="labeltext">Password:</label>
								<input class="inputfields" type="password" name="pass1">
								<label class="labeltext">Re-type Password:</label>
								<input class="inputfields" type="password" name="pass2">
								<input type="submit" class="button alt" name='register' value="Register">
							</form>
							<a href= "index.php">Already a user? Login.</a>
						</div>
					</div>
				</div>
			</section>

		
	</body>
</html>