<?php
	
	$email = $_POST['email'];
	$mdp = $_POST['mdp'];
	
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select num_client from Clients where email = '$email' and mot_de_passe = '$mdp';";
	$result = $link->query($query) or die("erreur select");
	
	$tuple = mysqli_fetch_object($result);
	
	if(!$tuple)
	{
		header("Location: se_connecter.php?not=1");
		exit();
	}
	
	$link->close();
	
	session_start();
	$_SESSION['session'] = $email;
	
	header("Location: index.php");
	exit();
?>

