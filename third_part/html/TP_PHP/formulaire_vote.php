<html>
	<head>
		<title>Formulaire</title>
	</head>
	<body>
		<form method="POST" action="insert_vote.php">
			<table>
				<tr>
				<td>Nom Candidat: </td>
				<td><?php
						
						$link = new mysqli("localhost", "user", "user");
						if($link->connect_errno) {
								die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
						}
						
						$link->select_db('bdphp') or die("Erreur de selection de la BD: " . $link->error);
						
						$query = "SELECT CandidatId, Nom FROM candidats";
						$result = $link->query($query);
						
						while ($tuple = mysqli_fetch_object($result)){ 
							print "<input type=\"radio\" name=\"rad\" value=\"$tuple->CandidatId\">$tuple->Nom<br>";
						}

						$link->close();
					?>
				</td>
				</tr>
				<tr>
				<td>VotantID: </td>
				<td><input type="text" name="vid"></td>
				</tr>
				<tr>
				<tr>
				<td>Password: </td>
				<td><input type="password" name="pw"></td>
				</tr>
				<tr>
			</table>
			<input type="submit" value="Submit"><input type="reset"><br>
			<a href="index.html">acceuil</a>
		</form>
	</body>
</html>
