<?php
	if(!isset($_GET['num_film'])) {
		header("Location: index.php");
		exit();
	}
	
	print "<html><head><title>Film</title>
				<link rel=\"stylesheet\" href=\"../css/liste.css\">
				</head><body>";
	
	$num_film = $_GET['num_film'];
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select * from Film F, Se_joue_dans J, Salle S,Cinema C where S.nom_du_cinema= C.nom and S.nom_du_cinema = J.nom_du_cinema and S.num_salle = J.num_salle and J.num_film = F.num_film and F.num_film = $num_film;";
	$result = $link->query($query) or die("erreur select");
	
	$query = "Select nom as nom_film from Film F where F.num_film = $num_film;";
	$raw_film = $link->query($query) or die("erreur select");
	
	$tuple = mysqli_fetch_object($raw_film);
	print "
		<h1>
			Liste des projections du film $tuple->nom 
		</h1>
	";
	
	/* affiche les films disponnible dans ce cinema */
	print "<div class=\"contenu\">";
	while($tuple = mysqli_fetch_object($result)) {
		print "
			<ul class=\"text\">
			<a href=\"formulaire_reserve.php?num_se_joue=$tuple->num_se_joue&num_film=$tuple->num_film\">
				<li>$tuple->nom_du_cinema à $tuple->ville</li>
				<li>date: $tuple->jour</li>
				<li>heure: $tuple->heure</li>
				<li>Cette salle peut contenir jusqu'à $tuple->nb_de_place personnes</li>
				<li>Cliquer pour réserver</li>
			</ul></a>
		";
	}
	print "</div>";
	$result->close();
	$link->close();
	
	print "</body></html>";
?>
