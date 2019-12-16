<?php
	
	print "<html><head><title>Personne</title></head><body>";
	print "<h1><a href=\"index.php\">Réserve TA Place</a></h1>";
	
	$num = $_GET['num'];
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "SELECT P.*, PA.*, F.nom as nom_film FROM Personne P, Film F, Participe_au_film PA WHERE F.num_film = PA.num_film and PA.num_personne = $num and P.num_personne = $num;";
	$result = $link->query($query) or die("erreur select");
	
	print "<table>";
	$tuple = mysqli_fetch_object($result);
		print "	<tr>
						<td>Nom :</td>
						<td>$tuple->nom</td>
						</tr>
						<tr>
						<td>Prenom :</td>
						<td>$tuple->prenom</td>
						</tr>
						<tr>
						<td>Age :</td>
						<td>$tuple->age</td>
						</tr>
						<tr>
						<td>Metier :</td>
						<td>$tuple->metier</td>
						</tr>
						<tr>
						<td>Film :</td>
						<td>
						<ul>
		";
		
		$query = "SELECT P.*, PA.*, F.nom as nom_film FROM Personne P, Film F, Participe_au_film PA WHERE F.num_film = PA.num_film and PA.num_personne = $num and P.num_personne = $num;";
		$result = $link->query($query) or die("erreur select");
		while($tuple = mysqli_fetch_object($result)) {
			print " <li><a href=\"film.php?num_film=$tuple->num_film\">$tuple->nom_film</a>($tuple->metier)</li>";
		}
		
		print "	</ul>	
						</td>
						</tr>
		";
	print "</table>";
	
	$result->close();
	$link->close();
	
	print "</body></html>";
?>
