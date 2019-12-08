<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	if(!isset($_GET['num_client']))  {
		header("Location: client.php");
		exit();
	}
	
	$ancien_num = $_GET['num_client'];
	
	$num_client = $_POST['num_client'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];
	$mdp = $_POST['mdp'];
	$reduc = $_POST['reduc'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "update Clients set num_client = $num_client, nom = '$nom', prenom = '$prenom', email = '$email', mot_de_passe = '$mdp', reduction = $reduc where num_client = $ancien_num;";
	if(!$link->query($query)) {
		header("Location: client.php?modif=$ancien_num");
		exit();
	}
	
	header("Location: client.php");
	exit();
?>
