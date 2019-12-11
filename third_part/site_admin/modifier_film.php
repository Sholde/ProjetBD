<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	if(!isset($_POST['num_film']))  {
		header("Location: film.php");
		exit();
	}
	
	$num = $_POST['num_film'];
	
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
	
	$query = "select F.num_film from Film F where F.nom = '$nom' and F.num_film <> $num";
	$result = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	if($tuple) {
		$result->close();	
		$link->close();
		header("Location: film.php?modif=1&nom=$nom#resultat");
		exit();
	}
	
	$query = "update Film set nom = '$nom', genre = '$genre', duree = $duree, origine = '$origine', version_disponible = '$version' where num_film = $num;";
	if(!$link->query($query)) {
		$result->close();	
		$link->close();
		header("Location: film.php?modif=1&nom=$nom#resultat");
		exit();
	}
	
	$result->close();	
	$link->close();
	header("Location: film.php#resultat");
	exit();
?>
