<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	if(!isset($_POST['num']))  {
		header("Location: personne.php");
		exit();
	}
	
	$num = $_POST['num'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "delete from Personne where num_personne = $num;";
	if(!$link->query($query)) {
		$link->close();
		header("Location: personne.php?suppr=1&nom=$nom&prenom=$prenom#resultat");
		exit();
	}
	
	$query = "update Personne set num_personne = num_personne - 1 where num_personne > $num;";
	if(!$link->query($query)) {
		$link->close();
		header("Location: personne.php#resultat");
		exit();
	}
	
	$link->close();
	header("Location: personne.php#resultat");
	exit();
?>
