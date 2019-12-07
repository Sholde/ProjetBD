<?php

	session_start();
	if(!isset($_SESSION['session'])) {
		header("Location: se_connecter.php");
		exit();
	}
	
	print "<html><head><title>Film</title></head><body>";
	
	/* variable */
	$num_film = $_GET['num_film'];
	$email_client = $_SESSION['session'];
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "SELECT * from Clients where email = '$email_client';";
	$result = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	$num_client = $tuple->num_client;
	
	$query = "SELECT * from Film where num_film = $num_film;";
	$result = $link->query($query) or die("erreur select");
	
	$tuple = mysqli_fetch_object($result);
	
	print "<form method=\"POST\" action=\"noter.php\">";
	print "<input type=\"text\" name=\"num_film\" value=\"$tuple->num_film\" hidden>";
	print "<table>";
	print "
		<tr>
		<td>Nom du film : </td>
		<td><input type=\"text\" name=\"nom_du_film\" value=\"$tuple->nom\" readonly></td>
		</tr>
	";
	
	$query = "SELECT * from Note N, Film F where N.num_client = $num_client and N.num_film = $num_film and F.num_film = $num_film;";
	$result = $link->query($query) or die("erreur select");
	
	$tuple = mysqli_fetch_object($result);
	if($tuple) {
		print "
		<tr>
		<td>Note : </td>
		<td><input type=\"number\" name=\"note\" value=\"$tuple->note\" min=\"0\" max=\"5\"></td>
		</tr>
	";
	}
	else {
		print "
		<tr>
		<td>Note : </td>
		<td><input type=\"number\" name=\"note\" value=\"0\" min=\"0\" max=\"5\"></td>
		</tr>
	";
	}
	print "</table>";
	print "<input type=\"submit\" value=\"valider\">";
	print "</form>";
	
	$result->close();
	$link->close();
	
	print "</body></html>";
?>
