<html>
	<head>
		<title>Se connecter</title>
		<link rel="stylesheet" href="../css/input.css">
	</head>
	<body>
		<div class = "contenu">
		<form method="POST" action="inscrire.php">
			<table>
				<tr>
				<td>Nom : </td>
				<td><input type="text" name="nom" minlength="3" maxlength="10" placeholder="3 - 10 caractères"></td>
				</tr>
				<tr>
				<td>Prenom : </td>
				<td><input type="text" name="prenom" minlength="3" maxlength="10" placeholder="3 - 10 caractères"></td>
				</tr>
				<tr>
				<td>email : </td>
				<td><input type="text" name="email" minlength="11"></td>
				</tr>
				<tr>
				<td>Mot de passe : </td>
				<td><input type="password" name="mdp" minlength="3" maxlength="16" placeholder="3 - 16 caractères"></td>
				</tr>
			</table>
			<input type="Submit" value="S'inscrire"><input type="reset">
		</form>
		<?php
			if(isset($_GET['not'])) {
				$not = $_GET['not'];
				if ($not == 1){
						print "<div id=\"erreur\">Cet adresse email existe déjà</div>";
				}
			}
		?>
			<a href="index.php">Retour au menu principal</a>
		</div>
	</body>
</html>
