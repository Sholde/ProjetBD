<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$age = $_POST['age'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "select P.num_personne as num from Personne P where P.nom = '$nom' and P.prenom = '$prenom'";
	$result = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	if($tuple) {
		$result->close();
		$link->close();
		header("Location: personne.php?inser=1&nom=$nom&prenom=$prenom#inserer");
		exit();
	}
	
	$query = "select max(P.num_personne) as num from Personne P";
	$result = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	if(!$tuple)
		die("erreur select");
	$num = $tuple->num + 1;
	
	$query = "insert into Personne values ($num, '$nom', '$prenom', $age);";
	if(!$link->query($query)) {
		$result->close();
		$link->close();
		header("Location: personne.php?inser=1&nom=$nom&prenom=$prenom#inserer");
		exit();
	}
	else {
		$result->close();
		$link->close();
		header("Location: personne.php#inserer");
		exit();
	}
?>
