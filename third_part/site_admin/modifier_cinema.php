<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	$ancien_nom = $_POST['ancien_nom'];	
	$nom = $_POST['nom'];
	$compagnie = $_POST['compagnie'];
	$ville = $_POST['ville'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "select C.nom from Cinema C where C.nom = '$nom' and C.nom <> '$ancien_nom'";
	$result = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	if($tuple) {
		$result->close();	
		$link->close();
		header("Location: cinema.php?modif=1&nom=$nom#resultat");
		exit();
	}
	
	$query = "update Cinema set nom = '$nom', compagnie = '$compagnie', ville = '$ville' where nom = '$ancien_nom';";
	if(!$link->query($query)) {
		$result->close();	
		$link->close();
		header("Location: cinema.php?modif=1&nom=$nom#resultat");
		exit();
	}
	
	$result->close();	
	$link->close();
	header("Location: cinema.php#resultat");
	exit();
?>
