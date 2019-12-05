<?php
	
	if(!isset($_GET['nom'])) {
		header("Location: index.php");
		exit();
	}
	
	print "<html><head><title>Cinéma</title></head><body>";
	
	/* variable */
	$nom = $_GET['nom'];
	
	date_default_timezone_set('Europe/Paris');
	$jour = date('o-m-d H:m:s');
	echo "On est le $jour<br>";
	
	/* connexion serveur */
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	/* connexion bd */
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	print "
		<div>
			Liste des projections dans le cinéma $nom
		</div>
	";
		
	$query = "Select F.*, S.* from Cinema C, Film F, Se_joue_dans S where S.num_film = F.num_film and S.nom_du_cinema = C.nom and C.nom = '$nom';";
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
