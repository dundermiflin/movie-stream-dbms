
<?php
	 include('db_config.php');

	 $msg='';

	if(isset($_POST['user']) && isset($_POST['pass'])){
		$username=trim($_POST['user']);
		$password=trim($_POST['pass']);

		if($username=='' || $password==''){
			$msg= 'Please fill all fields';
		}
		else{

			$query= "select * from site_users where user='$username'";

			$result= mysqli_query($link,$query);
			$cnt= mysqli_num_rows($result);
			// echo $query;


			$query= "select * from site_users where user='$username' and pass='$password'";
			$result= mysqli_query($link,$query);
			$cnt= mysqli_num_rows($result);
			if($cnt>0){
				$_SESSION['user']=$username;
				header('Location: movies.php');
				exit();
			}
			else{
				$msg='Account not found';
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
					<nav id="nav">
					<!-- 	<a href="index.php">Home</a>
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
							<form action="index.php" method="POST">
								<label class="labeltext">Username:</label>
								<input class="inputfields" type="text" name="user">
								<label class="labeltext">Password:</label>
								<input class="inputfields" type="password" name="pass">
								<input type="submit" class="button alt" value="Login">
							</form>
							<a href= "registration.php">Not a user? Register.</a>
						</div>
					</div>
				</div>
			</section>

		
	</body>
</html>