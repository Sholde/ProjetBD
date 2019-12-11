<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	if(!isset($_POST['nom']))  {
		header("Location: cinema.php#resultat");
		exit();
	}
	
	$nom = $_POST['nom'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "delete from Cinema where nom = '$nom';";
	if(!$link->query($query)) {
		$link->close();
		header("Location: cinema.php?suppr=1&nom=$nom#resultat");
		exit();
	}
	
	$link->close();
	header("Location: cinema.php#resultat");
	exit();
?>
