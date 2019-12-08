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
	
	$num_film = $_POST['num_film'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "delete from Film where num_film = $num_film";
	$link->query($query) or die("erreur delete");
	
	header("Location: film.php");
	exit();
?>
