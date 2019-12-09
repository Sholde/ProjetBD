<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	if(!isset($_GET['nom']))  {
		header("Location: cinema.php");
		exit();
	}
	
	$ancien_nom = $_GET['nom'];
	
	$nom = $_POST['nom'];
	$compagnie = $_POST['compagnie'];
	$ville = $_POST['ville'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "update Cinema set nom = '$nom', compagnie = '$compagnie', ville = '$ville' where nom = '$ancien_nom';";
	if(!$link->query($query)) {
		header("Location: cinema.php?modif=$ancien_nom");
		exit();
	}
	
	header("Location: cinema.php");
	exit();
?>
