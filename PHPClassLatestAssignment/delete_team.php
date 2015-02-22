<?php

require_once('database.php');

$team_id = filter_input(INPUT_POST, 'team_id', FILTER_VALIDATE_INT);

//Delete the players from the players table that are part of the selected team
if($team_id != false) {
	$query = 'DELETE FROM players WHERE teamID = :team_id;
		DELETE FROM teams WHERE teamID = :team_id';
	$statement = $db->prepare($query);
	$statement->bindValue(':team_id', $team_id);
	$success = $statement->execute();
	$statement->closeCursor();
}

// Display the Team list page
include('index.php');
