<?php
	print "<html><head><title>Test Connexion</title></head><body>";
	
	$cid = $_POST['rad'];
	$vid = $_POST['vid'];
	$pw = $_POST['pw'];
	
	$link = new mysqli("localhost", "user", "user");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('bdphp') or die("Erreur de selection de la BD: " . $link->error);
	print "connexion ok<br>";
	
	$query = "Select VotantId, Pass_word from votants where VotantId = $vid and Pass_word = '$pw';";
	$result = $link->query($query) or die("erreur select");
	print "acces ok<br>";
	
	$get_info = $result->fetch_row();
	if(!$get_info) {
		die("Le votant n'a pas été trouvé");
	}
	
	$query = "Select VotantId from vote where VotantId = $vid;";
	$result = $link->query($query) or die("erreur select");
	$get_info = $result->fetch_row();
	if($get_info) {
		die("déjà voté");
	}
	print "droit de vote ok<br>";
	
	$query = "insert into vote values ($vid, $cid);";
	$link->query($query) or die("erreur insert");
	
	$link->close();
	print "<a href=\"index.html\">acceuil</a><br>";
	print "<a href=\"formulaire_vote.php\">retour</a>";
	
	print "</body></html>";
?>
