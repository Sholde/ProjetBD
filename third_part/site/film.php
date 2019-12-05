<?php
	if(!isset($_GET['num_film'])) {
		header("Location: index.php");
		exit();
	}
	
	print "<html><head><title>Film</title></head><body>";
	
	$num_film = $_GET['num_film'];
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select * from Film F, Se_joue_dans J where J.num_film = F.num_film and F.num_film = $num_film;";
	$result = $link->query($query) or die("erreur select");
	
	/* affiche les films disponnible dans ce cinema */
	while($tuple = mysqli_fetch_object($result)) {
		print "
			<a href=\"formulaire_reserve.php?num_se_joue=$tuple->num_se_joue&num_film=$tuple->num_film\">
				$tuple->nom<br>
				$tuple->genre<br>
				$tuple->duree<br>
				$tuple->origine<br>
				date: $tuple->jour<br>
				heure: $tuple->heure<br>
				<br>
			</a>
		";
	}
	
	$link->close();
	
	print "</body></html>";
?>
