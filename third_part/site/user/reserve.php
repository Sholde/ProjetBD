<?php

	session_start();
	if(!isset($_SESSION['session'])) {
		header("Location: se_connecter.php");
		exit();
	}
	
	/* variable */
	$num_se_joue = $_POST['num_se_joue'];
	$num_film = $_POST['num_film'];
	$num_client = $_POST['num_client'];
	$prix = $_POST['prix'];
	$nb_place = $_POST['nb_place'];
	$tmp = $nb_place;
	
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "select max(num_veut_voir) as nb from Veut_voir";
	$result = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	$max = $tuple->nb + 1;
	
	while($nb_place > 0) {
		$query = "insert into Veut_voir value ($max, $num_se_joue, $num_client, $num_film, $prix);";
		$link->query($query) or die("erreur insert");
		$nb_place--;
		$max++;
	}
?>
<?php
	print "<html><head><title>Film</title>
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
	
	$query = "select F.nom as nom_film, J.* from Film F, Se_joue_dans J where F.num_film = $num_film and J.num_se_joue = $num_se_joue";
	$result = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	
	date_default_timezone_set('Europe/Paris');
	$jour = date('Y-m-d H:i:s');
	$array = explode(" ",$tuple->jour);
	
	print "<div class=\"contenu\">";
		print "
				<a href=\"ajout_abonnement.php\">
					<ul class=\"text\">
						<li>Nom du film : $tuple->nom_film</li>
						<li>Cinéma : $tuple->nom_du_cinema</li>
						<li>Numéro de la salle : $tuple->num_salle</li>
						<li>Date : $array[0]</li>
						<li>Heure : $array[1]</li>
						<li>Place acheté : $tmp</li>
						<li></li>
					</ul>
				</a>
		";
	print "</div>";

	$result->close();
	$link->close();
?>
