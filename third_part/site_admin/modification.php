<html>
	<head>
		<title>Reserve ta place : modif</title>
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
			<li><a href="#">Clients</a></li>
			<li><a href="#">Film</a></li>
			<li><a href="#">Cinema</a></li>
			<li><a href="#">Personne</a></li>
		</ul>
	</body>
</html>
