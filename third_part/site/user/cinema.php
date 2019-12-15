<?php
	
	print "<html><head><title>Cinéma</title> 	<link rel=\"stylesheet\" href=\"../css/resultat.css\"> </head><body>";
	
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
	
	print "<div class=\"contenu\">";
	print "<div class=\"description\">";
	
	print "
		$tuple->nom<br>
		$tuple->compagnie<br>
		$tuple->ville<br>
		nb salle : $tuple->nb<br>
		</div>
		<div class=\"lien\">
		<a href=\"projection_cinema.php?nom=$tuple->nom\">Voir les projections</a><br>
	";
	print "<a href=\"liste_cinema.php\">Retour à la liste des films</a><br>";
	print "<a href=\"index.php\">Retour au menu principal</a>";
	print "</div>";
	print "</div>";
	
	print "<img height=\"400\" width = \"500\" src=\"../img/pathe_cine.jpg\"> ";
	
	$result->close();
	$link->close();
	
	print "</body></html>";
?>
