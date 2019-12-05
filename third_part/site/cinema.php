<?php
	
	if(!isset($_GET['nom'])) {
		header("Location: index.php");
		exit();
	}
	
	print "<html><head><title>Cinéma</title></head><body>";
	
	/* variable */
	$nom = $_GET['nom'];
	
	/* connexion serveur */
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	/* connexion bd */
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select C.*, S.ville, count(S.num_salle) as nb from Cinema C, Salle S where C.nom = S.nom_du_cinema and C.nom = '$nom';";
	$result = $link->query($query) or die("erreur select");
	
	$tuple = mysqli_fetch_object($result);
	
	if($tuple) {
		print "	$tuple->nom<br>
						$tuple->compagnie<br>
						$tuple->ville<br>
						nb salle : $tuple->nb
		";
	}
	
	$link->close();
	
	print "</body></html>";
?>
