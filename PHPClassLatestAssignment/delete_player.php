<?php

require_once('database.php');

$player_id = filter_input(INPUT_POST, 'player_id', FILTER_VALIDATE_INT);

//Delete the players from the players table that are part of the selected team
if($player_id != false) {
	$query = 'DELETE FROM players WHERE playerID = :player_id';
	$statement = $db->prepare($query);
	$statement->bindValue(':player_id', $player_id);
	$success = $statement->execute();
	$statement->closeCursor();
}

// Display the Team list page
include('players.php');
