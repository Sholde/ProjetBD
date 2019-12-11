<html>
	<head>
		<title>Film</title>
	</head>	
	<body>
		<h2>Recherche :</h2>
		<form method="POST" action="cinema.php">
			<table>
				<tr>
				<td>Nom :</td>
				<td><input type="text" name="nom"></td>
				</tr>
				<tr>
				<td>Compagnie :</td>
				<td><input type="text" name="compagnie"></td>
				</tr>
				<tr>
				<td>Ville :</td>
				<td><input type="text" name="ville"></td>
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
				$array[] = "C.nom like \"%$nom%\"";
				$have++;
			}
			if(isset($_POST['compagnie'])) {
				$compagnie = $_POST['compagnie'];
				$array[] = "C.compagnie like \"%$compagnie%\"";
				$have++;
			}
			if(isset($_POST['ville'])) {
				$ville = $_POST['ville'];
				$array[] = "C.ville like \"%$ville%\"";
				$have++;
			}
			
			if($have == 0) {
				$query = "select C.*, count(S.num_salle) as nb_salle 
				from Cinema C, Salle S 
				where S.nom_du_cinema = C.nom group by C.nom 
				UNION select C.*, 0 as nb_salle 
				from Cinema C 
				where C.nom NOT IN (
				select C.nom 
				from Cinema C, Salle S 
				where S.nom_du_cinema = C.nom 
				group by C.nom
				having count(S.num_salle) > 0);";
			}
			else {
				$query = "select C.*, count(S.num_salle) as nb_salle 
				from Cinema C, Salle S 
				where S.nom_du_cinema = C.nom and ";
				$tmp = " " . $array[$have-1];
				$have--;
				while($have > 0) {
					$tmp = $tmp . " and " . $array[$have-1];
					$have--;
				}
				$query = $query . $tmp . " group by C.nom UNION select C.*, 0 as nb_salle 
				from Cinema C 
				where C.nom NOT IN (
				select C.nom 
				from Cinema C, Salle S 
				where S.nom_du_cinema = C.nom
				group by C.nom
				having count(S.num_salle) > 0) and ";
				$query = $query . $tmp . ";";
			}
			/* SURTUOT NE PAS EFFACER */
			
			$result = $link->query($query) or die("erreur select");
			
			print "<h2><a name=\"resultat\">Résultat :</a></h2>";
			
			if(isset($_GET['modif']) and isset($_GET['nom'])) {
				$nom = $_GET['nom'];
				print "Le cinema $nom existe déjà";
			}
			if(isset($_GET['suppr']) and isset($_GET['nom'])) {
				$nom = $_GET['nom'];
				print "impossible de supprimer le cinéma $nom";
			}
			
			print "<table border><tr><th>Nom</th><th>Compagnie</th><th>Ville</th><th>Nb salle</th></tr>";
			$nb_res = 0;
			while($tuple = mysqli_fetch_object($result)) {
				$nb_res++;
				print "
					<tr>
					<form method=\"POST\" action=\"modifier_cinema.php\">
						<input type=\"text\" value=\"$tuple->nom\" name\"ancien_nom\" hidden>
						<td><input type=\"text\" value=\"$tuple->nom\" name=\"nom\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td>
						<td><input type=\"text\" value=\"$tuple->compagnie\" name=\"compagnie\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td>
						<td><input type=\"text\" value=\"$tuple->ville\" name=\"ville\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td>
						<td><input type=\"text\" value=\"$tuple->nb_salle\" size=\"5\" readonly></td>
						<td><input type=\"submit\" value=\"modifier\"></td>
					</form>
					<form method=\"POST\" action=\"supprimer_cinema.php\">
						<td><input type=\"text\" value=\"$tuple->nom\" name=\"nom\" hidden>
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
				print "impossible d'insérer ce cinéma";
			}
		?>
		<table border>
			<form method="POST" action="inserer_cinema.php">
				<tr><th>Nom</th><th>Compagnie</th><th>Ville</th></tr>
				<tr>
					<td><input type="text" name="nom" minlength="3" maxlength="30" placeholder="3 - 30 caractères"></td>
					<td><input type="text" name="compagnie" minlength="3" maxlength="30" placeholder="3 - 30 caractères"></td>
					<td><input type="text" name="ville" minlength="3" maxlength="30" placeholder="3 - 30 caractères"></td>
					<td><input type="submit" value="insérer"></td>
				</tr>
			</form>
		</table>
	</body>
</html>
