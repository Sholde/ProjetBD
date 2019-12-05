<?php
	print "<html><head><title>Test Connexion</title></head><body>";
	
	$vid = $_POST['vid'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$pw = $_POST['pw'];
	
	$link = new mysqli("localhost", "user", "user");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('bdphp') or die("Erreur de selection de la BD: " . $link->error);
	print "connexion ok<br>";
	
	$query = "INSERT INTO votants VALUES ($vid, '$nom', '$prenom', '$pw');";
	$link->query($query) or print "erreur insert";

	$link->close();
	print "<a href=\"index.html\">acceuil</a><br>";
	print "<a href=\"insert_votant.html\">retour</a>";
	print "</body></html>";
?>
