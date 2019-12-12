<html>
	<head>
		<title>Reserve ta place : stats-page</title>
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
			
			$query = "SELECT COUNT(num_client) AS nb_inscrit FROM Clients;";
			$result = $link->query($query) or die("erreur select");
			$nb_inscrit = mysqli_fetch_object($result);
			print "<h3>Nombres d'inscrits : $nb_inscrit->nb_inscrit dont ? ayant bénéficié de reductions</h3>";
			
			$query = "SELECT COUNT(cl.num_client) AS nb_actif FROM Clients cl WHERE cl.num_client in (select v.num_client from Veut_voir v);";
			$result = $link->query($query) or die("erreur select");
			$nb_actif = mysqli_fetch_object($result);
			printf("<h3>Nombre d'utilisateurs actif : %d soit %f %% des clients</h3>",$nb_actif->nb_actif,(100 * $nb_actif->nb_actif)/$nb_inscrit->nb_inscrit);
			/* TO DO : Nombre de clients ayant bénéficié d'une réduction */
			$query = "SELECT f.nom, sum(v.prix) as recette FROM Film f, Veut_voir v WHERE f.num_film = v.num_film GROUP BY f.num_film;";
			
			/* Union sum prix et moyenne des notes */
			/* SELECT f.nom, p.recette,n.moyenne FROM Film f, (SELECT sum(prix) as recette,f.num_film FROM Veut_voir v,Film f WHERE f.num_film = v.num_film GROUP BY f.num_film) as p,(SELECT avg(n.note) AS moyenne,f.num_film  FROM Note n,Film f WHERE f.num_film = n.num_film GROUP BY f.num_film) as n WHERE f.num_film = n.num_film and f.num_film = p.num_film;
			*/
			
			//~ $output = shell_exec('ls'); -> test du shell exec sur php mdr 
			//~ pour interpreté du R lol: R CMD BATCH exemple.R et rm *.Rout pour clean
			//~ echo ... > exemple.R 
			//~ a href lien de l'image 
			
			echo "<pre>$output</pre>";
			
			$result = $link->query($query) or die("erreur select");
			
			print "<h3>Profit par film :</h3>";
			print "<table border>";
			print "<tr><th>Nom du film</th><th>Profit</th><th>Moyenne</th></tr>";
			while ($profit = mysqli_fetch_object($result))
			{
				print "<tr>";
				print "<td>$profit->nom </td>";
				if(!(empty($profit->recette)))
				{
					print "<td> $profit->recette € </td>";
				}
				else 
				{
					print "<td> 0 € </td>";
				}
				print "<td>$profit->note moyenne</td>";
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
				if(!(empty($profit_cine->recette)))
				{
					print "<td>$profit_cine->nom </td><td> $profit_cine->recette €</td>";
				}
				else 
				{
					print "<td>$profit_cine->nom </td><td> 0 €</td>";
				}
				print "</tr>";					
			}		
			print "<td>total </td><td> $total €</td>";
			print "</table>";
			print "<h3> Taux de remplissages des salles </h3>";
			/* TO DO : Nom du cinéma : date : heure : Numero des salles (par ordre) : taux de remplissage */
			print "<h3> Influence de chaque cinéma </h3>";
			/* TO DO : Nom du cinéma : date : Nombre de clients qui vont voir un film dans ce cinéma */
			$result->close();
			$link->close();
		?>
	</body>
</html>
