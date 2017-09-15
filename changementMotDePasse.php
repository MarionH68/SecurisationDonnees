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

		<form class="col-lg-3" method="post" action="envoiMail.php"> 
		  <legend>Formulaire non-sécurisé</legend>
			<div class="form-group">
			  <label for="texte">Login : </label>
			  <input id="loginNS" name="login" type="text" class="form-control">
			</div>
			<div class="form-group">
			  <label for="texte">Adresse Mail : </label>
			  <input id="passwordNS" name="mail" type="text" class="form-control">
			</div>
			<button type="submit" name="Validate" class="btn btn-primary">Valider</button>
		</form>
	</body>
</html>	