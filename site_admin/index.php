<html>
	<head>
		<title>Reserve ta place : admin-page</title>
	</head>	
	<body>
		<?php
			session_start();
			if(!isset($_SESSION['admin']))  {
				header("Location: se_connecter.php");
				exit();
			}
			$total = 0; 
			$link = new mysqli("localhost", "Admin", "admin");
			if($link->connect_errno) {
				die ("erreur connection");
			}
			$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
		?>
		<header>
			<h1>Page d'administration :</h1>
		</header>
		<section>
			<a href="liste_table.php"><h2>Modification de la base de donnée</h2></a>
			<a href="stats.php"><h2>Consultation des données statistiques</h2></a>
		</section>
		<a href="deconnection.php">Se déconnecter</a>
	</body>
</html>

