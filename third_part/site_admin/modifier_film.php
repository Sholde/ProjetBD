<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	if(!isset($_GET['num_film']))  {
		header("Location: film.php");
		exit();
	}
	
	$ancien_num = $_GET['num_film'];
	
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
	
	$query = "update Film set num_film = $num_film, nom = '$nom', genre = '$genre', duree = $duree, origine = '$origine', version_disponible = '$version' where num_film = $ancien_num;";
	if(!$link->query($query)) {
		header("Location: film.php?modif=$ancien_num");
		exit();
	}
	
	header("Location: film.php");
	exit();
?>
