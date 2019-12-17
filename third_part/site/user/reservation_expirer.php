<?php
	session_start();
	if(!isset($_SESSION['session'])) {
		header("Location: se_connecter.php");
		exit();
	}
	$email_client = $_SESSION['session'];
	
	print "<html><head><title>Réservation</title>
	<link rel=\"stylesheet\" href=\"../css/liste.css\">
	</head><body>";
?>
	<div class="menu">
			<ul>
				</li>
				<?php
					if(!isset($_SESSION['session'])) {
						print "<li>
							<a href=\"se_connecter.php\">Se connecter</a>
						</li>";
						print "<li>
							<a href=\"formulaire_inscription.php\">S'inscrire</a>
						</li>";
					}
					else {
						print "<li>
							<a href=\"deconnecte.php\">Se Déconnecter</a>
						</li>";
						print "<li>
							<a href=\"compte.php\">Compte</a>
						</li>";
						print "<li>
							<a href=\"reservation.php\">Mes réservation</a>
						</li>";
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
	
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	date_default_timezone_set('Europe/Paris');
	$jour = date('Y-m-d H:i:s');
	
	$query = "Select C.*, V.*, J.*, F.nom as nom_film, count(J.num_se_joue) as nb_place from Clients C, Veut_voir V, Film F, Se_joue_dans J where C.email = '$email_client' and V.num_se_joue = J.num_se_joue and V.num_film = F.num_film and J.jour < '$jour' group by V.num_se_joue order by J.jour ASC;";
	$result = $link->query($query) or die("erreur select");
	
	print "<h4 class=\"res\"><a href=\"reservation.php\">réservation</a></h4>";
	
	print "<h1>Réservation expiré :</h1>";
	
	print "<div class=\"contenu\">";
	$number = 0;
	while($tuple = mysqli_fetch_object($result)) {
		$number++;
		$array = explode(" ",$tuple->jour);
		print "
				<div class=\"block\">
					<ul class=\"text\">
						<li><a href=\"film.php?num_film=$tuple->num_film\"><h3>$tuple->nom_film</h3></a></li>
						<li>Cinéma : <a href=\"cinema.php?nom=$tuple->nom_du_cinema\">$tuple->nom_du_cinema</a></li>
						<li>Numéro de la salle : $tuple->num_salle</li>
						<li>Date : $array[0]</li>
						<li>Heure : $array[1]</li>
						<li>Nb de place acheté : $tuple->nb_place</li>
					</ul>
				</div>
		";
	}
	if(!$number) {
		print "
				<div class=\"block\">
					<ul class=\"text\">
						<li>Aucune réservation expiré</li>
					</ul>
				</div>
		";
	}
	print "</div>";
	
	$result->close();
	$link->close();
	
	print "</body></html>";
?>
