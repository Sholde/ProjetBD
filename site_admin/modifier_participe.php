<?php
	session_start();
	if(!isset($_SESSION['admin']))  {
		header("Location: se_connecter.php");
		exit();
	}
	
	if(!isset($_GET['num_film']))  {
		header("Location: participe.php#resultat");
		exit();
	}
	
	if(!isset($_POST['Directeur']) and !isset($_POST['Scénariste']) and !isset($_POST['Acteur'])) {
		header("Location: participe.php?modif=1&erreur=metier#resultat");
		exit();
	}
	
	$ancien_num_film = $_GET['num_film'];
	$ancien_num_personne = $_GET['num_personne'];
	
	$nom_film = $_POST['nom_film'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$metier = "";
	$count = 0;
	if(isset($_POST['Directeur'])) {
		if($count)
			$metier = $metier . " - " . $_POST['Directeur'];
		else
			$metier = $_POST['Directeur'];
		$count++;
	}
	if(isset($_POST['Scénariste'])) {
		if($count)
			$metier = $metier . " - " . $_POST['Scénariste'];
		else
			$metier = $_POST['Scénariste'];
		$count++;
	}
	if(isset($_POST['Acteur'])) {
		if($count)
			$metier = $metier . " - " . $_POST['Acteur'];
		else
			$metier = $_POST['Acteur'];
		$count++;
	}
			
	$link = new mysqli("localhost", "Admin", "admin");
	if($link->connect_errno) {
		die ("erreur connection");
	}
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	/* num film */
	$query = "select F.num_film from Film F where F.nom = '$nom_film'";
	$result = $link->query($query) or die("erreur select");
	$tuple = mysqli_fetch_object($result);
	if(!$tuple) {
		$result->close();	
		$link->close();
		header("Location: participe.php?modif=1&erreur=film#resultat");
		exit();
	}
	$num_film = $tuple->num_film;
	
	/* num personne */
	$query = "select P.num_personne from Personne P where P.nom = '$nom' and P.prenom = '$prenom'";
	$result = $link->query($query) or die("erreur select");
	$tuple = $tuple = mysqli_fetch_object($result);
	if(!$tuple) {
		$result->close();	
		$link->close();
		header("Location: participe.php?modif=1&erreur=personne#resultat");
		exit();
	}
	$num_personne = $tuple->num_personne;
	
	$query = "update Participe_au_film set num_film = $num_film, num_personne = $num_personne, metier = '$metier' where num_film = $ancien_num_film and num_personne = $ancien_num_personne;";
	if(!$link->query($query)) {
		$result->close();	
		$link->close();
		header("Location: participe.php?modif=1&num_personne=$ancien_num_personne&num_film=$ancien_num_film#resultat");
		exit();
	}
	else {
		$result->close();	
		$link->close();
		header("Location: participe.php#resultat");
		exit();
	}
?>
