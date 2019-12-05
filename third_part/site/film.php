<?php
	print "<html><head><title>Film</title></head><body>";
	
	$film = $_GET['num_film'];
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select f.num_film, f.nom, f.genre, f.duree, f.origine,f.version_disponible from Film f where f.num_film = $film;";
	$result = $link->query($query) or die("not exist in data base ");
	
	print "<table>";
	while ($tuple = mysqli_fetch_object($result)){ 
		print "	<tr>
						<td> $tuple->nom </td>
						</tr>
						<tr>
						<td>genre: $tuple->genre - origine: $tuple->origine - duree: $tuple->duree - version: $tuple->version_disponible</td>
						</tr>";
	}
	print "</table>";
	
	$link->close();
	
	print "</body></html>";
?>
