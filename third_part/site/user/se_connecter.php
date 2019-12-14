<html>
	<head>
		<title>Se connecter</title>
		<link rel="stylesheet" href="../css/input.css">
	</head>
	<body>
		<div class = "contenu">
		<form method="POST" action="connecte.php">
			<table>
				<tr>
				<td>email</td>
				<td><input type="text" name="email" minlength="11"></td>
				</tr>
				<tr>
				<td>Mot de passe </td>
				<td><input type="password" name="mdp" minlength="3" maxlength="16" placeholder="3 - 16 caractères"></td>
				</tr>
			</table>
			<input type="Submit" value="Se connecter"><input type="reset">
		</form>
		<a href="formulaire_inscription.php">crée un compte</a>
		<?php
			if(isset($_GET['not'])) {
				$not = $_GET['not'];
				if ($not == 1){
						print "<div id=\"erreur\">email ou mot de passe incorrect</div>";
				}
			}
		?>
		</div>
	</body>
</html>
