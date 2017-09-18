<?php
	/*
	 * Ce fichier sert à réinitialiser les variables de session.
	 * L'utilisateur est ensuite redirigé vers le formulaire.
	 */
	session_start();
	$siteKey = '6LcVnTAUAAAAAGIqEzqNZ8pvMcMMv0f-EYdI7UTR'; //clé publique de la captcha google
	$secret = '6LcVnTAUAAAAAIWUUKEud6RzSkSE2qUrm--Mw9Jj'; //clé secréte de la captcha google
	require 'recaptchalib.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Sécurisation d'un formulaire</title>
		<link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet">
		<link href="bootstrap/dist/css/tuto.css" rel="stylesheet">
		<script src="https://www.google.com/recaptcha/api.js"></script>
    </head>

    <body>
		<br>
		<br>
		<div>
			<div class="col-lg-1"></div>
			<form class="col-lg-3" method="post" action="safe.php"> 
			  <legend>Formulaire sécurisé</legend>
				<div class="form-group">
					<?php
						/*
						 * Teste si le login a déjà été saisi dans le champs de texte.
						 * Si oui, l'interface reste celle de base.
						 */
						if($_SESSION['login'] == 1){ ?>
							<label for="texte">Login : </label>
							<input id="loginS" name="loginS" type="text" class="form-control">
					<?php }
						/*
						 * Teste si le login saisi est juste.
						 * Si oui, l'interface est changée et le login saisi reste dans le champs de texte.
						 */
						else if( $_SESSION['login'] == 2){ ?>
							<div class="form-group has-success has-feedback">
							  <label class="control-label" for="idSuccess">Login</label>
							  <input id="loginS" name="loginS" type="text" class="form-control" value="<?php echo $_SESSION['nomLogin'] ?>">
							  <span class="glyphicon glyphicon-ok form-control-feedback"></span>
							</div>
					<?php }	
						/*
						 * Teste si le login saisi est faux.
						 * Si oui, l'interface est changée.
						 */
						else{ ?>
							<div class="form-group has-error has-feedback">
							  <label class="control-label" for="idError">Login</label>
							  <input id="loginS" name="loginS" type="text" class="form-control" id="idError">
							  <span class="glyphicon glyphicon-remove form-control-feedback"></span>
							  <span class="help-block">Wrong login</span>
							</div>
					<?php } ?>
				</div>
				<div class="form-group">
					<?php
						/*
						 * Teste si le mot de passe saisi est juste.
						 * Si oui, l'interface n'est pas changée.
						 */
						if($_SESSION['password'] == true){ ?>
						<label for="texte">Password : </label>
						<input id="passwordS" name="passwordS" type="password" class="form-control">
					<?php }
						/*
						 * Teste si le mot de passe saisi est faux.
						 * Si oui, l'interface est changée.
						 */
						else{ ?>
						<div class="form-group has-error has-feedback">
						  <label class="control-label" for="idError">Password</label>
						  <input name="passwordS" type="password" class="form-control" id="idError">
						  <span class="glyphicon glyphicon-remove form-control-feedback"></span>
						  <span class="help-block">Wrong password</span>
						</div>
					<?php } ?>
				</div>
				
				<!-- Captcha Google -->
				<div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
				
				<?php if($_SESSION['captcha'] == false){ ?>
				    <!-- Teste si la captcha n'a pas été cliquée, si oui, le message d'erreur est affiché. -->
					<div class="alert alert-danger">
						<strong>Error !</strong> Click on the captcha.
					</div>
				<?php }?>
				<br>
				
				<!-- Le bouton "Sign in" sert à l'utilisateur à s'authentifier. -->
				<button type="submit" name="SignIn" class="btn btn-primary">Sign in</button>
				<!-- Le bouton "Attaque dictionnaire" sert à l'utilisateur à lancer le script d'attaque par dictionnaire. -->
				<button type="submit" name="dico" class="btn btn-danger">Attaque dictionnaire</button>
			</form>
			
			<div class="col-lg-1"></div>
			
			
			<form class="col-lg-3" method="post" action="notsafe.php"> 
			  <legend>Formulaire non-sécurisé</legend>
				<div class="form-group">
				  <label for="texte">Login : </label>
				  <input id="loginNS" name="loginNS" type="text" class="form-control">
				</div>
				<div class="form-group">
				  <label for="texte">Password : </label>
				  <input id="passwordNS" name="passwordNS" type="password" class="form-control">
				</div>
				
				<!-- Le bouton "Sign in" sert à l'utilisateur à s'authentifier. -->
				<button type="submit" name="SignIn" class="btn btn-primary">Sign in</button>
				<!-- Le bouton "Attaque dictionnaire" sert à l'utilisateur à lancer le script d'attaque par dictionnaire. -->
				<button type="submit" name="dico" class="btn btn-danger">Attaque dictionnaire</button>				
			</form>
		</div>
    </body>
</html>