<?php
	header("Location: index.php");
	
	$email = $_POST['email'];
	$mdp = $_POST['mdp'];
	
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select num_client from Clients where email like '$email' and mot_de_passe = '$mdp';";
	$result = $link->query($query) or die("erreur select");
	
	if(!$result)
	{
		die("email ou mot de passe incorrect<br><a href=\"se_connecter.php\">Se connecter</a");
	}
	
	$link->close();
	
	session_start();
	$_SESSION['session'] = "client";
	
	exit();
?>

