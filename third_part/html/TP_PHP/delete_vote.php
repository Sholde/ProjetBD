<?php
	print "<html><head><title>Test Connexion</title></head><body>";

	$link = new mysqli("localhost", "user", "user");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('bdphp') or die("Erreur de selection de la BD: " . $link->error);
	print "connexion ok<br>";
	
	$query = "DELETE FROM vote";
	$link->query($query) or print "erreur delete";

	$link->close();
	print "<a href=\"index.html\">acceuil</a></body></html>";
?>
