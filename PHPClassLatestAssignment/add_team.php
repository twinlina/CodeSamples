<?php

// Get team data
$name = filter_input(INPUT_POST, 'name');
$mascot = filter_input(INPUT_POST, 'mascot');

// Validate inputes
if($name == null || $name == false || $mascot == null || $mascot == false) {
	$error = "Please fill in all fields and try again.";
} else {
	require_once('database.php');
	
	// Add team to the database
	$query = 'INSERT INTO teams (name, mascot) VALUES (:name, :mascot)';
	$statement = $db->prepare($query);
	$statement->bindValue(':name', $name);
	$statement->bindValue(':mascot', $mascot);
	$statement->execute();
	$statement->closeCursor;
	
	// Display the Teams list page
	include('index.php');
}

?>