<?php
	$id  = $_POST['id'];
	$mdp = $_POST['mdp'];
			
	if($id != "Admin" || $mdp != "admin") {
		header("Location: se_connecter.php?erreur=1");
		exit();
	}
	
	session_start();
	$_SESSION['admin'] = 1;
	
	header("Location: index.php");
	exit();
?>
