<html>
	<head>
		<title>Se connecter</title>
	</head>
	<body>
		<form method="POST" action="inscrire.php">
			<table>
				<tr>
				<td>Nom : </td>
				<td><input type="text" name="nom"></td>
				</tr>
				<tr>
				<td>Prenom : </td>
				<td><input type="text" name="prenom"></td>
				</tr>
				<tr>
				<td>email : </td>
				<td><input type="text" name="email"></td>
				</tr>
				<tr>
				<td>Mot de passe : </td>
				<td><input type="password" name="mdp"></td>
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
	</body>
</html>
