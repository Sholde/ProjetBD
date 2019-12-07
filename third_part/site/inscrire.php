<?php	
	/* variable */
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];
	$mdp = $_POST['mdp'];
	
	/* connexion serveur */
	$link = new mysqli("localhost", "Client", "client");
	if($link->connect_errno) {
		    die ("Erreur de connexion : errno: " . $link->errno . " error: "  . $link->error);
	}
	
	/* connexion bd */
	$link->select_db('Projet') or die("Erreur de selection de la BD: " . $link->error);
	
	/* requete qui renvoie le tuple du client avec l' email $email */
	$query = "Select * from Clients where email = '$email';";
	$result = $link->query($query) or die("erreur select");
	
	$email_exist = mysqli_fetch_object($result);
	
	/* Si il n'y a pas de tuple */
	/* c-a-d qu' aucun client a l'addresse mail $email */
	if(!$email_exist) {
		$query = "Select max(num_client) as num_client from Clients;";
		$result = $link->query($query) or die("erreur select");
		
		$tuple = mysqli_fetch_object($result);
		
		$num = $tuple->num_client + 1;
	
		$query = "insert into Clients value ($num, '$nom', '$prenom', '$email', '$mdp', 0);";
		$link->query($query) or die("erreur insert");
	}
	else {
		header("Location: formulaire_inscription.php?not=1");
		exit();
	}
	
	$link->close();
	header("Location: index.php");
	exit();
?>
