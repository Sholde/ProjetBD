<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	if(!isset($_GET['num']))  {
		header("Location: personne.php");
		exit();
	}
	
	$ancien_num = $_GET['num'];
	
	$num = $_POST['num'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$age = $_POST['age'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "update Personne set num_personne = $num, nom = '$nom', prenom = '$prenom', age = $age where num_personne = $ancien_num;";
	if(!$link->query($query)) {
		header("Location: personne.php?modif=1&num=$ancien_num");
		exit();
	}
	
	header("Location: personne.php");
	exit();
?>
