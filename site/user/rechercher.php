<html>
	<head>
		<title>Réserver une place</title>
	</head>
	<body>
		<form method="POST" action="calcul.php">
			<table>
				<tr>
				<td>Nom du cinéma : </td>
				<td><input type="text" name="cine"></td>
				</tr>
				<tr>
				<td>Nom du film : </td>
				<td><input type="text" name="film"></td>
				</tr>
				<tr>
				<td>Date : </td>
				<td><input type="text" minlength="2" maxlength="2" size="1"> -
						<input type="text" minlength="2" maxlength="2" size="1"> -
						<input type="text" minlength="4" maxlength="4" size="2"></td>
				</tr>
				<tr>
				<td>Nombre de place a acheté : </td>
				<td><input type="text" name="place"></td>
				</tr>
			</table>
			<input type="submit" value="rechercher">
		</form>
	</body>
</html>
