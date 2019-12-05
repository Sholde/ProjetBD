<?php
	
	if(!isset($_GET['num'])) {
		header("Location: index.php");
		exit();
	}
	
	session_start();
	if(!isset($_SESSION['session'])) {
		header("Location: se_connecter.php");
		exit();
	}
	
	print "<html><head><title>Réserve</title></head><body>";
	
	/* variable */
	$num = $_GET['num'];
	
	/* connexion serveur */
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	/* connexion bd */
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select * from Se_joue_dans where num_se_joue = $num;";
	$result = $link->query($query) or die("erreur select");
	
	$tuple = mysqli_fetch_object($result);
	
	print "<form method=\"POST\" action=\"reserve\">";
	print "<table>";
	print "
		<tr>
		<td>Nom du film : </td>
		<td>$tuple->num_film</td>
		</tr>
	";
	print "</table>";
	print "</form>";
	
	$link->close();
	
	print "</body></html>";
?>
