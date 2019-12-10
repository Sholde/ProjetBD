<html>
	<head>
		<title>Salle</title>
	</head>	
	<body>
		<h2><a name="recherche">Recherche :</a></h2>
		<form method="POST" action="participe.php">
			<table>
				<tr>
				<td>Nom du film :</td>
				<td><input type="text" name="nom_film" maxlength="30"></td>
				</tr>
				<tr>
				<td>Nom :</td>
				<td><input type="text" name="nom" maxlength="30"></td>
				</tr>
				<tr>
				<td>Prenom :</td>
				<td><input type="text" name="prenom" maxlength="30"></td>
				</tr>
				<tr>
				<td>Métier :</td>
				<td><input type="text" name="metier" maxlength="30"></td>
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
			
			if(isset($_POST['nom_film'])) {
				$nom_film = $_POST['nom_film'];
				$array[] = "F.nom like \"%$nom_film%\"";
				$have++;
			}
			if(isset($_POST['nom'])) {
				$nom = $_POST['nom'];
				$array[] = "P.nom like \"%$nom%\"";
				$have++;
			}
			if(isset($_POST['prenom'])) {
				$prenom = $_POST['prenom'];
				$array[] = "P.prenom like \"%$prenom%\"";
				$have++;
			}
			if(isset($_POST['metier'])) {
				$metier = $_POST['metier'];
				$array[] = "PA.metier like \"%$metier%\"";
				$have++;
			}
			
			if($have == 0) {
				$query = "select P.*, F.nom as nom_film, PA.* from Personne P, Film F, Participe_au_film PA where PA.num_film = F.num_film and PA.num_personne = P.num_personne order by F.nom ASC;";
			}
			else {
				$query = "select P.*, F.nom as nom_film, PA.* from Personne P, Film F, Participe_au_film PA where PA.num_film = F.num_film and PA.num_personne = P.num_personne and ";
				$tmp = " " . $array[$have-1];
				$have--;
				while($have > 0) {
					$tmp = $tmp . " and " . $array[$have-1];
					$have--;
				}
				$query = $query . $tmp . " order by F.nom ASC;";
			}
			/* SURTUOT NE PAS EFFACER */
			
			$result = $link->query($query) or die("erreur select");
			
			print "<h2><a name=\"resultat\">Résultat :</a></h2>";
			
			/* gestion erreur modif */
			if(isset($_GET['modif']) and isset($_GET['erreur']) and $_GET['erreur'] == "film") {
				print "ce film n'existe pas";
			}
			if(isset($_GET['modif']) and isset($_GET['erreur']) and $_GET['erreur'] == "personne") {
				print "cette personne n'existe pas";
			}
			else if(isset($_GET['modif']) and isset($_GET['num_personne']) and isset($_GET['num_film'])) {
				$ancien_num_personne = $_GET['num_personne'];
				$ancien_num_film = $_GET['num_film'];
				print "impossible de modifier la personne $ancien_num_personne pour le film $ancien_num_film";
			}
			
			print "<table border><tr><th>Nom Film</th><th>Nom</th><th>Prenom</th><th>Metier</th></tr>";
			$nb_res = 0;
			while($tuple = mysqli_fetch_object($result)) {
				$nb_res++;
				print "
					<tr>
					<form method=\"POST\" action=\"modifier_participe.php?num_personne=$tuple->num_personne&num_film=$tuple->num_film\">
						<td><input type=\"text\" value=\"$tuple->nom_film\" name=\"nom_film\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td>
						<td><input type=\"text\" value=\"$tuple->nom\" name=\"nom\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td>
						<td><input type=\"text\" value=\"$tuple->prenom\" name=\"prenom\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td>
						<td><input type=\"text\" value=\"$tuple->metier\" name=\"metier\" minlength=\"3\" maxlength=\"256\" placeholder=\"3 - 256 caractères\"></td>
						<td><input type=\"submit\" value=\"modifier\"></td>
					</form>
					<form method=\"POST\" action=\"supprimer_participe.php\">
						<td><input type=\"text\" value=\"$tuple->num_personne\" name=\"num_personne\" hidden>
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
			if(isset($_GET['inser']) and isset($_GET['erreur']) and $_GET['erreur'] == "film") {
				print "ce film n'existe pas";
			}
			if(isset($_GET['inser']) and isset($_GET['erreur']) and $_GET['erreur'] == "personne") {
				print "cette personne n'existe pas";
			}
			else if(isset($_GET['inser']) and isset($_GET['num_personne']) and isset($_GET['num_film'])) {
				$num_personne = $_GET['num_personne'];
				$num_film = $_GET['num_film'];
				print "impossible d'insérer la personne $num_personne pour le film $num_film";
			}
		?>
		<table border>
			<form method="POST" action="inserer_participe.php">
				<tr><th>Nom Film</th><th>Nom</th><th>Prenom</th><th>Metier</th></tr>
				<tr>
					<td><input type="text" name="nom_film" minlength="3" maxlength="30" placeholder="3 - 30 caractères"></td>
					<td><input type="text" name="nom" minlength="3" maxlength="30" placeholder="3 - 30 caractères"></td>
					<td><input type="text" name="prenom" minlength="3" maxlength="30" placeholder="3 - 30 caractères"></td>
					<td><input type="text" name="metier" minlength="3" maxlength="256" placeholder="3 - 256 caractères"></td>
					<td><input type="submit" value="insérer"></td>
				</tr>
			</form>
		</table>
	</body>
</html>
