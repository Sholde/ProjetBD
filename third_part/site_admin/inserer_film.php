<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	$num_film = $_POST['num_film'];
	$nom = $_POST['nom'];
	$genre = $_POST['genre'];
	$duree = $_POST['duree'];
	$origine = $_POST['origine'];
	$version = $_POST['version'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "insert into Film value($num_film, '$nom', '$genre', $duree, '$origine', '$version');";
	if(!$link->query($query)) {
		header("Location: film.php?inser=$num_film");
		exit();
	}
	
	header("Location: film.php");
	exit();
?>
