<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	$nom_film = $_POST['nom_film'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$metier = $_POST['metier'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "select F.num_film from Film F where F.nom = '$nom_film'";
	$result = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	if(!$tuple) {
		$result->close();	
		$link->close();
		header("Location: participe.php?inser=1&erreur=film#inserer");
		exit();
	}
	$num_film = $tuple->num_film;
	
	$query = "select P.num_personne from Personne P where P.nom = '$nom' and P.prenom = '$prenom'";
	$result = $link->query($query) or die("erreur select");
	$tuple = $tuple = mysqli_fetch_object($result);
	if(!$tuple) {
		$result->close();	
		$link->close();
		header("Location: participe.php?inser=1&erreur=personne#inserer");
		exit();
	}
	$num_personne = $tuple->num_personne;
	
	$query = "insert into Participe_au_film values ($num_personne, $num_film, '$metier');";
	if(!$link->query($query)) {
		$result->close();	
		$link->close();
		header("Location: participe.php?inser=1&num_personne=$num_personne&num_film=$num_film#inserer");
		exit();
	}
	else {
		$result->close();
		$link->close();
		header("Location: participe.php#inserer");
		exit();
	}
?>
