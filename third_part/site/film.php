<?php
	print "<html><head><title>Film</title></head><body>";
	
	$film = $_POST['num_film'];
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select f.num_film, f.nom, f.genre from Film f where f.num_film = $film;";
	$result = $link->query($query) or die("erreur select");
	
	print "<table>";
	while ($tuple = mysqli_fetch_object($result)){ 
		print "	<tr>
						<td><a href=\"film.php\" name=\"$tuple->num_film\">$tuple->nom</a></td>
						<td>$tuple->genre</td>
						</tr>";
	}
	print "</table>";
	
	$link->close();
	
	print "</body></html>";
?>
