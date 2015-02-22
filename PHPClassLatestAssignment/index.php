<?php

require_once('database.php');

// Get teamID
$team_id = filter_input(INPUT_GET, 'team_id', FILTER_VALIDATE_INT);
if ($team_id == NULL || $team_id == FALSE) {
	$team_id = 1;
}

/* Get name for selected team
$queryTeam = 'SELECT * FROM teams WHERE teamID = :team_id';
$statement1 = $db->prepare($queryTeam);
$statement1->bindValue(':team_id', $team_id);
$statement1->execute();
$team = $statement1->fetch();
$team_name = $team['name'];
$statement1->closeCursor();
*/

// Get all teams
$queryAllTeams = 'SELECT * FROM teams ORDER BY teamID';
$statement2 = $db->prepare($queryAllTeams);
$statement2->execute();
$teams = $statement2->fetchAll();
$statement2->closeCursor();


/* Get all players
$queryAllTeams = 'SELECT * FROM players INNER JOIN teams on teams.teamID = players.teamID';
$statement2 = $db->prepare($queryAllTeams);
$statement2->execute();
$players = $statement2->fetchAll();
$statement2->closeCursor();
*/

/* Get all player and team data
$queryPlayers = 'SELECT * FROM players INNER JOIN teams on teams.teamID = players.teamID WHERE teamID = :team_id ORDER BY playerID';
$statement3 = $db->prepare($queryPlayers);
$statement3->bindValue(':team_id', $team_id);
$statement3->execute();
$teamPlayers = $statement3->fetchAll();
$statement3->closeCursor();
*/

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
		<h1>Little League Teams</h1>
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
					<th>Team ID</th>
					<th>Team Name</th>
					<th>Mascot</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				</tr>
				
				<?php foreach ($teams as $team) : ?>
				<tr>
					<td><?php echo $team['teamID']; ?></td>
					<td><?php echo $team['name']; ?></td>
					<td><?php echo $team['mascot']; ?></td>
					<td><form action="delete_team.php" method="post">
							<input type="hidden" name="team_id" value="<?php echo $team['teamID']; ?>">
							<input type="submit" value="Delete">
						</form>
					</td>
					<td><form action="update_team_form.php" method="post">
							<input type="hidden" name="team_id" value="<?php echo $team['teamID']; ?>">
							<input type="hidden" name="team_name" value="<?php echo $team['name']; ?>">
							<input type="hidden" name="mascot" value="<?php echo $team['mascot']; ?>">
							<input type="submit" value="Update">
						</form>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			
			<p><a href="add_team_form.php">Add a team</a></p>
							
		</section>
	</main>
	<footer></footer>
	</body>
</html>