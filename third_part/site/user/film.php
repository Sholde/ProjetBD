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
	
	$num_film = $_GET['num_film'];
	
	$link = new mysqli("localhost", "Anonyme", "anonyme");
	if($link->connect_errno) {
		die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "SELECT F.*, avg(N.note) AS moyenne, COUNT(N.num_client) AS nb_note FROM Note N, Film F WHERE F.num_film = $num_film and N.num_film = $num_film;";
	$result = $link->query($query) or die("erreur select");
	
	$query_suiv = "
		select F_suiv.num_film as num, F_suiv.nom as nom
		from Film F_prec, Film F_suiv, Suit S
		where F_prec.num_film = S.num_film_prec
		and F_suiv.num_film = S.num_film_suiv
		and S.num_film_prec = $num_film;
	";
	$film_suiv = $link->query($query_suiv) or die("erreur select");
	
	$query_prec = "
		select F_prec.num_film as num, F_prec.nom as nom
		from Film F_prec, Film F_suiv, Suit S
		where F_prec.num_film = S.num_film_prec
		and F_suiv.num_film = S.num_film_suiv
		and S.num_film_suiv = $num_film;
	";
	$film_prec = $link->query($query_prec) or die("erreur select");
	
	print "<div class=\"contenu\">";
	$tuple = mysqli_fetch_object($result);
	print "	
			<a class=\"block\">
				<ul class=\"text\">
					<li><h2>$tuple->nom</h2></li>
				</ul>
			</a>
	";
	print "	
			<a class=\"block\">
				<ul class=\"text\">
					<li><h3>Info</h3></li>
					<li>Genre: $tuple->genre</li>
					<li>Origine: $tuple->origine</li>
					<li>Duree: $tuple->duree</li>
					<li>version: $tuple->version_disponible</li>
					<li>Note : $tuple->moyenne</li>
					<li>Nombre de votes : $tuple->nb_note</li>
				</ul>
			</a>
		";
		
	/* directeur */
		
	$query = "select * from Personne P, Participe_au_film PA where PA.num_personne = P.num_personne and PA.num_film = $num_film and PA.metier like '%Direct%';";
	$result = $link->query($query) or die("erreur select");
	
	print "	
			<div class=\"block\">
				<ul class=\"text\">
					<li><h3>Directeur</h3></li>
	";
	while($tuple = mysqli_fetch_object($result)) {
		print "<li><a href=\"personne.php?num=$tuple->num_personne\">$tuple->nom $tuple->prenom</a></li>";
	}
	print "
				</ul>
			</div>
	";
	
	/* scénariste */
	
	$query = "select * from Personne P, Participe_au_film PA where PA.num_personne = P.num_personne and PA.num_film = $num_film and PA.metier like '%Scénar%';";
	$result = $link->query($query) or die("erreur select");
	
	print "	
			<div class=\"block\">
				<ul class=\"text\">
					<li><h3>Scénariste</h3></li>
	";
	while($tuple = mysqli_fetch_object($result)) {
		print "<li><a href=\"personne.php?num=$tuple->num_personne\">$tuple->nom $tuple->prenom</a></li>";
	}
	print "
				</ul>
			</div>
	";
	
	
	/* acteur */
	$query = "select * from Personne P, Participe_au_film PA where PA.num_personne = P.num_personne and PA.num_film = $num_film and PA.metier like '%Act%';";
	$result = $link->query($query) or die("erreur select");
	
	print "	
			<div class=\"block\">
				<ul class=\"text\">
					<li><h3>Acteur</h3></li>
	";
	while($tuple = mysqli_fetch_object($result)) {
		print "<li><a href=\"personne.php?num=$tuple->num_personne\">$tuple->nom $tuple->prenom</a></li>";
	}
	print "
				</ul>
			</div>
	";
		
	print "	
			<div class=\"block\">
				<ul class=\"text\">
					<a href=\"projection_film.php?num_film=$num_film\">Voir les projections</a>
				</ul>
			</div>
	";
	print "	
			<div class=\"block\">
				<ul class=\"text\">
					<a href=\"formulaire_noter.php?num_film=$num_film\">Noter le film</a>
				</ul>
			</div>
	";
		
		$prec = mysqli_fetch_object($film_prec);
		if($prec) {
			print "	
				<div class=\"block\">
					<ul class=\"text\">
						<li>Film précédent :</li>
						<li><a href=\"film.php?num_film=$prec->num\">$prec->nom</a></li>
					</ul>
				</div>
			";
		}
		$suiv = mysqli_fetch_object($film_suiv);
		if($suiv) {
			print "	
				<div class=\"block\">
					<ul class=\"text\">
						<li>Film suivant :</li>
						<li><a href=\"film.php?num_film=$suiv->num\">$suiv->nom</a></li>
					</ul>
				</div>
			";
		}
	
	$film_prec->close();
	$film_suiv->close();
	$result->close();
	$link->close();
	
	print "</body></html>";
?>
