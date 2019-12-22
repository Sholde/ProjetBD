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
	
	if(!isset($_GET['num_film'])) {
		header("Location: index.php");
		exit();
	}
	
	
	$num_film = $_GET['num_film'];
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	date_default_timezone_set('Europe/Paris');
	$jour = date('Y-m-d H:i:s');
	
	$query = "Select * from Film F, Se_joue_dans J, Salle S, Cinema C where C.nom = S.nom_du_cinema and S.nom_du_cinema = J.nom_du_cinema and S.num_salle = J.num_salle and J.num_film = F.num_film and F.num_film = $num_film and J.jour > '$jour';";
	$result = $link->query($query) or die("erreur select");
	
	$query = "Select nom from Film F where F.num_film = $num_film;";
	$raw_film = $link->query($query) or die("erreur select");
	
	$tuple = mysqli_fetch_object($raw_film);
	print "<div class=\"contenu\">";
	print "	
		<div class=\"block\">
			<ul class=\"text\">
				<li><h3>Liste des projections du film $tuple->nom :</h3></li>
			</ul>
		</div>
	";
	
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
	
	$result->close();
	$link->close();
	
	print "</body></html>";
?>
