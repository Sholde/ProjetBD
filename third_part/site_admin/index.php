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
			<h2>Statistiques</h2>
			<?php
				$query = "SELECT COUNT(num_client) AS nb_inscrit FROM Clients;";
				$result = $link->query($query) or die("erreur select");
				$nb_inscrit = mysqli_fetch_object($result);
				print "<h3>Nombres d'inscrits : $nb_inscrit->nb_inscrit</h3>";
				
				$query = "SELECT COUNT(cl.num_client) AS nb_actif FROM Clients cl WHERE cl.num_client in (select v.num_client from Veut_voir v);";
				$result = $link->query($query) or die("erreur select");
				$nb_actif = mysqli_fetch_object($result);
			  printf("<h3>Nombre d'utilisateurs actif : %d soit %f %% des clients</h3>",$nb_actif->nb_actif,(100 * $nb_actif->nb_actif)/$nb_inscrit->nb_inscrit);
			  
				$query = "SELECT f.nom, sum(v.prix) as recette FROM Film f, Veut_voir v WHERE f.num_film = v.num_film GROUP BY f.nom;";
				$result = $link->query($query) or die("erreur select");
			  print "<h3>Profit par film :</h3>";
			  print "<table border>";
			  print "<tr><th>Nom du film</th><th>Profit</th></tr>";
			  while ($profit = mysqli_fetch_object($result))
			  {
					print "<tr>";
					print "<td>$profit->nom </td><td> $profit->recette € </td>";
					print "</tr>";					
				}		
				print "</table>";		
				$query = "SELECT c.nom, (select sum(v.prix) as recette from Veut_voir v where v.num_se_joue IN (
									select s.num_se_joue FROM Se_joue_dans s WHERE s.nom_du_cinema = c.nom)) as recette
									FROM Cinema c;";
				$result = $link->query($query) or die("erreur select");
			  print "<h3>Profit des cinémas:</h3>";
			  print "<table border>";
			   print "<tr><th>Nom du Cinéma</th><th>Profit</th></tr>";
				while ($profit_cine = mysqli_fetch_object($result))
			  {
					$total = $total + $profit_cine->recette; 
					print "<tr>";
					print "<td>$profit_cine->nom </td><td> $profit_cine->recette €</td>";
					print "</tr>";					
				}		
				print "<td>total </td><td> $total €</td>";
				print "</table>";
				
				$result->close();
				$link->close();
			?>
		</section>
		<a href="deconnection.php">Se déconnecter</a>
	</body>
</html>

