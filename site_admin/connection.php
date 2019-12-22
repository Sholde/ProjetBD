<?php
	$id  = $_POST['id'];
	$mdp = $_POST['mdp'];
			
	if($id != "Admin") {
		header("Location: se_connecter.php?erreur=1");
		exit();
	}
	
	$link = new mysqli("localhost", "Admin", $mdp);
	if($link->connect_errno) {
		$link->close();
		header("Location: se_connecter.php?erreur=1");
		exit();
	}
	
	session_start();
	$_SESSION['admin'] = 1;
	
	$link->close();
	header("Location: index.php");
	exit();
?>
