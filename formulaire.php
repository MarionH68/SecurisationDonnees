<?php
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
		<br><br>
		
		<div>
			<div class="col-lg-1"></div>
			<form class="col-lg-3" method="post" action="safe.php"> 
			  <legend>Formulaire sécurisé</legend>
				<div class="form-group">
					<?php
						if($_SESSION['login'] == 1){ ?>
						<label for="texte">Login : </label>
						<input id="loginS" name="loginS" type="text" class="form-control">
					<?php }
						else if( $_SESSION['login'] == 2){ ?>
							<div class="form-group has-success has-feedback">
							  <label class="control-label" for="idSuccess">Login</label>
							  <input id="loginS" name="loginS" type="text" class="form-control" value="<?php echo $_SESSION['nomLogin'] ?>">
							  <span class="glyphicon glyphicon-ok form-control-feedback"></span>
							</div>
					<?php }	
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
						if($_SESSION['password'] == true){ ?>
						<label for="texte">Password : </label>
						<input id="passwordS" name="passwordS" type="password" class="form-control">
					<?php }
						else{ ?>
						<div class="form-group has-error has-feedback">
						  <label class="control-label" for="idError">Password</label>
						  <input name="passwordS" type="password" class="form-control" id="idError">
						  <span class="glyphicon glyphicon-remove form-control-feedback"></span>
						  <span class="help-block">Wrong password</span>
						</div>
					<?php } ?>
				</div>
				
				<div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
				<?php if($_SESSION['captcha'] == false){ ?>
					<div class="alert alert-danger">
						<strong>Error !</strong> Click on the captcha.
					</div>
				<?php }?>
				<br>
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
				<a href="changementMotDePasse.php">Mot de pass oublié ? </a>
				
			</form>
		</div>
    </body>
</html>