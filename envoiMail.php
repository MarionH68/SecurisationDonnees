<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "banque";
	//Récupération des variables envoyées par le formulaire
	$login = $_POST['login'];
	$mail = $_POST['mail'];


	//Connexion à la base de données en PDO
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected successfully"; 
		}
	catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
		}
		
	$resLogin = $conn->prepare("SELECT * FROM users WHERE users.login = ?"); 
	$resLogin->execute(array($login));
	$verifLogin = $resLogin->fetchAll();
	if(count($verifLogin) == 0){
		$_SESSION['login'] = 0;
		header("Location: changementMotDePasse.php");
		exit;
	}
	$message = "Bonjour c''est un test";
	
	mail($mail,'sujet',$message);
		
?>		