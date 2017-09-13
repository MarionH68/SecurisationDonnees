<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Sécurisation d'un formulaire</title>
		<link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet">
		<link href="bootstrap/dist/css/tuto.css" rel="stylesheet">
    </head>

    <body>
		<br><br>
		
		<div>
			<div class="col-lg-1"></div>
			
			<form class="col-lg-3" method="post" action="safe.php"> 
			  <legend>Formulaire sécurisé</legend>
				<div class="form-group">
				  <label for="texte">Login : </label>
				  <input id="loginS" name="loginS" type="text" class="form-control">
				</div>
				<div class="form-group">
				  <label for="texte">Password : </label>
				  <input id="passwordS" name="passwordS" type="password" class="form-control">
				</div>
				<button type="submit" class="btn btn-primary">Sign in</button>
			</form>
			
			<div class="col-lg-1"></div>
			
			
			<form class="col-lg-3"method="post" action="notsafe.php"> 
			  <legend>Formulaire non-sécurisé</legend>
				<div class="form-group">
				  <label for="texte">Login : </label>
				  <input id="loginNS" name="loginNS" type="text" class="form-control">
				</div>
				<div class="form-group">
				  <label for="texte">Password : </label>
				  <input id="passwordNS" name="passwordNS" type="password" class="form-control">
				</div>
				<button type="submit" class="btn btn-primary">Sign in</button>
			</form>
		</div>
    </body>
</html>