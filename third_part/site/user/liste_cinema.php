<?php
	print "<html><head><title>Cinéma</title>
	<link rel=\"stylesheet\" href=\"../css/liste.css\">
	</head><body>";
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select C.*, S.ville, count(S.num_salle) as nb from Cinema C, Salle S where C.nom = S.nom_du_cinema group by C.nom;";
	$result = $link->query($query) or die("erreur select");
	
	print "
		<h1>Liste des cinéma : </h1>
	";
	
	print "<div class=\"contenu\">";
	while ($tuple = mysqli_fetch_object($result)){ 
		print "
				<a href=\"cinema.php?nom=$tuple->nom\">
					<ul class=\"text\">
						<li>$tuple->nom</li>
						<li>$tuple->ville</li>
					</ul>
				</a>
		";
	}
	print "</div>";
	
	$link->close();
	
	print "</body></html>";
?>
