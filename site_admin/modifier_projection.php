<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	$num_se_joue = $_POST['num_se_joue'];
	$jour = $_POST['jour'];
	$version = $_POST['version'];
	$nom_film = $_POST['nom_film'];
	$num_salle = $_POST['num_salle'];
	$nom_cinema = $_POST['nom_cinema'];
	
	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
	}
	
	if(!validateDate($jour)) {
		header("Location: projection.php?modif=1&erreur=jour#resultat");
		exit();
	}
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	/* cherche si le film existe */
	$query = "select F.num_film from Film F where F.nom = '$nom_film'";
	$result = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	if(!$tuple) {
		$result->close();	
		$link->close();
		header("Location: projection.php?modif=1&erreur=film#resultat");
		exit();
	}
	$num_film = $tuple->num_film;
	
	/* cherche si la salle existe */
	$query = "select S.num_salle, S.nom_du_cinema from Salle S where S.num_salle = '$num_salle' and S.nom_du_cinema = '$nom_cinema'";
	$result = $link->query($query) or die("erreur select");
	$tuple = $tuple = mysqli_fetch_object($result);
	if(!$tuple) {
		$result->close();	
		$link->close();
		header("Location: projection.php?modif=1&erreur=salle#resultat");
		exit();
	}
	
	$date = new DateTime($jour);
	$date->add(new DateInterval('PT3H'));
	$three_hours_after = $date->format('Y-m-d H:i:s');
	echo $three_hours_after;
	echo $jour;
	
	/* regarde si a ce jour et cette heure la salle est dispo */
	$query = "select J.* from Se_joue_dans J where J.num_se_joue <> $num_se_joue and J.jour >= '$jour' and J.jour <= '$three_hours_after' and J.num_salle = $num_salle and J.nom_du_cinema = '$nom_cinema';";
	$result = $link->query($query) or die("erreur select ici");
	$tuple = $tuple = mysqli_fetch_object($result);
	if($tuple) {
		$result->close();	
		$link->close();
		header("Location: projection.php?modif=1&erreur=dispo&jour=$jour&salle=$num_salle&nom=$nom_cinema#resultat");
		exit();
	}
	
	$query = "update Se_joue_dans set num_film = $num_film, num_salle = $num_salle, nom_du_cinema = '$nom_cinema', version = '$version', jour = '$jour' where num_se_joue = $num_se_joue;";
	if(!$link->query($query)) {
		$result->close();	
		$link->close();
		header("Location: projection.php?modif=1&num=$num_se_joue#resultat");
		exit();
	}
	else {
		$result->close();	
		$link->close();
		header("Location: projection.php#resultat");
		exit();
	}
?>
