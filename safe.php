<?php
session_start();
require 'recaptchalib.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banque";
//Récupération des variables envoyées par le formulaire
$login = $_POST['loginS'];
$pass = $_POST['passwordS'];

$siteKey = '6LcVnTAUAAAAAGIqEzqNZ8pvMcMMv0f-EYdI7UTR'; //clé publique de la captcha google
$secret = '6LcVnTAUAAAAAIWUUKEud6RzSkSE2qUrm--Mw9Jj'; //clé secréte de la captcha google

//Connexion à la base de données en PDO
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
	

$reCaptcha = new ReCaptcha($secret);
if(isset($_POST["g-recaptcha-response"])) {
		$resp = $reCaptcha->verifyResponse(
		$_SERVER["REMOTE_ADDR"],
		$_POST["g-recaptcha-response"]
	);
	if ($resp != null && $resp->success) {}
	else {
		header("Location: formulaire.php");
		exit;
	}
}
	
echo "<br>
      <link href=\"bootstrap/dist/css/bootstrap.css\" rel=\"stylesheet\">
	  <link href=\"bootstrap/dist/css/tuto.css\" rel=\"stylesheet\">";
	  
//echo "Bienvenue ".htmlspecialchars($_POST['loginS'],ENT_QUOTES)." !";		
echo "<div class='panel panel-primary'>
  <table class='table table-striped table-condensed'>
    <div class='panel-heading'> 
      <h3 class='panel-title'>Bienvenue ".htmlspecialchars($_POST['loginS'],ENT_QUOTES)." !</h3>
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

try {
    $resLogin = $conn->prepare("SELECT * FROM users WHERE users.login = ?"); 
    $resLogin->execute(array($login));
	$verifLogin = $resLogin->fetchAll();
	if(count($verifLogin) == 0){
		$_SESSION['login'] = 0;
		header("Location: formulaire.php");
		exit;
	}
	
	$stmt = $conn->prepare("SELECT users.login, accounts.idUsers, accounts.type, accounts.amount FROM accounts INNER JOIN users ON accounts.idUsers = users.id WHERE users.login = ? AND users.pass =  ?"); 
    $stmt->execute(array($login,$pass));
	
    // set the resulting array to associative
	if(count($stmt->fetchAll())==0){
		$_SESSION['login'] = 2;
		$_SESSION['nomLogin'] = $_POST['loginS'];
		$_SESSION['password'] = false;
		header("Location: formulaire.php");
		exit;
	}
	
	$stmt = $conn->prepare("SELECT users.login, accounts.idUsers, accounts.type, accounts.amount FROM accounts INNER JOIN users ON accounts.idUsers = users.id WHERE users.login = ? AND users.pass =  ?"); 
    $stmt->execute(array($login,$pass));
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</tbody></table>";


echo "
	<form class=\"col-lg-3\" method=\"post\" action=\"deconnexion.php\">
		<br><br>
		<button type=\"submit\" name=\"deconnexion\" class=\"btn btn-danger\">Log out</button>
	</form>
"

?>
