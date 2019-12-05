<?php
	
	print "<html><head><title>Film</title></head><body>";
	
	/* variable */
	$num = $_GET['num'];
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select * from Film where num_film = $num;";
	$result = $link->query($query) or die("erreur select");
	
	$tuple = mysqli_fetch_object($result);
	
	print "
		$tuple->nom<br>
		$tuple->genre<br>
		$tuple->duree minutes<br>
		$tuple->origine<br>
		$tuple->version_disponible<br>
		<a href=\"projection_film.php?num_film=$num\">Voir les projections</a>
	";
	
	$result->close();
	$link->close();
	
	print "</body></html>";
?>
