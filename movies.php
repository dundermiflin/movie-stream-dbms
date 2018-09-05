<?php
	include('db_config.php');
	if(!isset($_SESSION['user'])){
		header('Location: index.php');
		exit();
	}

	$user= $_SESSION['user'];
	// echo $user;
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
						<a href="gallery.php">buy Movies</a>
						<a href="logout.php">Log out <?php echo $user?> </a>
					</nav>
				</div>
			</header>
			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Banner -->
			<section id="banner">
				<div class="inner" align="center">
					<?php
						$query= "select m.title,m.rating,m.price from movies m,transact t where t.mov=m.id and t.usr=".$user;
						$query1= "select title,rating,price from movies where id in(select mov from transact where usr='".$user."')";
						$result= mysqli_query($link,$query1); 
						if(mysqli_num_rows($result)>0){
							echo "<div class='grid-container'>"; 
							while($row= mysqli_fetch_assoc($result)){
								echo "
									<div class= 'movieWindow'>
										<video height='240' width='320' controls><source src='movies/".$row['title'].".mkv' >No video available.</video><br>".
										$row['title']."<br>IMDb Rating: ".
										$row['rating']."
									</div>";
							}
							echo "</div";
						}
					?>

				</div>
			</section>

		
	</body>
</html>