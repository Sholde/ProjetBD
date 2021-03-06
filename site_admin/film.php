<html>
	<head>
		<title>Film</title>
	</head>	
	<body>
		<h2>Recherche :</h2>
		<form method="POST" action="film.php">
			<table>
				<tr>
				<td>Nom :</td>
				<td><input type="text" name="nom"></td>
				</tr>
				<td>Genre :</td>
				<td><input type="text" name="genre"></td>
				</tr>
				<td>Duree :</td>
				<td><input type="number" name="duree" min="1" max="1000"></td>
				</tr>
				<td>Origine :</td>
				<td><input type="text" name="origine" size="5" maxlength="3"></td>
				</tr>
				<td>Version disponible :</td>
				<td><input type="radio" name="version" value="all">all
				<input type="radio" name="version" value="vf">vf
				<input type="radio" name="version" value="vo">vo
				</td>
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
				$array[] = "nom like \"%$nom%\"";
				$have++;
			}
			if(isset($_POST['genre'])) {
				$genre = $_POST['genre'];
				$array[] = "genre like \"%$genre%\"";
				$have++;
			}
			if(isset($_POST['duree'])  and is_numeric($_POST['duree'])) {
				$duree = $_POST['duree'];
				$array[] = "duree = $duree";
				$have++;
			}
			if(isset($_POST['origine'])) {
				$origine = $_POST['origine'];
				$array[] = "origine like \"%$origine%\"";
				$have++;
			}
			if(isset($_POST['version'])) {
				$version = $_POST['version'];
				$array[] = "version_disponible like \"%$version%\"";
				$have++;
			}
			
			if($have == 0) {
				$query = "select * from Film;";
			}
			else {
				$query = "select * from Film where ";
				$query = $query . " " . $array[$have-1];
				$have--;
				while($have > 0) {
					$query = $query . " and " . $array[$have-1];
					$have--;
				}
				$query = $query . " ;" ;
			}
			/* SURTUOT NE PAS EFFACER */
			
			$result = $link->query($query) or die("erreur select");
			
			print "<h2><a name=\"resultat\">Résultat :</a></h2>";
			
			if(isset($_GET['modif']) and isset($_GET['nom'])) {
				$nom = $_GET['nom'];
				print "Le film $nom existe déjà";
			}
			if(isset($_GET['suppr'])) {
				if(isset($_GET['nom'])) {
					$nom = $_GET['nom'];
					print "impossible de supprimer le film $nom";
				}
			}
			print "<table border> <tr> <th>Nom du film<th>Genre<th>Durée<th>Origine<th>Version disponible</th></tr>";
			$nb_res = 0;
			while($tuple = mysqli_fetch_object($result)) {
				$nb_res++;
				print "
					<tr>
					<form method=\"POST\" action=\"modifier_film.php\">
						<input type=\"text\" value=\"$tuple->num_film\" name=\"num_film\" hidden>
						<td><input type=\"text\" value=\"$tuple->nom\" name=\"nom\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td>
						<td><input type=\"text\" value=\"$tuple->genre\" name=\"genre\" minlength=\"3\" maxlength=\"256\" placeholder=\"3 - 256 caractères\"></td>
						<td><input type=\"number\" value=\"$tuple->duree\" name=\"duree\" min=\"1\" max=\"1000\"></td>
						<td><input type=\"text\" value=\"$tuple->origine\" name=\"origine\" size=\"5\" maxlength=\"3\"></td>
				";
				if($tuple->version_disponible == "all") {
					print "
						<td><input type=\"radio\" value=\"all\" name=\"version\" checked>all
								<input type=\"radio\" value=\"vf\" name=\"version\">vf
								<input type=\"radio\" value=\"vo\" name=\"version\">vo</td>
					";
				}
				if($tuple->version_disponible == "vf") {
					print "
						<td><input type=\"radio\" value=\"all\" name=\"version\">all
								<input type=\"radio\" value=\"vf\" name=\"version\" checked>vf 
								<input type=\"radio\" value=\"vo\" name=\"version\">vo</td>
					";
				}
				if($tuple->version_disponible == "vo") {
					print "
						<td><input type=\"radio\" value=\"all\" name=\"version\">all 
								<input type=\"radio\" value=\"vf\" name=\"version\">vf
								<input type=\"radio\" value=\"vo\" name=\"version\" checked>vo</td>
					";
				}
				print "
					<td><input type=\"submit\" value=\"modifier\"></td>
					</form>
					<form method=\"POST\" action=\"supprimer_film.php\">
					<td><input type=\"text\" value=\"$tuple->num_film\" name=\"num_film\" hidden>
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
		
		<h2><a name="inserer">Insérer :</a></h2>
		<?php
			if(isset($_GET['inser']) and isset($_GET['nom'])) {
				$nom = $_GET['nom'];
				print "impossible d'insérer le film $nom";
			}
		?>
		<table border><tr> <th>Nom du film<th>Genre<th>Durée<th>Origine<th>Version disponible</th></tr>
			<form method="POST" action="inserer_film.php">
			<td><input type="text" name="nom" minlength="3" maxlength="30" placeholder="3 - 30 caractères"></td>
			<td><input type="text" name="genre" minlength="3" maxlength="30" placeholder="3 - 30 caractères"></td>
			<td><input type="number" name="duree" value="1" min="1" max="1000"></td>
			<td><input type="text" name="origine" size="5" minlength="1" maxlength="3"></td>
			<td><input type="radio" value="all" name="version" checked>all
					<input type="radio" value="vf" name="version">vf
					<input type="radio" value="vo" name="version">vo</td>
			<td><input type="submit" value="insérer"></td>
			</form>
		</table>
	</body>
</html>
