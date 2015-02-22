<?php

require_once('database.php');

// Get all players
$queryAllTeams = 'SELECT * FROM players INNER JOIN teams on teams.teamID = players.teamID ORDER BY playerID';
$statement2 = $db->prepare($queryAllTeams);
$statement2->execute();
$players = $statement2->fetchAll();
$statement2->closeCursor();

// $comments = htmlspecialchars($player['comments']);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Little League</title>
		<link rel="stylesheet" type="text/css" href="main.css" />
	</head>
	
	<body>
	<main>
		<header class="nav">
		<h1>Little League Players</h1>
			<!-- display a list of teams -->
			<nav>
				<ul>
					<li><a href="index.php">Teams</a></li>
					<li><a href="players.php">Players</a></li>
				</ul>
			</nav>
		</header>
		
		<section class="data">
			<!-- display the table of players-->
						
			<table border="1" cellpadding="4" cellspacing="0">
				<tr>
					<th>Player ID</th>
					<th>Player Name</th>
					<th>Age</th>
					<th>Address</th>
					<th>Phone Number</th>
					<th>Position</th>
					<th>Team Name</th>
					<th>Comments</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				</tr>
				
				<?php foreach ($players as $player) : ?>
				<tr>
					<td><?php echo $player['playerID']; ?></td>
					<td><?php echo $player['playerName']; ?></td>
					<td><?php echo $player['age']; ?></td>
					<td><?php echo $player['address']; ?></td>
					<td><?php echo $player['phoneNumber']; ?></td>
					<td><?php echo $player['position']; ?></td>
					<td><?php echo $player['name']; ?></td>
					<td><?php echo nl2br(htmlspecialchars($player['comments'])); ?></td>
					<td><form action="delete_player.php" method="post">
						<input type="hidden" name="player_id" value="<?php echo $player['playerID']; ?>">
						<input type="submit" value="Delete">
						</form>
					</td>
					
					<td><form action="update_player_form.php" method="post">
						<input type="hidden" name="player_id" value="<?php echo $player['playerID']; ?>">
						<input type="hidden" name="player_name" value="<?php echo $player['playerName']; ?>">
						<input type="hidden" name="age" value="<?php echo $player['age']; ?>">
						<input type="hidden" name="address" value="<?php echo $player['address']; ?>">
						<input type="hidden" name="phone_number" value="<?php echo $player['phoneNumber']; ?>">
						<input type="hidden" name="position" value="<?php echo $player['position']; ?>">
						<input type="hidden" name="team_id" value="<?php echo $player['teamID']; ?>">
						<input type="hidden" name="comments" value="<?php echo $player['comments']; ?>">
							<input type="submit" value="Update">
						</form>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			
			<p><a href="add_player_form.php">Add a player</a></p>
							
							
		</section>
	</main>
	<footer></footer>
	</body>
</html>