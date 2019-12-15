<?php

	session_start();
	if(!isset($_SESSION['session'])) {
		header("Location: se_connecter.php");
		exit();
	}
	
	/* variable */
	$num_film = $_POST['num_film'];
	$note = $_POST['note'];
	$email_client = $_SESSION['session'];
	
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "SELECT * from Clients where email = '$email_client';";
	$result = $link->query($query) or die("erreur select email");
	$tuple = mysqli_fetch_object($result);
	$num_client = $tuple->num_client;
	
	$query = "SELECT * from Clients C, Note N where N.num_client = $num_client and C.num_client = $num_client and N.num_film = $num_film;";
	$result = $link->query($query) or die("erreur select");
	
	$tuple = mysqli_fetch_object($result);
	
	if($tuple) {
		$query = "update Note set note = $note where num_client = $num_client and num_film = $num_film;";
		$link->query($query) or die("erreur update");
	}
	else {
		$query = "insert into Note value ($num_client, $num_film, $note);";
		$link->query($query) or die("erreur insert");
	}
	$result->close();
	$link->close();
	
	header("Location: film.php?num_film=$num_film");
	exit();
?>
