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
	$age = $_POST['age'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "select P.num_personne from Personne P where P.nom = '$nom' and P.prenom = '$prenom' and P.num_personne <> $num";
	$result = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	if($tuple) {
		$result->close();	
		$link->close();
		header("Location: personne.php?modif=1&nom=$nom&prenom=$prenom#resultat");
		exit();
	}
	
	$query = "update Personne set nom = '$nom', prenom = '$prenom', age = $age where num_personne = $num;";
	if(!$link->query($query)) {
		$result->close();	
		$link->close();
		header("Location: personne.php?modif=1&nom=$nom&prenom=$prenom#resultat");
		exit();
	}
	else {
		$result->close();	
		$link->close();
		header("Location: personne.php#resultat");
		exit();
	}
?>
