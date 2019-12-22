<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	if(!isset($_POST['num_film']))  {
		header("Location: film.php");
		exit();
	}
	
	$num_film = $_POST['num_film'];
	$nom = $_POST['nom'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "delete from Film where num_film = $num_film;";
	if(!$link->query($query)) {
		$link->close();
		header("Location: film.php?suppr=1&nom=$nom#resultat");
		exit();
	}
	
	$query = "update Film set num_film = num_film - 1 where num_film > $num_film;";
	if(!$link->query($query)) {
		$link->close();
		header("Location: film.php#resultat");
		exit();
	}
	
	$link->close();
	header("Location: film.php#resultat");
	exit();
?>
