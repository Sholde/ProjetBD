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
			print "<a href=\"index.php\">Retour au menu principal</a>";
			$query = "SELECT COUNT(num_client) AS nb_inscrit FROM Clients;";
			$result = $link->query($query) or die("erreur select");
			$nb_inscrit = mysqli_fetch_object($result);
			print "<h3>Nombres d'inscrits : $nb_inscrit->nb_inscrit dont ? ayant bénéficié de reductions</h3>";
			
			$query = "SELECT COUNT(cl.num_client) AS nb_actif FROM Clients cl WHERE cl.num_client in (select v.num_client from Veut_voir v);";
			$result = $link->query($query) or die("erreur select");
			$nb_actif = mysqli_fetch_object($result);
			printf("<h3>Nombre d'utilisateurs actif : %d soit %f %% des clients</h3>",$nb_actif->nb_actif,(100 * $nb_actif->nb_actif)/$nb_inscrit->nb_inscrit);
			/* TO DO : Nombre de clients ayant bénéficié d'une réduction */
			
			$query = "SELECT f.nom,sum(v.prix) as recette FROM Film f,Veut_voir v WHERE f.num_film IN (v.num_film) GROUP BY f.num_film UNION SELECT f.nom,0 as recette FROM Film f,Veut_voir v WHERE f.num_film NOT IN (SELECT v.num_film FROM Veut_voir v) GROUP BY f.num_film;";
			
			echo "<pre>$output</pre>";
			
			$result = $link->query($query) or die("erreur select");
			
			print "<h3>Profit par film :</h3>";
			print "<table border>";
			print "<tr><th>Nom du film</th><th>Profit</th></tr>";
			while ($profit = mysqli_fetch_object($result))
			{
				print "<tr>";
				print "<td>$profit->nom </td>";
				print "<td> $profit->recette € </td>";
				print "</tr>";					
			}		
			print "</table>";		
			$query = "SELECT c.nom, (select sum(v.prix) from Veut_voir v where v.num_se_joue IN (
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
			$query= "SELECT
							s.nom_du_cinema,
							s.jour,
							s.num_salle,
							COUNT(v.num_client) AS nb_reservations
							FROM
									Se_joue_dans s,
									Veut_voir v
							WHERE
									s.num_se_joue = v.num_se_joue 
							GROUP BY
									s.num_se_joue;";
			
			print "<h3>Remplissages des salles:</h3>";
			$result = $link->query($query) or die("erreur select");
			print "<table border>";
			print "<tr><th>Date<th>Numéro de la Salle <th> Nom du Cinéma <th> Nombre de réservations</th></tr>";
			while ($salle_remp = mysqli_fetch_object($result))
			{
				print "<tr>";
				print "<td>$salle_remp->jour </td><td>$salle_remp->num_salle</td> <td>$salle_remp->nom_du_cinema</td> <td>$salle_remp->nb_reservations</td>";
				print "</tr>";					
			}		
			print "</table>";
			print "<h3> Recette/Influence de chaque cinéma par jour</h3>";
			/* TO DO : Nom du cinéma : date : Nombre de clients qui vont voir un film dans ce cinéma */
			$query= "SELECT DISTINCT Date(jour) as jour FROM Se_joue_dans;";
			$result = $link->query($query) or die("erreur select");
			while ($date_du_jour= mysqli_fetch_object($result))
			{
				print "<h4>Date du jour $date_du_jour->jour</h4>";
				$query2 ="SELECT DISTINCT nom_du_cinema FROM Se_joue_dans WHERE jour like \"$date_du_jour->jour%\";";
				$result2 = $link->query($query2) or die("erreur select");
				print "</ul>";
				while ($nom_cine = mysqli_fetch_object($result2))
				{
					$query3 = "SELECT
					SUM((
					SELECT
							SUM(v.prix)
					FROM
							Veut_voir v
					WHERE
							v.num_se_joue = j.num_se_joue
					)) AS recette,
					(SELECT COUNT(num_client) FROM Veut_voir v WHERE v.num_se_joue = j.num_se_joue) as nbr_reservations,
					nom_du_cinema
					FROM
							Se_joue_dans j
					WHERE
							jour LIKE \"$date_du_jour->jour%\" AND nom_du_cinema = \"$nom_cine->nom_du_cinema\";"; /* ne pas changé le = par like*/
					$result3 = $link->query($query3) or die("erreur select");
					$recette = mysqli_fetch_object($result3);
					print "<li>Le cinéma $nom_cine->nom_du_cinema à fait $recette->recette € de recette avec $recette->nbr_reservations places réservées</li>";
				}	
				print "</ul> ";
			}		
			$result3->close();
			$result2->close();
			$result->close();
			$link->close();
		?>
	</body>
</html>
