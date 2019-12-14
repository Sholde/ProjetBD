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
	
	print "<html><head><title>Réserve</title> <link rel=\"stylesheet\" href=\"../css/input.css\"></head><body>";
	
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
	
	$query = "SELECT * from Clients where email = '$email_client';";
	$result = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	$num_client = $tuple->num_client;
	
	$query = "Select S.nb_de_place-count(V.num_veut_voir) as nb from Veut_voir V, Salle S where V.num_se_joue = $num_se_joue;";
	$res_nb_place = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($res_nb_place);
	$nb_place = $tuple->nb;
	
	$query_se_joue = "Select * from Se_joue_dans J, Salle S where S.num_salle = J.num_salle and S.nom_du_cinema = J.nom_du_cinema and J.num_se_joue = $num_se_joue;";
	$se_joue = $link->query($query_se_joue) or die("erreur select");
	
	$query_film = "Select * from Film where num_film = $num_film;";
	$film = $link->query($query_film) or die("erreur select");
	
	$query_client = "Select * from Clients where email = '$email_client';";
	$client = $link->query($query_client) or die("erreur select");
	print "	<div class = \"contenu\">";
	print "<form method=\"POST\" action=\"reserve.php\">";
	print "<input type=\"text\" name=\"num_se_joue\" value=\"$num_se_joue\" hidden>";
	print "<input type=\"text\" name=\"num_film\" value=\"$num_film\" hidden>";
	print "<input type=\"text\" name=\"num_client\" value=\"$num_client\" hidden>";
	print "<table>";
	$tuple = mysqli_fetch_object($film);
	print "
		<tr>
		<td>Nom du film : </td>
		<td><input type=\"text\" value=\"$tuple->nom\" readonly></td>
		</tr>
	";
	$tuple = mysqli_fetch_object($se_joue);
	print "
		<tr>
		<td>Cinéma : </td>
		<td><input type=\"text\" value=\"$tuple->nom_du_cinema\" readonly></td>
		</tr>
		<tr>
		<td>Ville : </td>
		<td><input type=\"text\" value=\"$tuple->ville\" readonly></td>
		</tr>
		<tr>
		<td>Salle : </td>
		<td><input type=\"text\" value=\"$tuple->num_salle\" readonly></td>
		</tr>
		<tr>
		<td>Jour : </td>
		<td><input type=\"text\" value=\"$tuple->jour\" readonly></td>
		</tr>
		<tr>
		<td>heure : </td>
		<td><input type=\"text\" value=\"$tuple->heure\" readonly></td>
		</tr>
	";
	$tuple = mysqli_fetch_object($client);
	if($tuple->reduction) {
		print "
			<tr>
			<td>Prix : </td>
			<td><input type=\"text\" value=\"5\" name=\"prix\" readonly></td>
			</tr>
		";
		}
	else {
		print "
			<tr>
			<td>Prix : </td>
			<td><input type=\"text\" value=\"6\" name=\"prix\" readonly></td>
			</tr>
		";
	}
	
	if($nb_place > 0) {
		print "
		<tr>
		<td>Nb place : </td>
		<td><input type=\"number\" value=\"1\" min=\"1\" max=\"$nb_place\" name=\"nb_place\"></td>
		</tr>
		";
	}
	else {
		print "
		<tr>
		<td>Nb place : </td>
		<td><input type=\"number\" value=\"0\" min=\"0\" max=\"0\" name=\"nb_place\"></td>
		</tr>
		";
	}
	print "</table>";
	print "<input type=\"submit\" value=\"valider\">";
	print "<a href=\"index.php\">annuler</a>";
	print "</form>";
	print "</div>";
	$link->close();
	
	print "</body></html>";
?>
