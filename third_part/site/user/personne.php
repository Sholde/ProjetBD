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
	
	$num = $_GET['num'];
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "SELECT P.*, PA.*, F.nom as nom_film FROM Personne P, Film F, Participe_au_film PA WHERE F.num_film = PA.num_film and PA.num_personne = $num and P.num_personne = $num;";
	$result = $link->query($query) or die("erreur select");
	
	print "<div class=\"contenu\">";
	print "	
		<div class=\"block\">
			<ul class=\"text\">
				<li><h2>Personne</h2></li>
			</ul>
		</div>
	";
	$tuple = mysqli_fetch_object($result);
	print "	
		<div class=\"block\">
			<ul class=\"text\">
				<li><h2>Info</h2></li>
				<li>Nom : $tuple->nom</li>
				<li>Prénom : $tuple->prenom</li>
				<li>Age : $tuple->age</li
				<li>Métier : $tuple->metier</li>
			</ul>
		</div>
	";
		
	print "
		<div class=\"block\">
			<ul class=\"text\">
				<li><h2>Film :</h2></li>
	";
		$query = "SELECT P.*, PA.*, F.nom as nom_film FROM Personne P, Film F, Participe_au_film PA WHERE F.num_film = PA.num_film and PA.num_personne = $num and P.num_personne = $num;";
		$result = $link->query($query) or die("erreur select");
		while($tuple = mysqli_fetch_object($result)) {
			print " <li><a href=\"film.php?num_film=$tuple->num_film\">$tuple->nom_film</a>($tuple->metier)</li>";
		}
		
		print "	</ul>	
						</div>
		";
	print "</div>";
	
	$result->close();
	$link->close();
	
	print "</body></html>";
?>
