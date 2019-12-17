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
	
	if(!isset($_GET['nom'])) {
		header("Location: index.php");
		exit();
	}
	
	/* variable */
	$nom = $_GET['nom'];
	
	date_default_timezone_set('Europe/Paris');
	$jour = date('Y-m-d H:i:s');
	
	/* connexion serveur */
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	/* connexion bd */
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	print "<div class=\"contenu\">";
	print "	
		<div class=\"block\">
			<ul class=\"text\">
				<li><h3>Liste des projections dans le cinéma $nom :</h3></li>
			</ul>
		</div>
	";
		
	$query = "Select * from Cinema C, Film F, Se_joue_dans J, Salle S where S.nom_du_cinema = C.nom and S.nom_du_cinema = J.nom_du_cinema and S.num_salle = J.num_salle and J.num_film = F.num_film and J.nom_du_cinema = C.nom and C.nom = '$nom' and J.jour > '$jour';";
	$result = $link->query($query) or die("erreur select");
	
	/* affiche les films disponnible dans ce cinema */
	while($tuple = mysqli_fetch_object($result)) {
		$array = explode(" ",$tuple->jour);
		print "	
		<div class=\"block\">
			<ul class=\"text\">
				<li><a href=\"film.php?num_film=$tuple->num_film\"><h3>$tuple->nom</h3></a></li>
				<li>Date: $array[0]</li>
				<li>Heure: $array[1]</li>
				<li>Cinéma : <a href=\"cinema.php?nom=$tuple->nom_du_cinema\">$tuple->nom_du_cinema</a></li>
				<li><a href=\"formulaire_reserve.php?num_se_joue=$tuple->num_se_joue&num_film=$tuple->num_film\">Réserver</a></li>
			</ul>
		</div>
	";
	}
	print " </div>";
	
	$link->close();
	
	print "</body></html>";
?>
