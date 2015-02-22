<?php

require_once('database.php');

$query = 'SELECT * FROM teams ORDER BY teamID';
$statement = $db->prepare($query);
$statement->execute();
$teams = $statement->fetchAll();
$statement->closeCursor();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Little League</title>
		<link rel="stylesheet" type="text/css" href="main.css" />
	</head>
	
	<body>
		
		<header>
			<h1>Add a Player</h1>
		</header>
		
		<main>
			
			<form action="add_player.php" method="post" id="add_player_form">
				<label>Player Name:</label>
				<input type="text" name="playerName"><br />
				
				<label>Birth Date:</label>
				<input type="date" name="birthDate"><br />
				
				<label>Address:</label>
				<input type="text" name="address"><br />
				
				<label>Phone Number:</label>
				<input type="text" name="phoneNumber"><br />
				
				<label>Desired Position:</label>
				<input type="text" name="position"><br />
				
				<label>Team:</label>
				<select name="team_id">
					<?php foreach ($teams as $team) : ?>
						<option value="<?php echo $team['teamID']; ?>"><?php echo $team['name']; ?></option>
					<?php endforeach; ?>
				</select><br />
				
				<label>Comments:</label>
				<textarea name="comments" rows="3" cols="75"></textarea><br />
				
				<label>&nbsp;</label>
				<input type="submit" value="Add player"><br />
			</form>
			<p><a href="players.php">Back to players</a></p>
		</main>
		
		<footer></footer>
	</body>
</html>

