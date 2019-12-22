<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	$jour = $_POST['jour'];
	$heure = $_POST['heure'];
	$version = $_POST['version'];
	$nom_film = $_POST['nom_film'];
	$num_salle = $_POST['num_salle'];
	$nom_cinema = $_POST['nom_cinema'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "insert into Se_joue_dans values (?, '$jour', '$heure', $duree, '$version', ?,'$num_salle','$nom_cinema');";
	if(!$link->query($query)) {
		header("Location: projection.php?inser=$num_se_joue_");
		exit();
	}
	
	header("Location: film.php");
	exit();
?>
