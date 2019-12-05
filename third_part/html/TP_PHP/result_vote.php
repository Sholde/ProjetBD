<html>
	<head>
		<link rel="stylesheet" href="result_vote.css">
		<title>Formulaire</title>
	</head>
	<body>
		<?php
			print "<table><tr><td>Nom</td><td>%</td></tr>";
			
			$link = new mysqli("localhost", "user", "user");
			if($link->connect_errno) {
					die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
			}
			
			$link->select_db('bdphp') or die("Erreur de selection de la BD: " . $link->error);
			
			$query = "Select ca.Nom as nom, count(vo.VotantId)/(Select count(VotantId) from vote)*100 as pourcent from candidats ca, vote vo where ca.CandidatId = vo.CandidatId group by ca.Nom;";
			$result = $link->query($query) or die("erreur select");
			
			while ($tuple = mysqli_fetch_object($result)){ 
				print "<tr><td>$tuple->nom</td><td>$tuple->pourcent</td></tr>";
			}
			
			$link->close();
			
			print "</table>";
		?>
		<a href="index.html">acceuil</a>
	</body>
</html>
