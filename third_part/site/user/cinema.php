<?php
	
	print "<html><head><title>Cinéma</title></head><body>";
	print "<h1><a href=\"index.php\">Réserve TA Place</a></h1>";
	
	/* variable */
	$nom = $_GET['nom'];
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select C.*, S.*, count(S.num_salle) as nb from Cinema C, Salle S where C.nom = S.nom_du_cinema and C.nom = '$nom';";
	$result = $link->query($query) or die("erreur select");
	
	$tuple = mysqli_fetch_object($result);
	
	print "
		$tuple->nom<br>
		$tuple->compagnie<br>
		$tuple->ville<br>
		nb salle : $tuple->nb<br>
		<a href=\"projection_cinema.php?nom=$tuple->nom\">Voir les projections</a>
	";
	
	$result->close();
	$link->close();
	
	print "</body></html>";
?>
