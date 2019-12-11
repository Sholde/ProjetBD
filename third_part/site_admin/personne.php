<html>
	<head>
		<title>Personne</title>
	</head>	
	<body>
		<h2>Recherche :</h2>
		<form method="POST" action="personne.php">
			<table>
				<tr>
				<td>Nom :</td>
				<td><input type="text" name="nom" maxlength="30"></td>
				</tr>
				<tr>
				<td>Prenom :</td>
				<td><input type="text" name="prenom" maxlength="30"></td>
				</tr>
				<tr>
				<td>Age :</td>
				<td><input type="text" name="age" size="5" maxlength="3">ans</td>
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
				$array[] = "P.nom like \"%$nom%\"";
				$have++;
			}
			if(isset($_POST['prenom'])) {
				$prenom = $_POST['prenom'];
				$array[] = "P.prenom like \"%$prenom%\"";
				$have++;
			}
			if(isset($_POST['age']) and is_numeric($_POST['age'])) {
				$age = $_POST['age'];
				$array[] = "P.age = $age";
				$have++;
			}
			
			if($have == 0) {
				$query = "select * from Personne P;";
			}
			else {
				$query = "select * from Personne P where ";
				$tmp = " " . $array[$have-1];
				$have--;
				while($have > 0) {
					$tmp = $tmp . " and " . $array[$have-1];
					$have--;
				}
				$query = $query . $tmp . " group by P.num_personne;";
			}
			/* SURTUOT NE PAS EFFACER */
			
			$result = $link->query($query) or die("erreur select");
			
			print "<h2><a name=\"resultat\">Résultat :</a></h2>";
			
			/* gestion erreur modif */
			if(isset($_GET['modif']) and isset($_GET['nom']) and isset($_GET['prenom'])) {
				$nom = $_GET['nom'];
				$prenom = $_GET['prenom'];
				print "La personne $nom $prenom existe déjà";
			}
			
			if(isset($_GET['suppr'])) {
				if(isset($_GET['nom']) and isset($_GET['prenom'])) {
					$nom = $_GET['nom'];
					$prenom = $_GET['prenom'];
					print "impossible de supprimer la personne $nom $prenom";
				}
			}
			
			print "<table border><tr><th>Nom</th><th>Prenom</th><th>Age</th></tr>";
			$nb_res = 0;
			while($tuple = mysqli_fetch_object($result)) {
				$nb_res++;
				print "
					<tr>
					<form method=\"POST\" action=\"modifier_personne.php\">
						<td><input type=\"text\" value=\"$tuple->nom\" name=\"nom\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td>
						<td><input type=\"text\" value=\"$tuple->prenom\" name=\"prenom\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td>
						<td><input type=\"text\" value=\"$tuple->age\" name=\"age\" size=\"5\" minlength=\"1\" placeholder=\"min 1\"></td>
						<input type=\"text\" value=\"$tuple->num_personne\" name=\"num\" hidden>
						<td><input type=\"submit\" value=\"modifier\"></td>
					</form>
					<form method=\"POST\" action=\"supprimer_personne.php\">
						<td><input type=\"text\" value=\"$tuple->num_personne\" name=\"num\" hidden>
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
			if(isset($_GET['inser']) and isset($_GET['nom']) and isset($_GET['prenom'])) {
				$nom = $_GET['nom'];
				$prenom = $_GET['prenom'];
				print "impossible d'insérer la personne $nom $prenom";
			}
		?>
		<table border>
			<form method="POST" action="inserer_personne.php">
				<tr><th>Nom</th><th>Prenom</th><th>Age</th></tr>
				<tr>
					<td><input type="text" name="nom" minlength="3" maxlength="30" placeholder="3 - 30 caractères"></td>
					<td><input type="text" name="prenom" minlength="3" maxlength="30" placeholder="3 - 30 caractères"></td>
					<td><input type="text" name="age" size="5" minlength="1" placeholder="min 1"></td>
					<td><input type="submit" value="insérer"></td>
				</tr>
			</form>
		</table>
	</body>
</html>
