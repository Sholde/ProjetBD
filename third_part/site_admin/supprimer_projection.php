<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	if(!isset($_POST['num']))  {
		header("Location: projection.php#resultat");
		exit();
	}
	
	$num = $_POST['num'];
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "delete from Se_joue_dans where num_se_joue = $num;";
	$link->query($query) or die("erreur delete");
	
	$link->close();
	header("Location: projection.php#resultat");
	exit();
?>
