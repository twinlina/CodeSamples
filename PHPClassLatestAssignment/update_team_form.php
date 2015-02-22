<?php

require_once('database.php');

/*
$query = 'SELECT * FROM teams ORDER BY teamID';
$statement = $db->prepare($query);
$statement->execute();
$teams = $statement->fetchAll();
$statement->closeCursor();
*/

// Get team data from post
$team_id = filter_input(INPUT_POST, 'team_id');
$name = filter_input(INPUT_POST, 'team_name');
$mascot = filter_input(INPUT_POST, 'mascot');

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Little League</title>
		<link rel="stylesheet" type="text/css" href="main.css" />
	</head>
	
	<body>
		
		<header>
			<h1>Update Team: <?php echo $name; ?></h1>
		</header>
		
		<main>
			
			<form action="update_team.php" method="post" id="update_team_form">
				
				<label>Team Name:</label>
				<input type="text" name="name" value="<?php echo $name; ?>"><br />
				
				<label>Mascot:</label>
				<input type="text" name="mascot" value="<?php echo $mascot; ?>"><br />
				
				<input type="hidden" name="team_id" value="<?php echo $team_id; ?>">
								
				<label>&nbsp;</label>
				<input type="submit" value="Update team"><br />
			</form>
			<p><a href="index.php">Back to teams</a></p>
		</main>
		
		<footer></footer>
	</body>
</html>

