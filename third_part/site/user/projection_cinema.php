<?php
	
	if(!isset($_GET['nom'])) {
		header("Location: index.php");
		exit();
	}
	
	print "<html><head><title>Cinéma</title></head><body>";
	print "<h1><a href=\"index.php\">Réserve TA Place</a></h1>";
	
	/* variable */
	$nom = $_GET['nom'];
	
	date_default_timezone_set('Europe/Paris');
	$jour = date('o-m-d H:m:s');
	echo "On est le $jour<br><br>";
	
	/* connexion serveur */
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	/* connexion bd */
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	print "
		<div>
			Liste des projections dans le cinéma $nom :
		</div>
		<br>
	";
		
	$query = "Select * from Cinema C, Film F, Se_joue_dans J, Salle S where S.nom_du_cinema = C.nom and S.nom_du_cinema = J.nom_du_cinema and S.num_salle = J.num_salle and J.num_film = F.num_film and J.nom_du_cinema = C.nom and C.nom = '$nom';";
	$result = $link->query($query) or die("erreur select");
	
	/* affiche les films disponnible dans ce cinema */
	while($tuple = mysqli_fetch_object($result)) {
		$array = explode(" ",$tuple->jour);
		print "
			<a href=\"film.php?num_film=$tuple->num_film\">$tuple->nom</a><br>
			$tuple->genre<br>
			$tuple->duree<br>
			$tuple->origine<br>
			date: $array[0]<br>
			heure: $array[1]<br>
			Au cinéma <a href=\"cinema.php?nom=$tuple->nom_du_cinema\">$tuple->nom_du_cinema</a> à $tuple->ville<br>
			<a href=\"formulaire_reserve.php?num_se_joue=$tuple->num_se_joue&num_film=$tuple->num_film\">Réserver</a><br>
			<br>
		";
	}
	
	$link->close();
	
	print "</body></html>";
?>
