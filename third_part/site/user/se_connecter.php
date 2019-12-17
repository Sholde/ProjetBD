<html>
	<head>
		<link rel="stylesheet" href="../css/liste.css">
		<title>Se connecter</title>
	</head>
	<body>
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
		<h1 class="titre"><a href="index.php">Réserve TA Place</a></h1>
		<form method="POST" action="connecte.php">
			<div class="contenu">
			<div class="block">
				<ul class="text">
					<table>
						<tr>
						<td>email : </td>
						<td><input type="text" name="email" minlength="11"></td>
						</tr>
						<tr>
						<td>Mot de passe : </td>
						<td><input type="password" name="mdp" minlength="3" maxlength="16" placeholder="3 - 16 caractères"></td>
						</tr>
					</table>
					<input type="Submit" value="Se connecter"><input type="reset"><br>
					<a href="formulaire_inscription.php">S'incrire</a>
					<?php
						if(isset($_GET['not'])) {
							$not = $_GET['not'];
							if ($not == 1){
									print "<div id=\"erreur\">email ou mot de passe incorrect</div>";
							}
						}
					?>
				</ul>
			</div></div>
		</form>
	</body>
</html>
