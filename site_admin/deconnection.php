<?php
	
	session_start();
	if(!isset($_SESSION['admin'])) {
		header("Location: index.php");
		exit();
	}
	
	unset($_SESSION['admin']);
	session_destroy();
	
	header("Location: se_connecter.php");
	exit();
?>
