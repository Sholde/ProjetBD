<?php
	print "<html><head><title>Film</title></head><body>";
	
	$film = $_GET['num_film'];
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query  = "SELECT f.nom, avg(n.note) AS moyenne,COUNT(n.num_client) AS nb_note,f.origine,f.duree,f.version_disponible,f.genre FROM Note n,Film f WHERE f.num_film = $film and n.num_film = $film;";
	
	$query2 = "select f_prec.nom as nom_film1, f_suiv.nom as nom_film2
						    from Film f_prec, Film f_suiv, Suit s
						    where f_prec.num_film = s.num_film_prec and f_suiv.num_film = s.num_film_suiv;";
	
	$film_liee = $link->query($query2) or die("not exist in data base");		    
	$result    = $link->query($query) or die("not exist in data base ");
	
	print "<table>";
	while ($tuple = mysqli_fetch_object($result)){ 
		print "	<tr>
						<td> $tuple->nom </td>
						</tr>
						<tr>
						<td>genre: $tuple->genre - origine: $tuple->origine - duree: $tuple->duree - version: $tuple->version_disponible</td>
						</tr>
						<tr>
						<td>Note du film:$tuple->moyenne - Nombre de votes: $tuple->nb_note</td>
						</tr>";
	while ($tuple2 = mysqli_fetch_object($film_liee)){ 
		print " <tr>
						<td> $tuple2->nom_film1 </td>
						<td> $tuple2->nom_film2 </td>
						</tr>";				
	}
	}
	print "</table>";
	
	$link->close();
	
	print "</body></html>";
?>
