<?php
	session_start();
	/* variable */
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];
	$mdp = $_POST['mdp'];
	$email_client = $_SESSION['session'];
	
	/* connexion serveur */
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	/* connexion bd */
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	/* requete qui renvoie le tuple du client avec l' email $email sauf l'ancien email du clients $email_client */
	$query = "Select * from Clients where email = '$email' and email <> '$email_client';";
	$result = $link->query($query) or die("erreur select");
	
	$tuple = mysqli_fetch_object($result);
	
	/* Si il n'y a pas de tuple */
	/* c-a-d qu' aucun client a l'addresse mail $email */
	if(!$tuple) {
		$query = "update Clients set nom = '$nom', prenom = '$prenom', email = '$email', mot_de_passe = '$mdp' where email = '$email_client';";
		$link->query($query) or die("erreur update");
		$_SESSION['session'] = $email;
	}
	else {
		header("Location: compte.php?not=1");
		exit();
	}
	
	$link->close();
	header("Location: compte.php");
	exit();
?>
