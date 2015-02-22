<?php

// Get player data
$player_id = filter_input(INPUT_POST, 'player_id');
$player_name = filter_input(INPUT_POST, 'player_name');
$age = filter_input(INPUT_POST, 'age');
$address = filter_input(INPUT_POST, 'address');
$phone_number = filter_input(INPUT_POST, 'phone_number');
$position = filter_input(INPUT_POST, 'position');
$team_id = filter_input(INPUT_POST, 'team_id');
$comments = filter_input(INPUT_POST, 'comments');

// Removes non-numeric characters from string
for($i = 0; $i < strlen($phone_number); $i++){
	$current = substr($phone_number, $i, 1);
	if(is_numeric($current)) {
		$phone_str .= $current;
	}
}

// Separates string and formats into phone number
$phone1 = substr($phone_str, 0, 3);
$phone2 = substr($phone_str, 3, 3);
$phone3 = substr($phone_str, 6);
$phoneNum = $phone1 . '-' . $phone2 . '-' . $phone3;

// Validate inputs
if($player_name == null || $player_name == false || $age == null || $age == false || 
	$address == null || $address == false || $phone_number == null || $phone_number == false || 
	$position == null || $position == false || $team_id == null || $team_id == false) {
	$error = "Please fill in all fields and try again.";
} else {
	require_once('database.php');
	
	// Add team to the database
	$query = 'UPDATE players 
		SET playerID = :player_id, playerName = :player_name, age = :age, address = :address, phoneNumber = :phoneNum, position = :position, teamID = :team_id, comments = :comments  
		WHERE playerID = :player_id';
	$statement = $db->prepare($query);
	$statement->bindValue(':player_id', $player_id);
	$statement->bindValue(':player_name', $player_name);
	$statement->bindValue(':age', $age);
	$statement->bindValue(':address', $address);
	$statement->bindValue(':phoneNum', $phoneNum);
	$statement->bindValue(':position', $position);
	$statement->bindValue(':team_id', $team_id);
	$statement->bindValue(':comments', $comments);
	$statement->execute();
	$statement->closeCursor;
	
	// Display the Player list page
	include('players.php');
}

?>