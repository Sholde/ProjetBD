<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	$nom = $_POST['nom'];
	$compagnie = $_POST['compagnie'];
	$ville = $_POST['ville'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "insert into Cinema values ('$nom', '$compagnie', '$ville');";
	if(!$link->query($query)) {
		header("Location: cinema.php?inser=$nom");
		exit();
	}
	
	header("Location: cinema.php");
	exit();
?>
