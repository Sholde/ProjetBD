<?php

	session_start();
	if(!isset($_SESSION['session'])) {
		header("Location: se_connecter.php");
		exit();
	}
	
	/* variable */
	$num_se_joue = $_POST['num_se_joue'];
	$num_film = $_POST['num_film'];
	$num_client = $_POST['num_client'];
	$prix = $_POST['prix'];
	$nb_place = $_POST['nb_place'];
	$tmp = $nb_place;
	
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "select max(num_veut_voir) as nb from Veut_voir";
	$result = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	$max = $tuple->nb + 1;
	
	while($nb_place > 0) {
		$query = "insert into Veut_voir value ($max, $num_se_joue, $num_client, $num_film, $prix);";
		$link->query($query) or die("erreur insert");
		$nb_place--;
		$max++;
	}
	
	print "Place acheté : $tmp";
	
	$result->close();
	$link->close();
?>
