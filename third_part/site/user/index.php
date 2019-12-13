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
						print "<li>
							<a href=\"compte.php\">Compte</a>
						</li>";
						print "<li>
							<a href=\"deconnecte.php\">Se Déconnecter</a>
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
			<h1 class="titre">Réserve Ta Place</h1>
			<form method="POST" action="calcul.php">
			 <div class="search-box">
					<input class="search-txt" type="text" name="recherche" placeholder="Rechercher un film">
			</div>
			<input type="submit" hidden>
			</form>
		</div>
	</body>
</html>
