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
	
	$query = "Select nom from Film F where F.num_film = $num_film;";
	$raw_film = $link->query($query) or die("erreur select");
	
	$tuple = mysqli_fetch_object($raw_film);
	print "
		<div>
			Liste des projections du film $tuple->nom
		</div>
	";
	
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
	
	$result->close();
	$link->close();
	
	print "</body></html>";
?>