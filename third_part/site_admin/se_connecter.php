<html>
	<title>admin</title>
	<body>
		<p>Bienvenue sur la page d'administration</p>
		<p>Veillez entrer vos identifiants:</p>
		<form method="POST" action="connection.php">
			<input type="text" name="id" minlength="3" maxlength="10" placeholder="3 - 10 caractères">
			<input type="password" name="mdp" minlength="3" maxlength="10" placeholder="3 - 10 caractères">
			<input type="submit" value="Se connecter">
		</form>
		<?php
			if(isset($_GET['erreur'])) {
				print "<p>mot de passe ou login incorrect</p>";
			}
		?>
	</body>
</html>
