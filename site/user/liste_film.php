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
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	if(isset($_POST['nom'])) {
		$nom = $_POST['nom'];
		$query = "Select F.*, avg(N.note) as moyenne from Film F, Note N where F.nom like \"%$nom%\" and N.num_film = F.num_film group by F.num_film order by moyenne DESC;";
	}
	else
		$query = "Select F.*, avg(N.note) as moyenne from Film F, Note N where N.num_film = F.num_film group by F.num_film order by moyenne DESC;";
	
	$result = $link->query($query) or die("erreur select");
	
	print "
		<h1 name=\"liste\">Listes des Films :</h1>
	";
	$number = 0;
	print "<div class=\"contenu\">";
	while ($tuple = mysqli_fetch_object($result)){
		$number++;
		print "
				<a class=\"block\" href=\"film.php?num_film=$tuple->num_film\">
					<ul class=\"text\">
						<li>$tuple->nom</li>
						<li>Note du film : $tuple->moyenne</li>
					</ul>
				</a>
		";
	}
	if(!$number)
		print "
				<a class=\"block\">
					<ul class=\"text\">
						<li>Aucun résultat</li>
					</ul>
				</a>
		";
	print "</div>";
	
	$result->close();
	$link->close();
	
	print "</body></html>";
?>
