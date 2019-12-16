<?php
	session_start();
	if(!isset($_SESSION['session'])) {
		header("Location: se_connecter.php");
		exit();
	}
	$email_client = $_SESSION['session'];
	
	print "<html><head><title>Réservation</title>
	<link rel=\"stylesheet\" href=\"../css/liste.css\">
	</head><body>";
	print "<h1 class=\"titre\"><a href=\"index.php\">Réserve TA Place</a></h1>";
	
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	date_default_timezone_set('Europe/Paris');
	$jour = date('Y-m-d H:i:s');
	
	$query = "Select C.*, V.*, J.*, F.nom as nom_film, count(J.num_se_joue) as nb_place from Clients C, Veut_voir V, Film F, Se_joue_dans J where C.email = '$email_client' and V.num_se_joue = J.num_se_joue and V.num_film = F.num_film and J.jour > '$jour' group by V.num_se_joue order by J.jour ASC;";
	$result = $link->query($query) or die("erreur select");
	
	print "<h4 class=\"res\"><a href=\"reservation_expirer.php\">réservation expiré</a></h4>";
	
	print "<h1>Réservation :</h1>";
	
	print "<div class=\"contenu\">";
	while($tuple = mysqli_fetch_object($result)) {
		$array = explode(" ",$tuple->jour);
		print "
				<a>
					<ul class=\"text\">
						<li><h3>$tuple->nom_film</h3></li>
						<li>Cinéma : $tuple->nom_du_cinema</li>
						<li>Numéro de la salle : $tuple->num_salle</li>
						<li>Date : $array[0]</li>
						<li>Heure : $array[1]</li>
						<li>Nb de place acheté : $tuple->nb_place</li>
					</ul>
				</a>
		";
	}
	print "</div>";
	
	$result->close();
	$link->close();
	
	print "</body></html>";
?>
