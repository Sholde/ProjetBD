<?php
	header("Location: index.php");
	
	session_start();
	unset($_SESSION['session']);
	session_destroy();
	
	exit();
?>
