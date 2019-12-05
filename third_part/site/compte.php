<?php
	session_start();
	$email_client = $_SESSION['session'];
	
	print "<html><head><title>Compte</title></head><body>";
	
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select * from Clients where email = '$email_client';";
	$result = $link->query($query) or die("erreur select");
	
	$tuple = mysqli_fetch_object($result);
	
	print "<form method=\"POST\" action=\"change_compte.php\">";
	print "<table>";
	print "
			<h3>Compte</h3>
			<tr>
			<td>Nom : </td>
			<td><input type=\"text\" value=\"$tuple->nom\" name=\"nom\"></td>
			</tr>
			<tr>
			<td>Prénom : </td>
			<td><input type=\"text\" value=\"$tuple->prenom\" name=\"prenom\"></td>
			</tr>
			<tr>
			<td>email : </td>
			<td><input type=\"text\" value=\"$tuple->email\" name=\"email\"></td>
			</tr>
			<tr>
			<td>Mot de passe : </td>
			<td><input type=\"text\" value=\"$tuple->mot_de_passe\" name=\"mdp\"></td>
	";
	
	/* affiche les réduction */
	$reduc = $tuple->reduction;
	if($reduc) {
		print "
			</tr>
			<tr>
			<td>Réduction : </td>
			<td>oui</td>
			</tr>
		";
	}
	else {
		print "
			</tr>
			<tr>
			<td>Réduction : </td>
			<td>non</td>
			</tr>
		";
	}
	
	print "</table>";
	print "<input type=\"submit\" value=\"valider\">";
	print "</form>";
	
	/* affiche si l'utilisateur met un email déjà existant */
	if(isset($_GET['not'])) {
		$not = $_GET['not'];
		if ($not == 1){
			print "<div id=\"email\">Cet adresse email existe déjà</div>";
		}
	}
	
	$link->close();
	
	print "</body></html>";
?>
