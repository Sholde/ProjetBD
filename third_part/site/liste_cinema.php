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
			<td>image cinema</td>
			<td><a href=\"cinema.php?nom=$tuple->nom\">$tuple->nom</a><br>$tuple->ville</td>
			</tr>
		";
	}
	print "</table>";
	
	$link->close();
	
	print "</body></html>";
?>
