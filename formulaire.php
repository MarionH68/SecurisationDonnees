<!DOCTYPE html>
<?php
	$siteKey = '6LcVnTAUAAAAAGIqEzqNZ8pvMcMMv0f-EYdI7UTR'; //clé publique de la captcha google
	$secret = '6LcVnTAUAAAAAIWUUKEud6RzSkSE2qUrm--Mw9Jj'; //clé secréte de la captcha google
	require 'recaptchalib.php';
	session_start();
?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Sécurisation d'un formulaire</title>
		<link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet">
		<link href="bootstrap/dist/css/tuto.css" rel="stylesheet">
		<script src="https://www.google.com/recaptcha/api.js"></script>
    </head>

    <body>
		<br><br>
		
		<div>
			<div class="col-lg-1"></div>
			<?php echo $_SESSION['login'] ?>
			<form class="col-lg-3" method="post" action="safe.php"> 
			  <legend>Formulaire sécurisé</legend>
				<div class="form-group">
					<?php
						if($_SESSION['login'] == true){ ?>
						<label for="texte">Login : </label>
						<input id="loginS" name="loginS" type="text" class="form-control">
					<?php }
						else{ ?>
						<div class="form-group has-error has-feedback">
						  <label class="control-label" for="idError">Login</label>
						  <input name="loginS" type="text" class="form-control" id="idError">
						  <span class="glyphicon glyphicon-remove form-control-feedback"></span>
						  <span class="help-block">Corrigez l'erreur s'il vous plait</span>
						</div>
					<?php } ?>
				</div>
				<div class="form-group">
				  <label for="texte">Password : </label>
				  <input id="passwordS" name="passwordS" type="password" class="form-control">
				</div>
				<div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
				<button type="submit" name="SignIn" class="btn btn-primary">Sign in</button>
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
				<button type="submit" name="SignIn" class="btn btn-primary">Sign in</button>
				<button type="submit" name="dico" class="btn btn-danger">Attaque dictionnaire</button>
			</form>
		</div>
    </body>
</html>