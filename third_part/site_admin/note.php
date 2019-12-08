<html>
	<head>
		<title>Film</title>
	</head>	
	<body>
		<h2>Recherche :</h2>
		<form method="POST" action="note.php">
			<table>
				<tr>
				<td>Email client:</td>
				<td><input type="text" name="email" minlength="3"></td>
				</tr>
				<tr>
				<td>Nom film:</td>
				<td><input type="text" name="nom" minlength="3"></td>
				</tr>
				<tr>
				<td>Note :</td>
				<td><input type="number" name="note" min="0" max="5">
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
			
			if(isset($_POST['email'])) {
				$email = $_POST['email'];
				$array[] = "C.email like \"%$email%\"";
				$have++;
			}
			if(isset($_POST['nom'])) {
				$nom = $_POST['nom'];
				$array[] = "F.nom like \"%$nom%\"";
				$have++;
			}
			if(isset($_POST['note']) and is_numeric($_POST['note'])) {
				$note = $_POST['note'];
				$array[] = "note = $note";
				$have++;
			}
			
			if($have == 0) {
				$query = "select F.num_film as num_film, F.nom as nom_film, C.num_client as num_client, C.email as email, N.note as note from Clients C, Film F, Note N where F.num_film = N.num_film and C.num_client = N.num_client;";
			}
			else {
				$query = "select F.num_film as num_film, F.nom as nom_film, C.num_client as num_client, C.email as email, N.note as note from Clients C, Film F, Note N where F.num_film = N.num_film and C.num_client = N.num_client and ";
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
					<form method=\"POST\" action=\"modifier_note.php?num_film=$tuple->num_film&num_client=$tuple->num_client\">
						<td><input type=\"text\" value=\"$tuple->num_film\" name=\"num_film\" size=\"2\" minlength=\"1\" placeholder=\"min 1\"></td>
						<td><input type=\"text\" value=\"$tuple->nom_film\" name=\"nom_film\" minlength=\"3\" maxlength=\"30\" placeholder=\"3 - 30 caractères\"></td>
						<td><input type=\"text\" value=\"$tuple->num_client\" name=\"num_client\" size=\"2\" minlength=\"1\" placeholder=\"min 1\"></td>
						<td><input type=\"text\" value=\"$tuple->email\" name=\"email\" minlength=\"11\" maxlength=\"256\"></td>
						<td><input type=\"number\" value=\"$tuple->note\" name=\"note\" min=\"0\" max=\"5\"></td>
						<td><input type=\"submit\" value=\"modifier\"></td>
						</form>
						<form method=\"POST\" action=\"supprimer_note.php\">
						<td><input type=\"text\" value=\"$tuple->num_film\" name=\"num_film\" hidden>
						<input type=\"text\" value=\"$tuple->num_client\" name=\"num_client\" hidden>
						<input type=\"submit\" value=\"supprimer\">
						</td>
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
			<td><input type="text" name="num_client" size="2" minlength="1" placeholder="min 1"></td>
			<td><input type="number" name="note" min="0" max=5"></td>
			<td><input type="submit" value="insérer"></td>
			</form>
		</table>
	</body>
</html>
