<html>
	<head>
		<title>Reserve ta place : table</title>
	</head>	
	<body>
		<?php
			session_start();
			if(!isset($_SESSION['admin']))  {
				header("Location: se_connecter.php");
				exit();
			}
			
			$link = new mysqli("localhost", "Admin", "admin");
			if($link->connect_errno) {
				die ("$id n'existe pas ou mauvais mot de passe <a href=index.html>retourner à la page de connexion</a>");
			}
			$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
		?>
		<ul>
			<li><a href="client.php">Clients</a></li>
			<li><a href="#">Réservation</a></li>
			<li><a href="note.php">Note</a></li>
			<li><a href="film.php">Film</a></li>
			<li><a href="projection.php">Projection</a></li>
			<li><a href="salle.php">Salle</a></li>
			<li><a href="cinema.php">Cinema</a></li>
			<li><a href="#">Personne</a></li>
			<li><a href="#">Contribution</a></li>
		</ul>
	</body>
</html>
