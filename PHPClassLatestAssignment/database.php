<?php
	$dsn = 'mysql:host=wren.arvixe.com;dbname=look4ter_7314';
	$username = 'look4ter_7314';
	$password = 'cs551373';
	
	try {
		$db = new PDO($dsn, $username, $password);
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		include('database_error.php');
		exit();
	}
?>
