<html>
	<head>
		<title>Film</title>
	</head>	
	<body>
		<h2>Recherche :</h2>
		<form method="POST" action="film.php">
			<table>
				<tr>
				<td>Numero :</td>
				<td><input type="text" name="num" size="5" maxlength="7"></td>
				</tr>
				<tr>
				<td>Nom :</td>
				<td><input type="text" name="nom"></td>
				</tr>
				<td>Genre :</td>
				<td><input type="text" name="genre"></td>
				</tr>
				<td>Duree :</td>
				<td><input type="text" name="duree" size="5" maxlength="7"> min</td>
				</tr>
				<td>Origine :</td>
				<td><input type="text" name="origine" size="5" maxlength="3"></td>
				</tr>
				<td>Version disponible :</td>
				<td><input type="radio" name="version" value="all">all<br>
				<input type="radio" name="version" value="vf">vf<br>
				<input type="radio" name="version" value="vo">vo<br>
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
			
			if(isset($_POST['num']) and is_numeric($_POST['num'])) {
				$num = $_POST['num'];
				$array[] = "num_film = $num";
				$have++;
			}
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
			
			print "<h2>Résultat :</h2>";
			
			if(isset($_GET['modif'])) {
				$ancien_num = $_GET['modif'];
				print "erreur modification du numero $ancien_num";
			}
			print "<table border>";
			$nb_res = 0;
			while($tuple = mysqli_fetch_object($result)) {
				$nb_res++;
				print "
					<tr>
					<form method=\"POST\" action=\"modifier_film.php?num_film=$tuple->num_film\">
						<td><input type=\"text\" value=\"$tuple->num_film\" name=\"num_film\" size=\"2\" minlength=\"1\" placeholder=\"min 1\"></td>
						<td><input type=\"text\" value=\"$tuple->nom\" name=\"nom\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td>
						<td><input type=\"text\" value=\"$tuple->genre\" name=\"genre\" minlength=\"3\" maxlength=\"256\" placeholder=\"3 - 256 caractères\"></td>
						<td><input type=\"text\" value=\"$tuple->duree\" name=\"duree\" size=\"5\" maxlength=\"7\">min</td>
						<td><input type=\"text\" value=\"$tuple->origine\" name=\"origine\" size=\"5\" maxlength=\"3\"></td>
				";
				if($tuple->version_disponible == "all") {
					print "
						<td><input type=\"radio\" value=\"all\" name=\"version\" checked>all</td>
						<td><input type=\"radio\" value=\"vf\" name=\"version\">vf</td>
						<td><input type=\"radio\" value=\"vo\" name=\"version\">vo</td>
					";
				}
				if($tuple->version_disponible == "vf") {
					print "
						<td><input type=\"radio\" value=\"all\" name=\"version\">all</td>
						<td><input type=\"radio\" value=\"vf\" name=\"version\" checked>vf</td>
						<td><input type=\"radio\" value=\"vo\" name=\"version\">vo</td>
					";
				}
				if($tuple->version_disponible == "vo") {
					print "
						<td><input type=\"radio\" value=\"all\" name=\"version\">all</td>
						<td><input type=\"radio\" value=\"vf\" name=\"version\">vf</td>
						<td><input type=\"radio\" value=\"vo\" name=\"version\" checked>vo</td>
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
		
		<h2>Insérer :</h2>
		<?php
			if(isset($_GET['inser'])) {
				print "impossible d'insérer se film";
			}
		?>
		<table border>
			<form method="POST" action="inserer_film.php">
			<td><input type="text" name="num_film" size="2" minlength="1" placeholder="min 1"></td>
			<td><input type="text" name="nom" minlength="3" maxlength="30" placeholder="3 - 30 caractères"></td>
			<td><input type="text" name="genre" minlength="3" maxlength="256" placeholder="3 - 256 caractères"></td>
			<td><input type="text" name="duree" size="5" minlength="1" maxlength="7">min</td>
			<td><input type="text" name="origine" size="5" minlength="1" maxlength="3"></td>
			<td><input type="radio" value="all" name="version" checked>all</td>
			<td><input type="radio" value="vf" name="version">vf</td>
			<td><input type="radio" value="vo" name="version">vo</td>
			<td><input type="submit" value="insérer"></td>
			</form>
		</table>
	</body>
</html>
