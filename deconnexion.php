<?php
	session_start();
	$_SESSION['login'] = 1;
	$_SESSION['password'] = true;
	$_SESSION['captcha'] = true;
	$_SESSION['nomLogin'] = "";
	header("Location: formulaire.php");
	exit;
?>