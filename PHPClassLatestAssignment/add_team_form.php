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
			<h1>Add a Team</h1>
		</header>
		
		<main>
			
			<form action="add_team.php" method="post" id="add_team_form">
				<label>Team Name:</label>
				<input type="text" name="name"><br />
				
				<label>Mascot:</label>
				<input type="text" name="mascot"><br />
				
				<label>&nbsp;</label>
				<input type="submit" value="Add team"><br />
			</form>
			<p><a href="index.php">Back to teams</a></p>
		</main>
		
		<footer></footer>
	</body>
</html>

