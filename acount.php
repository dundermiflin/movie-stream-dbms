
<?php
	 include('db_config.php');
	 $user= $_SESSION['user'];
 		$query= "select * from site_users where user='$user'";
		$result= mysqli_query($link,$query);
		$row= mysqli_fetch_assoc($result);
		$bal= $row['bal'];
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
						<a href="logout.php">Log out <?php echo $user?> </a>
						<a href="gallery.php">Buy movies</a>
						<a href="movies.php">Your Movies</a>
					</nav>
				</div>
			</header>
			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Banner -->
			<section id="banner">
				<div class="inner" align="center">	
					<div class="actions">
						<div class="loginWindow">
							<?php
								echo "
									<div class='infoWindow'><strong>
										USERNAME: ".$user."<br>
										BALANCE:  ".$bal."<br><br>
										</strong>
									</div>
								";
							?>
							<a href= "http://www.paytm.com">Top up balance.</a>
						</div>
					</div>
				</div>
			</section>

		
	</body>
</html>