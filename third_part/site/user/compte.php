<?php
	session_start();
	$email_client = $_SESSION['session'];
	
	print "<html><head><title>Compte</title> <link rel=\"stylesheet\" href=\"../css/input.css\"></head><body>";
	
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	$query = "Select * from Clients where email = '$email_client';";
	$result = $link->query($query) or die("erreur select");
	
	$tuple = mysqli_fetch_object($result);
	print "	<div class = \"contenu\">";
	print "<form method=\"POST\" action=\"change_compte.php\">";
	print "<table>";
	print "
			<h3>Paramètre du compte</h3>
			<tr>
			<td>Nom : </td>
			<td><input type=\"text\" value=\"$tuple->nom\" name=\"nom\" minlength=\"3\" maxlength=\"10\" placeholder=\"3 - 10 caractères\"></td>
			</tr>
			<tr>
			<td>Prénom : </td>
			<td><input type=\"text\" value=\"$tuple->prenom\" name=\"prenom\" minlength=\"3\" maxlength=\"10\" placeholder=\"3 - 10 caractères\"></td>
			</tr>
			<tr>
			<td>email : </td>
			<td><input type=\"text\" value=\"$tuple->email\" name=\"email\"  minlength=\"11\"></td>
			</tr>
			<tr>
			<td>Mot de passe : </td>
			<td><input type=\"text\" value=\"$tuple->mot_de_passe\" name=\"mdp\" minlength=\"3\" maxlength=\"16\" placeholder=\"3 - 16 caractères\"></td>
			</tr>
			<tr>
			<td>Réduction : </td>";
			if($tuple->reduction)
			{
				print "<td><input type=\"text\" value=\"oui\" size=\"1\"  disabled></td>";
			}
			else 
			{
				print "<td><input type=\"text\" value=\"non\" size=\"1\"  disabled></td>";
			}
			print "</tr>";
	
	print "</table>";
	print "<input type=\"submit\" value=\"valider\">";
	print "</form>";
	
	/* affiche si l'utilisateur met un email déjà existant */
	if(isset($_GET['not'])) {
		$not = $_GET['not'];
		if ($not == 1){
			print "<div class=\"erreur\">Cet adresse email existe déjà</div>";
		}
	}
	
	$link->close();
	print "</div>";
	print "</body></html>";
?>
