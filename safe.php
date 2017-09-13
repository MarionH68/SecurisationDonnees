<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banque";
//Récupération des variables envoyées par le formulaire
$login = $_POST['loginS'];
$pass = $_POST['passwordS'];

//Connexion à la base de données en PDO
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
echo "<br>";
echo "Bienvenue ".htmlspecialchars($_POST['loginS'],ENT_QUOTES)." !";		
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>Login</th><th>Owner</th><th>Type</th><th>Amount</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

try {
    $stmt = $conn->prepare("SELECT users.login, accounts.idUsers, accounts.type, accounts.amount FROM accounts INNER JOIN users ON accounts.idUsers = users.id WHERE users.login = ? AND users.pass =  ?"); 
    $stmt->execute(array($login,$pass));

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
echo "</table>";

?>
