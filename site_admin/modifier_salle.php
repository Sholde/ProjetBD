<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	if(!isset($_GET['num']))  {
		header("Location: salle.php");
		exit();
	}
	
	$ancien_num = $_GET['num'];
	$ancien_nom = $_GET['nom'];
	
	$num = $_POST['num'];
	$nom = $_POST['nom'];
	$nb_place = $_POST['nb_place'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "update Salle set num_salle = $num, nom_du_cinema = '$nom', nb_de_place = $nb_place where num_salle = $ancien_num and nom_du_cinema = '$ancien_nom';";
	if(!$link->query($query)) {
		header("Location: salle.php?modif=1&num=$ancien_num&nom=$ancien_nom");
		exit();
	}
	
	header("Location: salle.php");
	exit();
?>
