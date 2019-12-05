<?php
	print "<html><head><title>Film</title></head><body>";
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select f.num_film, f.nom, f.genre from Film f;";
	$result = $link->query($query) or die("erreur select");
	
	print "<table>";
	while ($tuple = mysqli_fetch_object($result)){ 
		print "
			<tr>
			<td><a href=\"film.php?num=$tuple->num_film\">$tuple->nom</a></td>
			<td><a href=\"projection_film.php?num_film=$tuple->num_film\">Voir les projection</td>
			</tr>";
	}
	print "</table>";
	
	$link->close();
	
	print "</body></html>";
?>
