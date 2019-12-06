<?php
	
	session_start();
	if(!isset($_SESSION['session'])) {
		header("Location: se_connecter.php");
		exit();
	}
	
	/* connexion serveur */
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	/* data base */
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query_client = "Select num_client from Clients where email = '$email_client';";
	$result = $link->query($query_client) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	
	/* variable */
	$note_film = $_POST['note'];
	$num_film = $_POST['numero_film'];
	
	$query_insert = "INSERT INTO Note VALUES ($tuple->num_client,$num_film,$note_film);";
	$result = $link->query($query_insert) or die(header("Location:film.php?num_film=$num_film")); // A changer := sinon 

	$link->close();
	header("Location:film.php?num_film=$num_film");
	exit();
?>
