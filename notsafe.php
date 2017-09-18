<?php
/*
 * Ce fichier sert à gérer le formulaire non-sécurisé.
 */
 
 
/*
 * Initialisation des variables utilisées pour paramétrer la base de données.
 */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banque";

/*
 * Tentative de connexion à la base de données.
 */
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
    }
catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
	

/*
 * Affichage de l'entête du tableau des comptes de l'utilisateur connecté.
 */
echo "<br>
      <link href=\"bootstrap/dist/css/bootstrap.css\" rel=\"stylesheet\">
	  <link href=\"bootstrap/dist/css/tuto.css\" rel=\"stylesheet\">
	  <div class='panel panel-primary'>
		  <table class='table table-striped table-condensed'>
			<div class='panel-heading'> 
			  <h3 class='panel-title'>Bienvenue ".$_POST['loginNS']." !</h3>
			</div>
			<thead>
			  <tr>
				<th>Login</th>
				<th>Owner</th>
				<th>Type</th>
				<th>Amount</th>
			  </tr>
			</thead>
			<tbody>";

/*
 * Fonction utilisée pour afficher une ligne du tableau des comptes.
 */
class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

/*
 * Test pour savoir quel bouton a été cliqué.
 */
if (isset($_POST['SignIn'])) {
 
    // j'ai cliqué sur le bouton « Sign In »
 
	try {
		// Requête pour récupérer toutes les données concernant l'utilisateur se connectant.
		$stmt = $conn->prepare("SELECT users.login, accounts.idUsers, accounts.type, accounts.amount FROM accounts INNER JOIN users ON accounts.idUsers = users.id WHERE users.login = '".$_POST['loginNS']."' AND users.pass = '".$_POST['passwordNS']."';"); 
		$stmt->execute();

		// set the resulting array to associative
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		//Appel de la fonction d'affichage d'une ligne pour chaque données.
		foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
			echo $v;
		}
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;
	echo "</tbody></table>";
} 
	
elseif (isset($_POST['dico'])) {
 try {
		// j'ai cliqué sur le bouton « Attaque par dictionnaire »
		
		//Ouverture en lecture du dictionnaire "Prenoms.txt".
		$monfichier = fopen('Prenoms.txt', 'r');
		
		//Lecture du premier mot.
		$mdp = fgets($monfichier);
		
		//suppression des caractères spéciaux.
		$mdp = str_replace(CHR(13).CHR(10),"",$mdp);
		
		//Requête pour récupérer les données de l'utilisateur dont le login est saisi dans le formulaire et le mot de passe est celui récupérer dans le dictionnaire.
		$stmt = $conn->prepare("SELECT users.login, accounts.idUsers, accounts.type, accounts.amount FROM accounts INNER JOIN users ON accounts.idUsers = users.id WHERE users.login = '".$_POST['loginNS']."' AND users.pass = '".$mdp."';"); 
		$stmt->execute();
		// set the resulting array to associative
		$rows = $stmt->rowCount();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
		
		/*
		 * Tant que la table de données est vide, c'est que le mot du dictionnaire n'est pas le mot de passe. Alors, on passe au mot suivant et on lance une nouvelle requête.
		 */
		while ((($mdp = fgets($monfichier)) !== FALSE) AND $rows == 0 )	{
			$mdp = str_replace(CHR(13).CHR(10),"",$mdp);
			$stmt = $conn->prepare("SELECT users.login, accounts.idUsers, accounts.type, accounts.amount FROM accounts INNER JOIN users ON accounts.idUsers = users.id WHERE users.login = '".$_POST['loginNS']."' AND users.pass = '".$mdp."';"); 
			$stmt->execute();
			// set the resulting array to associative
			$rows = $stmt->rowCount();
			//echo $mdp.$rows."-";
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

		}
		
		//Appel de la fonction d'affichage d'une ligne pour chaque données.
		foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
			echo $v;
		}
	}	
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	
	$conn = null;
	echo "</tbody></table>";
	
	//fermeture du dictionnaire.
	fclose($monfichier);
} 
    
/*
 * Affichage du bouton de deconnexion.
 */
echo "
<form class=\"col-lg-3\" method=\"post\" action=\"deconnexion.php\">
	<br><br>
	<button type=\"submit\" name=\"deconnexion\" class=\"btn btn-danger\">Log out</button>
</form>
"
?>
