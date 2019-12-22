<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	if(!isset($_POST['num_client']))  {
		header("Location: client.php");
		exit();
	}
	
	$num_client = $_POST['num_client'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "delete from Clients where num_client = $num_client";
	$link->query($query) or die("erreur delete");
	
	header("Location: client.php");
	exit();
?>
