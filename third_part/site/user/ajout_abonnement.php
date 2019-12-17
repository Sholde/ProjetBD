<?php
	session_start();
	if(!isset($_SESSION['session'])) {
		header("Location: se_connecter.php");
		exit();
	}
	
	$email = $_SESSION['session'];
	
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "update Clients set reduction = 1 where email = '$email';";
	$link->query($query) or die ("erreur");
	
	$link->close();
	
	header("Location: compte.php");
	exit();
?>
