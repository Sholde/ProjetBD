<?php
	print "<html><head><title>Compte</title>
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
	if(!isset($_SESSION['session'])) {
		header("Location: se_connecter.php");
		exit();
	}
	$email_client = $_SESSION['session'];
	
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select * from Clients where email = '$email_client';";
	$result = $link->query($query) or die("erreur select");
	
	$tuple = mysqli_fetch_object($result);
	
	print "<form method=\"POST\" action=\"change_compte.php\">";
	print "<div class=\"contenu\">";
	print "
		<div class=\"block\">
					<ul class=\"text\">
						<li><h3>Compte</h3></li>
					</ul>
				</div>
	";
	print "
				<div class=\"block\">
					<ul class=\"text\">
						<table><tr>
						<td>Nom :</td><td> <input type=\"text\" value=\"$tuple->nom\" name=\"nom\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td></tr>
						<tr><td>Prenom :</td><td> <input type=\"text\" value=\"$tuple->prenom\" name=\"prenom\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td></tr>
						<tr><td>Email :</td><td>  <input type=\"text\" value=\"$tuple->email\" name=\"email\"  minlength=\"11\"></td></tr>
						<tr><td>Mot de passe :</td><td>  <input type=\"text\" value=\"$tuple->mot_de_passe\" name=\"mdp\" minlength=\"3\" maxlength=\"16\" placeholder=\"3 - 16 caractères\"></td></tr>
	";
	
	/* affiche les réduction */
	$reduc = $tuple->reduction;
	if($reduc) {
		print "
			<tr><td>Réduction :</td><td> oui</td></tr>
		";
	}
	else {
		print "
			<tr><td>Réduction :</td><td> non</td></tr>
		";
	}
	
	print "<tr><td><input type=\"submit\" value=\"valider\">	</td></tr></ul>
				</div>
				</div>";
	print "</form>";
	
	/* affiche si l'utilisateur met un email déjà existant */
	if(isset($_GET['not'])) {
		$not = $_GET['not'];
		if ($not == 1){
			print "<div class=\"erreur\">Cet adresse email existe déjà</div>";
		}
	}
	
	$link->close();
	
	print "</body></html>";
?>
