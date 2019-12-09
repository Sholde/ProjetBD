<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	if(!isset($_POST['num_film']) or !isset($_POST['num_client']))  {
		header("Location: note.php");
		exit();
	}
	
	$num_film = $_POST['num_film'];
	$num_client = $_POST['num_client'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "delete from Note where num_film = $num_film and num_client = $num_client";
	$link->query($query) or die("erreur delete");
	
	header("Location: note.php");
	exit();
?>
