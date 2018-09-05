<?php
	include('db_config.php');
	if(!isset($_SESSION['user'])){
		header('Location: index.php');
		exit();
	}
	$bal=1;
	$price=0;
	$user= $_SESSION['user'];
	if(isset($_GET['mov_id'])){
		$id= $_GET['mov_id'];
		$query= "select * from site_users where user='$user'";
		$result= mysqli_query($link,$query);
		$row= mysqli_fetch_assoc($result);
		$bal= $row['bal'];

		$query= "select * from movies where id=$id";
		$result= mysqli_query($link,$query);
		$row= mysqli_fetch_assoc($result);
		$price= $row['price'];

		if($bal>=$price){

			$bal-=$price;

			$query= "insert into transact values($id,'$user')";
			$result= mysqli_query($link,$query);
			
			$query= "update site_users set bal=$bal where user='$user'";
			$result= mysqli_query($link,$query);
			header("Location: movies.php");
		}
	}
?>
<html>
	<head>
		<title>Movie</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/movies.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<a href="index.php" class="logo">Blockbuster</a>
					<nav id="nav">
						<a href="acount.php">Account</a>
						<a href="movies.php">Your Movies</a>
						<a href="logout.php">Log out <?php echo $user?> </a>
					</nav>
				</div>
			</header>
			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Banner -->
			<section id="banner">
				<?php
					if($bal<$price){
						echo "
							<div class='inner' align='center'>
								<div class= 'alertWindow'>	
									<strong>Not enough balance. Try another movie, or top-up balance.</strong>		
								</div>
							</div><br>			
						";
					}
				?>
				<div class="inner" align="center">
					<?php
						$query= "select id,title,rating,price from movies where id not in(select mov from transact where usr='".$user."')";
						$result= mysqli_query($link,$query); 
						if(mysqli_num_rows($result)>0){
							echo "<div class='grid-container'>"; 
							while($row= mysqli_fetch_assoc($result)){
								echo "
									<div class= 'movieWindow'>
										<img src='images/posters/".$row['title'].".jpg' height='320' width='200'><br>".
										$row['title']."<br>IMDb Rating: ".
										$row['rating']."<br>Price: ".
										$row['price']."<br>
										<a href=gallery.php?mov_id=".$row['id']."><strong>Buy</strong></a>
									</div>";
							}
							echo "</div";
						}
					?>

				</div>
			</section>

		
	</body>
</html>