<?php
	/*
	 * Ce fichier sert à réinitialiser les variables de session.
	 * L'utilisateur est ensuite redirigé vers le formulaire.
	 */
	session_start();
	$_SESSION['login'] = 1;
	$_SESSION['password'] = true;
	$_SESSION['captcha'] = true;
	$_SESSION['nomLogin'] = "";
	header("Location: formulaire.php");
	exit;
?>