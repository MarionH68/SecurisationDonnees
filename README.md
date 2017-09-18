# SecurisationDonnees
Projet de sécurisation des données d'une base SQL 
Implémenté par Simon Maillot et Marion Herrgott

---- 

Prérequis : 
Avant de lancer le projet, il faut lancer le script SQL afin d'avoir la base de données "banque" en local. 
Puis, il faudra ouvrir la page index.php sous localhost.
Ceci est essentiel pour que l'API Google Captcha fonctionne. 

----

Les failles WEB exploitées sont ici : 
- les injections SQL 
- la faille XSS
- l'attaque par dictionnaire

Le formulaire non sécurisé permet de : 
- rentrer du code SQL via les champs Login et Password qui sera ensuite interprêté par le PHP,
- lancer une alerte javascript <script> alert("Hello !"); </script> (tester sur le navigateur Microsoft Edge),
- faire une attaque brute force avec le bouton attaque par dictionnaire.

Le formulaire sécurisé : 
- n'interprête pas le code SQL entré dans les différents champs,
- vérifie qu'un login existe, et que le mot de passe saisi est juste et affiche un message d'erreur s'ils sont incorrects,
- demande à l'utilisateur de répondre au Captcha (s'il y répond, on remarque que l'attaque par dictionnaire fonctionne),
- n'interprête pas le code JS. 


