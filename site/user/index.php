<html>
	<head>
		<link rel="stylesheet" href="../css/menu_principal.css">
		<title>Réserve Ta Place</title>
	</head>
	<body>
		<div>
			<ul class="menu">
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
			<h1 class="titre">Réserve Ta Place</h1>
			<form method="POST" action="liste_film.php">
			 <div class="search-box">
					<input class="search-txt" type="text" name="nom" placeholder="Rechercher un film">
			</div>
			<input type="submit" hidden>
			</form>
		</div>
	</body>
</html>
