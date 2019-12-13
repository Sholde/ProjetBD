<html>
	<head>
		<title>Salle</title>
	</head>	
	<body>
		<h2>Recherche :</h2>
		<form method="POST" action="salle.php">
			<table>
				<tr>
				<td>Numéro Salle :</td>
				<td><input type="number" name="num" min="1"></td>
				</tr>
				<tr>
				<td>Nom du cinéma :</td>
				<td><input type="text" name="nom"></td>
				</tr>
				<tr>
				<td>Nombre de place min :</td>
				<td><input type="number" name="nb_place" min="1"></td>
				</tr>
			</table>
			<input type="submit" value="rechercher">
			<input type="reset" value="annuler">
		</form>
		<?php
			session_start();
			if(!isset($_SESSION['admin']))  {
				header("Location: se_connecter.php");
				exit();
			}
			
			$link = new mysqli("localhost", "Admin", "admin");
			if($link->connect_errno) {
				die ("erreur connection");
			}
			$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
			
			/* SURTUOT NE PAS EFFACER */
			/* C'EST LA RECHERCHE */
			$array = array();
			$have = 0;
			
			if(isset($_POST['nom'])) {
				$nom = $_POST['nom'];
				$array[] = "S.nom_du_cinema like \"%$nom%\"";
				$have++;
			}
			if(isset($_POST['num']) and is_numeric($_POST['num'])) {
				$num = $_POST['num'];
				$array[] = "S.num_salle = $num";
				$have++;
			}
			if(isset($_POST['nb_place']) and is_numeric($_POST['nb_place'])) {
				$nb_place = $_POST['nb_place'];
				$array[] = "S.nb_de_place >= $nb_place";
				$have++;
			}
			
			if($have == 0) {
				$query = "select * from Salle S;";
			}
			else {
				$query = "select * from Salle S where ";
				$tmp = " " . $array[$have-1];
				$have--;
				while($have > 0) {
					$tmp = $tmp . " and " . $array[$have-1];
					$have--;
				}
				$query = $query . $tmp . " ;";
			}
			/* SURTUOT NE PAS EFFACER */
			
			$result = $link->query($query) or die("erreur select");
			
			print "<h2>Résultat :</h2>";
			
			if(isset($_GET['modif']) and isset($_GET['num']) and isset($_GET['nom'])) {
				$ancien_num = $_GET['num'];
				$ancien_nom = $_GET['nom'];
				print "erreur modification de la salle $ancien_num dans le cinéma $ancien_nom";
			}
			print "<table border><tr><th>Num Salle</th><th>Nom du Cinéma</th><th>Nb place</th></tr>";
			$nb_res = 0;
			while($tuple = mysqli_fetch_object($result)) {
				$nb_res++;
				print "
					<tr>
					<form method=\"POST\" action=\"modifier_salle.php?num=$tuple->num_salle&nom=$tuple->nom_du_cinema\">
						<td><input type=\"text\" value=\"$tuple->num_salle\" name=\"num\" size=\"5\" minlength=\"1\" placeholder=\"min 1\"></td>
						<td><input type=\"text\" value=\"$tuple->nom_du_cinema\" name=\"nom\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td>
						<td><input type=\"number\" value=\"$tuple->nb_de_place\" name=\"nb_place\" min=\"1\"></td>
						<td><input type=\"submit\" value=\"modifier\"></td>
					</form>
					<form method=\"POST\" action=\"supprimer_salle.php\">
						<td><input type=\"text\" value=\"$tuple->num_salle\" name=\"num\" hidden>
						<td><input type=\"text\" value=\"$tuple->nom_du_cinema\" name=\"nom\" hidden>
						<input type=\"submit\" value=\"supprimer\"></td>
					</form>
					</tr>
				";
			}
			print "</table>";
			if($nb_res == 0) {
				print "<h3>Aucun Résultat</h3>";
			}
		?>
		
		<h2>Insérer :</h2>
		<?php
			if(isset($_GET['inser']) and isset($_GET['num']) and isset($_GET['nom'])) {
				$ancien_num = $_GET['num'];
				$ancien_nom = $_GET['nom'];
				print "impossible d'insérer la salle $ancien_num dans le cinéma $ancien_nom";
			}
		?>
		<table border>
			<form method="POST" action="inserer_salle.php">
				<tr><th>Num Salle</th><th>Nom du Cinéma</th><th>Nb place</th></tr>
				<tr>
					<td><input type="text" name="num" size="5" minlength="1" placeholder="min 1"></td>
					<td><input type="text" name="nom" minlength="3" maxlength="30" placeholder="3 - 30 caractères"></td>
					<td><input type="number" value="1" name="nb_place" min="1"></td>
					<td><input type="submit" value="insérer"></td>
				</tr>
			</form>
		</table>
	</body>
</html>
