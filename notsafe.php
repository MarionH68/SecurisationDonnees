<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banque";

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
	
echo "<br>
      <link href=\"bootstrap/dist/css/bootstrap.css\" rel=\"stylesheet\">
	  <link href=\"bootstrap/dist/css/tuto.css\" rel=\"stylesheet\">";
//echo "<script>alert('Hello')</script>";
echo "<div class='panel panel-primary'>
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

if (isset($_POST['SignIn'])) {
 
    // j'ai cliqué sur « Sign In »
 
	try {
		$stmt = $conn->prepare("SELECT users.login, accounts.idUsers, accounts.type, accounts.amount FROM accounts INNER JOIN users ON accounts.idUsers = users.id WHERE users.login = '".$_POST['loginNS']."' AND users.pass = '".$_POST['passwordNS']."';"); 
		$stmt->execute();

		// set the resulting array to associative
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
	} 
elseif (isset($_POST['dico'])) {
 try {
		// j'ai cliqué sur « Attaque par dictionnaire »
		$monfichier = fopen('Prenoms.txt', 'r');
		$mdp = fgets($monfichier);
		$mdp = str_replace(CHR(13).CHR(10),"",$mdp);
		$stmt = $conn->prepare("SELECT users.login, accounts.idUsers, accounts.type, accounts.amount FROM accounts INNER JOIN users ON accounts.idUsers = users.id WHERE users.login = '".$_POST['loginNS']."' AND users.pass = '".$mdp."';"); 
		$stmt->execute();
		// set the resulting array to associative
		$rows = $stmt->rowCount();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
		
		while ((($mdp = fgets($monfichier)) !== FALSE) AND $rows == 0 )	{
			$mdp = str_replace(CHR(13).CHR(10),"",$mdp);
			$stmt = $conn->prepare("SELECT users.login, accounts.idUsers, accounts.type, accounts.amount FROM accounts INNER JOIN users ON accounts.idUsers = users.id WHERE users.login = '".$_POST['loginNS']."' AND users.pass = '".$mdp."';"); 
			$stmt->execute();
			// set the resulting array to associative
			$rows = $stmt->rowCount();
			//echo $mdp.$rows."-";
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

		}
		foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
			echo $v;
		}
		}	
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;
	echo "</tbody></table>";
	fclose($monfichier);
	} 
    
 
	echo "
	<form class=\"col-lg-3\" method=\"post\" action=\"deconnexion.php\">
		<br><br>
		<button type=\"submit\" name=\"deconnexion\" class=\"btn btn-danger\">Log out</button>
	</form>
	"
?>
