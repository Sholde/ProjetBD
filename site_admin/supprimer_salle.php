<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	if(!isset($_POST['num']))  {
		header("Location: salle.php");
		exit();
	}
	
	$num = $_POST['num'];
	$nom = $_POST['nom'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "delete from Salle where num_salle = $num and nom_du_cinema = '$nom';";
	$link->query($query) or die("erreur delete");
	
	header("Location: salle.php");
	exit();
?>
