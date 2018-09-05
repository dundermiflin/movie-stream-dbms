<?php

	define('DB_SERVER','localhost');
	define('DB_USERNAME','root');
	define('DB_PASSWORD','');
	define('DB_NAME','dbs_proj');

	$link= mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

	session_start();

	// echo "Working";
?>