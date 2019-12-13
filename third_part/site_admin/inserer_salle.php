<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	$nom = $_POST['nom'];
	$nb_place = $_POST['nb_place'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "select max(num_salle) as num from Salle where nom_du_cinema = '$nom';";
	$result = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	if(!$tuple) {
		$num = 1;
	}
	else
		$num = $tuple->num + 1;
	
	$query = "insert into Salle values ($num, '$nom', $nb_place);";
	if(!$link->query($query)) {
		header("Location: salle.php?inser=1&num=$num&nom=$nom");
		exit();
	}
	
	header("Location: salle.php");
	exit();
?>
