<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	$nom = $_POST['nom'];
	$genre = $_POST['genre'];
	$duree = $_POST['duree'];
	$origine = $_POST['origine'];
	$version = $_POST['version'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "select F.num_film as num from Film F where F.nom = '$nom';";
	$result = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	if($tuple) {
		$result->close();
		$link->close();
		header("Location: film.php?inser=1&nom=$nom#inserer");
		exit();
	}
	
	$query = "select max(F.num_film) as num from Film F;";
	$result = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	if(!$tuple)
		die("erreur select");
	$num = $tuple->num + 1;
	
	$query = "insert into Film values ($num, '$nom', '$genre', $duree, '$origine', '$version');";
	if(!$link->query($query)) {
		$result->close();
		$link->close();
		header("Location: film.php?inser=1&nom=$nom#inserer");
		exit();
	}
	
	header("Location: film.php#inserer");
	exit();
?>
