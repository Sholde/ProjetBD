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
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "delete from Personne where num_personne = $num;";
	$link->query($query) or die("erreur delete");
	
	header("Location: personne.php");
	exit();
?>
