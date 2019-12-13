<html>
	<head>
		<link rel="stylesheet" href="../css/menu.css">
		<title>Réserve Ta Place</title>
	</head>
	<body>
		<div>
			<h1>Réserve Ta Place</h1>
			<ul class="menu">
				<li>
					<a href="info.php">Info</a>
				</li>
				<li>
					<a href="liste_cinema.php">Cinéma</a>
				</li>
				<li>
					<a href="liste_film.php">Film</a>
				</li>
				<li>
					<a href="rechercher.php">Rechercher</a>
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
						print "<li>
							<a href=\"compte.php\">Compte</a>
						</li>";
						print "<li>
							<a href=\"deconnecte.php\">Se Déconnecter</a>
						</li>";
					}
				?>
			</ul>
		</div>
	</body>
	<footer>
		<div>
			reserve-ta-place.com &copy;
		</div>
	</footer>
</html>
