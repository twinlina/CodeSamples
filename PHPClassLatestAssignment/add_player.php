<?php

// Get player data
$playerName = filter_input(INPUT_POST, 'playerName');
$birthDate = filter_input(INPUT_POST, 'birthDate');
$address = filter_input(INPUT_POST, 'address');
$phoneNumber = filter_input(INPUT_POST, 'phoneNumber');
$position = filter_input(INPUT_POST, 'position');
$team_id = filter_input(INPUT_POST, 'team_id');
$comments = filter_input(INPUT_POST, 'comments');

// Removes non-numeric characters from string
for($i = 0; $i < strlen($phoneNumber); $i++){
	$current = substr($phoneNumber, $i, 1);
	if(is_numeric($current)) {
		$phone_str .= $current;
	}
}
// Separates string and formats into phone number
$phone1 = substr($phone_str, 0, 3);
$phone2 = substr($phone_str, 3, 3);
$phone3 = substr($phone_str, 6);
$phoneNum = $phone1 . '-' . $phone2 . '-' . $phone3;

// Birth date
$today = new DateTime('now');
$birth = new DateTime($birthDate);
$diff = $today->diff($birth);
$age = $diff->y;


// Validate inputes
if($playerName == null || $playerName == false || $age == null || $age == false || 
	$address == null || $address == false || $phoneNumber == null || $phoneNumber == false || 
	$position == null || $position == false || $team_id == null || $team_id == false) {
	$error = "Please fill in all fields and try again.";
} else {
	require_once('database.php');
	
	// Add player to the database
	$query = 'INSERT INTO  players (teamID, playerName, address, phoneNumber, age, position, comments) 
		VALUES (:team_id, :playerName, :address, :phoneNum, :age, :position, :comments)';
	$statement = $db->prepare($query);
	$statement->bindValue(':team_id', $team_id);
	$statement->bindValue(':playerName', $playerName);
	$statement->bindValue(':address', $address);
	$statement->bindValue(':phoneNum', $phoneNum);
	$statement->bindValue(':age', $age);
	$statement->bindValue(':position', $position);
	$statement->bindValue(':comments', $comments);
	$statement->execute();
	$statement->closeCursor;
	
	// Display the Player list page
	include('players.php');
}

?>