<?php
	print "<html><head><title>Cinéma</title></head><body>";
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select C.*, S.ville, count(S.num_salle) as nb from Cinema C, Salle S where C.nom = S.nom_du_cinema group by C.nom;";
	$result = $link->query($query) or die("erreur select");
	
	print "<table>";
	while ($tuple = mysqli_fetch_object($result)){ 
		print "
			<tr>
			<td>$tuple->nom<br>
			$tuple->compagnie<br>
			$tuple->ville<br>
			nb salle : $tuple->nb
			</td>
			<td><a href=\"projection_cinema.php?nom=$tuple->nom\">Voir les projections</a></td>
			</tr>";
	}
	print "</table>";
	
	$link->close();
	
	print "</body></html>";
?>
