<?php
	
	if(!isset($_GET['nom'])) {
		header("Location: index.php");
		exit();
	}
	
	print "<html><head><title>Cinéma</title> <link rel=\"stylesheet\" href=\"../css/liste.css\"> </head><body>";
	
	/* variable */
	$nom = $_GET['nom'];
	
	date_default_timezone_set('Europe/Paris');
	$jour = date('o-m-d H:m:s');
	echo " <h1>$jour</h1>";
	
	/* connexion serveur */
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	/* connexion bd */
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	print "
		<h1>
			Liste des projections dans le cinéma $nom
		</h1>
	";
		
	$query = "Select * from Cinema C, Film F, Se_joue_dans J, Salle S where S.nom_du_cinema = C.nom and S.nom_du_cinema = J.nom_du_cinema and S.num_salle = J.num_salle and J.num_film = F.num_film and J.nom_du_cinema = C.nom and C.nom = '$nom';";
	$result = $link->query($query) or die("erreur select");
	print "<div class=\"contenu\">";
	/* affiche les films disponnible dans ce cinema */
	while($tuple = mysqli_fetch_object($result)) {
		print "
			<ul class=\"text\">
			<a href=\"formulaire_reserve.php?num_se_joue=$tuple->num_se_joue&num_film=$tuple->num_film\">
			<li>$tuple->nom</li>
			<li>$tuple->genre</li>
			<li>$tuple->duree</li>
			<li>$tuple->origine</li>
			<li>date: $tuple->jour</li>
			<li>heure: $tuple->heure</li>
			<li>$tuple->nom_du_cinema à $tuple->ville</li>
			<li>Réserver </li></a>
			<br>
		";
	}
	print "</div>";
	$link->close();
	
	print "</body></html>";
?>
