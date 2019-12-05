<?php
	
	if(!isset($_GET['num_se_joue']) | !isset($_GET['num_film'])) {
		header("Location: index.php");
		exit();
	}
	
	session_start();
	if(!isset($_SESSION['session'])) {
		header("Location: se_connecter.php");
		exit();
	}
	
	print "<html><head><title>Réserve</title></head><body>";
	
	/* variable */
	$num_se_joue = $_GET['num_se_joue'];
	$num_film = $_GET['num_film'];
	$email_client = $_SESSION['session'];
	
	/* connexion serveur */
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	/* connexion bd */
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query_se_joue = "Select * from Se_joue_dans J, Salle S where S.num_salle = J.num_salle and S.nom_du_cinema = J.nom_du_cinema and J.num_se_joue = $num_se_joue;";
	$se_joue = $link->query($query_se_joue) or die("erreur select");
	
	$query_film = "Select * from Film where num_film = $num_film;";
	$film = $link->query($query_film) or die("erreur select");
	
	$query_client = "Select * from Clients where email = '$email_client';";
	$client = $link->query($query_client) or die("erreur select");
	
	print "<form method=\"POST\" action=\"reserve\">";
	print "<table>";
	$tuple = mysqli_fetch_object($film);
	print "
		<tr>
		<td>Nom du film : </td>
		<td>$tuple->nom</td>
		</tr>
	";
	$tuple = mysqli_fetch_object($se_joue);
	print "
		<tr>
		<td>Cinéma : </td>
		<td>$tuple->nom_du_cinema</td>
		</tr>
		<tr>
		<td>Ville : </td>
		<td>$tuple->ville</td>
		</tr>
		<tr>
		<td>Salle : </td>
		<td>$tuple->num_salle</td>
		</tr>
		<tr>
		<td>Jour : </td>
		<td>$tuple->jour</td>
		</tr>
		<tr>
		<td>heure : </td>
		<td>$tuple->heure</td>
		</tr>
	";
	$tuple = mysqli_fetch_object($client);
	if($tuple->reduction) {
		print "
			<tr>
			<td>Prix : </td>
			<td>5</td>
			</tr>
		";
		}
	else {
		print "
			<tr>
			<td>Prix : </td>
			<td>6</td>
			</tr>
		";
	}
	print "</table>";
	print "</form>";
	
	$link->close();
	
	print "</body></html>";
?>
