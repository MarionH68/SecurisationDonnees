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
			
			<form class="col-lg-3">
			  <legend>Formulaire sécurisé</legend>
				<div class="form-group">
				  <label for="texte">Login : </label>
				  <input id="login" type="text" class="form-control">
				</div>
				<div class="form-group">
				  <label for="texte">Password : </label>
				  <input id="password" type="password" class="form-control">
				</div>
				<button type="button" class="btn btn-primary">Sign in</button>
			</form>
			
			<div class="col-lg-1"></div>
			
			
			<form class="col-lg-3">
			  <legend>Formulaire non-sécurisé</legend>
				<div class="form-group">
				  <label for="texte">Login : </label>
				  <input id="login" type="text" class="form-control">
				</div>
				<div class="form-group">
				  <label for="texte">Password : </label>
				  <input id="password" type="password" class="form-control">
				</div>
				<button type="button" class="btn btn-primary">Sign in</button>
			</form>
		</div>
    </body>
</html>