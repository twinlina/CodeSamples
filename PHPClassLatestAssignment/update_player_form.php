<?php

require_once('database.php');

$query = 'SELECT * FROM teams ORDER BY teamID';
$statement = $db->prepare($query);
$statement->execute();
$teams = $statement->fetchAll();
$statement->closeCursor();

// Get team data from post
$player_id = filter_input(INPUT_POST, 'player_id');
$player_name = filter_input(INPUT_POST, 'player_name');
$age = filter_input(INPUT_POST, 'age');
$address = filter_input(INPUT_POST, 'address');
$phone_number = filter_input(INPUT_POST, 'phone_number');
$position = filter_input(INPUT_POST, 'position');
$team_id = filter_input(INPUT_POST, 'team_id');

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Little League</title>
		<link rel="stylesheet" type="text/css" href="main.css" />
	</head>
	
	<body>
		
		<header>
			<h1>Update Player: <?php echo $player_name; ?></h1>
		</header>
		
		<main>
			
			<form action="update_player.php" method="post" id="update_player_form">
				<label>Player Name:</label>
				<input type="text" name="player_name" value="<?php echo $player_name; ?>"><br />
				
				<label>Age:</label>
				<input type="text" name="age" value="<?php echo $age; ?>"><br />
				
				<label>Address:</label>
				<input type="text" name="address" value="<?php echo $address; ?>"><br />
				
				<label>Phone Number:</label>
				<input type="text" name="phone_number" value="<?php echo $phone_number; ?>"><br />
				
				<label>Desired Position:</label>
				<input type="text" name="position" value="<?php echo $position; ?>"><br />
				
				<label>Team:</label>
				<select name="team_id">
					<?php foreach ($teams as $team) : ?>
						<option value="<?php echo $team['teamID']; ?>" <?php if($team['teamID'] == $team_id) { echo "selected"; } ?>><?php echo $team['name']; ?></option>
					<?php endforeach; ?>
				</select><br />
				
				<label>Comments:</label>
				<textarea name="comments" rows="3" cols="75"></textarea><br />
				
				<input type="hidden" name="player_id" value="<?php echo $player_id; ?>">
								
				<label>&nbsp;</label>
				<input type="submit" value="Update player"><br />
				
			</form>
			<p><a href="players.php">Back to players</a></p>
		</main>
		
		<footer></footer>
	</body>
</html>

