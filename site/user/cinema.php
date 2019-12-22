<?php
	print "<html><head><title>Film</title>
	<link rel=\"stylesheet\" href=\"../css/liste.css\">
	</head><body>";
?>
	<div class="menu">
			<ul>
				</li>
				<?php
					session_start();
					if(!isset($_SESSION['session'])) {
						print "<li>
							<a href=\"se_connecter.php\">Se connecter</a>
						</li>";
						print "<li>
							<a href=\"formulaire_inscription.php\">S'inscrire</a>
						</li>";
					}
					else {
						$email = $_SESSION['session'];
						
						$link = new mysqli("localhost", "Client", "client");
						if($link->connect_errno) {
									die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
						}
						
						$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
						
						$query = "select reduction from Clients where email = '$email';";
						$result = $link->query($query) or die("erreur");
						$tuple = mysqli_fetch_object($result);
						print "<li>
							<a href=\"deconnecte.php\">Se Déconnecter</a>
						</li>";
						print "<li>
							<a href=\"compte.php\">Compte</a>
						</li>";
						if(!$tuple->reduction) {
							print "<li>
								<a href=\"abonner.php\">S'abonner</a>
							</li>";
						}
						print "<li>
							<a href=\"reservation.php\">Mes réservation</a>
						</li>";
						$result->close();
						$link->close();
					}
				?>
				<li>
					<a href="info.php">Info</a>
				</li>
				<li>
					<a href="liste_cinema.php">Cinéma</a>
				</li>
				<li>
					<a href="liste_film.php">Film</a>
				</li>
			</ul>
		</div>
	<?php
	print "<h1 class=\"titre\"><a href=\"index.php\">Réserve TA Place</a></h1>";
	
	/* variable */
	$nom = $_GET['nom'];
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select C.*, S.*, count(S.num_salle) as nb from Cinema C, Salle S where C.nom = S.nom_du_cinema and C.nom = '$nom';";
	$result = $link->query($query) or die("erreur select");
	
	$tuple = mysqli_fetch_object($result);
	
	print "<div class=\"contenu\">";
	print "
		<div class=\"block\">
			<ul class=\"text\">
				<li><h3>$tuple->nom</h3></li>
				<li>Compagnie : $tuple->compagnie</li>
				<li>Ville : $tuple->ville</li
				<li>Nombre de salle : $tuple->nb</li>
				<li><a href=\"projection_cinema.php?nom=$tuple->nom\">voir les projections</a></li>
			</ul>
		</div>
	";
	
	$result->close();
	$link->close();
	
	print "</body></html>";
?>
