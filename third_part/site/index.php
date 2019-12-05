<html>
	<head>
		<title>Réserve Ta Place</title>
	</head>
	<body>
		<div>
			<h1>Réserve Ta Place</h1>
			<ul>
				<li>
					<a href="index.php">Acceuil</a>
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
</html>
