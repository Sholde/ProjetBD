<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	if(!isset($_POST['num_personne']))  {
		header("Location: participe.php#resultat");
		exit();
	}
	
	$num_personne = $_POST['num_personne'];
	$num_film = $_POST['num_film'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "delete from Participe_au_film where num_personne = $num_personne and num_film = $num_film;";
	$link->query($query) or die("erreur delete");
	
	$link->close();
	header("Location: participe.php#resultat");
	exit();
?>
