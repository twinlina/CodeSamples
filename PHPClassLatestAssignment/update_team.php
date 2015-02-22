<?php

// Get team data
$team_id = filter_input(INPUT_POST, 'team_id');
$name = filter_input(INPUT_POST, 'name');
$mascot = filter_input(INPUT_POST, 'mascot');

// Validate inputs
if($name == null || $name == false || $mascot == null || $mascot == false) {
	$error = "Please fill in all fields and try again.";
} else {
	require_once('database.php');
	
	// Update team in the database
	$query = 'UPDATE teams SET teamId = :team_id, name = :name, mascot = :mascot WHERE teamID = :team_id';
	$statement = $db->prepare($query);
	$statement->bindValue(':team_id', $team_id);
	$statement->bindValue(':name', $name);
	$statement->bindValue(':mascot', $mascot);
	$statement->execute();
	$statement->closeCursor;
	
	// Display the Teams list page
	include('index.php');
}

?>