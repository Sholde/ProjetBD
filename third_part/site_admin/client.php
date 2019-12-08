<html>
	<head>
		<title>Reserve ta place : elem</title>
	</head>	
	<body>
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
		
			$query = "select * from Clients;";
			$result = $link->query($query) or die("erreur select");
			
			if(isset($_GET['modif'])) {
				$num = $_GET['modif'];
				print "erreur modification du numero $num";
			}
			print "<table border>";
			while($tuple = mysqli_fetch_object($result)) {
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
		?>
	</body>
</html>
