<?php
	print "<html><head><title>Test Connexion</title></head><body>";
	
	$cid = $_POST['cid'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	
	$link = new mysqli("localhost", "user", "user");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('bdphp') or die("Erreur de selection de la BD: " . $link->error);
	print "connexion ok<br>";
	
	$query = "INSERT INTO candidats VALUES ($cid, '$nom', '$prenom');";
	$link->query($query) or print "erreur insert";

	$link->close();
	print "<a href=\"index.html\">acceuil</a><br>";
	print "<a href=\"insert_candidat.html\">retour</a>";
	print "</body></html>";
?>
