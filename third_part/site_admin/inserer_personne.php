<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	$num = $_POST['num'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$age = $_POST['age'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "insert into Personne values ($num, '$nom', '$prenom', $age);";
	if(!$link->query($query)) {
		header("Location: personne.php?inser=1&num=$num");
		exit();
	}
	
	header("Location: personne.php");
	exit();
?>
