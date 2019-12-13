<html>
	<head>
		<title>Client</title>
	</head>	
	<body>
		<h2>Recherche :</h2>
		<form method="POST" action="client.php">
			<table>
				<tr>
				<td>Numero :</td>
				<td><input type="text" name="num" size="5" maxlength="7"></td>
				</tr>
				<tr>
				<td>Nom :</td>
				<td><input type="text" name="nom"></td>
				</tr>
				<td>Prenom :</td>
				<td><input type="text" name="prenom"></td>
				</tr>
				<td>email :</td>
				<td><input type="text" name="email"></td>
				</tr>
				<td>Réduction :</td>
				<td><input type="radio" name="reduc" value="1">oui<br>
				<input type="radio" name="reduc" value="0">non<br>
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
				$array[] = "num_client = $num";
				$have++;
			}
			if(isset($_POST['nom'])) {
				$nom = $_POST['nom'];
				$array[] = "nom like \"%$nom%\"";
				$have++;
			}
			if(isset($_POST['prenom'])) {
				$prenom = $_POST['prenom'];
				$array[] = "prenom like \"%$prenom%\"";
				$have++;
			}
			if(isset($_POST['email'])) {
				$email = $_POST['email'];
				$array[] = "email like \"%$email%\"";
				$have++;
			}
			if(isset($_POST['reduc'])) {
				$reduc = $_POST['reduc'];
				$array[] = "reduction = $reduc";
				$have++;
			}
			
			if($have == 0) {
				$query = "select * from Clients;";
			}
			else {
				$query = "select * from Clients where ";
				$query = $query . " " . $array[$have-1];
				$have--;
				while($have > 0) {
					$query = $query . " and " . $array[$have-1];
					$have--;
				}
				$query = $query . " ;" ;
			}
			print "$query";
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
					<form method=\"POST\" action=\"modifier_client.php?num_client=$tuple->num_client\">
						<td><input type=\"text\" value=\"$tuple->num_client\" name=\"num_client\" size=\"2\" minlength=\"1\" placeholder=\"min 1\"></td>
						<td><input type=\"text\" value=\"$tuple->nom\" name=\"nom\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td>
						<td><input type=\"text\" value=\"$tuple->prenom\" name=\"prenom\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td>
						<td><input type=\"text\" value=\"$tuple->email\" name=\"email\" minlenght=\"11\"></td>
						<td><input type=\"text\" value=\"$tuple->mot_de_passe\" name=\"mdp\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td>
				";
				if($tuple->reduction) {
					print "
						<td><input type=\"radio\" value=\"1\" name=\"reduc\" size=\"1\" checked> oui</td>
						<td><input type=\"radio\" value=\"0\" name=\"reduc\" size=\"1\"> non</td>
					";
				}
				else {
					print "
						<td><input type=\"radio\" value=\"1\" name=\"reduc\" size=\"1\"> oui</td>
						<td><input type=\"radio\" value=\"0\" name=\"reduc\" size=\"1\" checked> non</td>
					";
				}
				print "
					<td><input type=\"submit\" value=\"modifier\"></td>
					</form>
					<form method=\"POST\" action=\"supprimer_client.php\">
					<td><input type=\"text\" value=\"$tuple->num_client\" name=\"num_client\" hidden>
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
	</body>
</html>
