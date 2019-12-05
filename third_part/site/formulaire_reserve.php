<?php
	
	if(!isset($_GET['num_se_joue']) | !isset($_GET['num_film'])) {
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
	$num_se_joue = $_GET['num_se_joue'];
	$num_film = $_GET['num_film'];
	
	/* connexion serveur */
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	/* connexion bd */
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query_se_joue = "Select * from Se_joue_dans where num_se_joue = $num_se_joue;";
	$num_se_joue = $link->query($query_se_joue) or die("erreur select");
	
	$tuple = mysqli_fetch_object($num_se_joue);
	
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
