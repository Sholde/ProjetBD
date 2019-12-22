<?php
	
	session_start();
	if(!isset($_SESSION['session'])) {
		header("Location: index.php");
		exit();
	}
	
	unset($_SESSION['session']);
	session_destroy();
	
	header("Location: index.php");
	exit();
?>
