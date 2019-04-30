<?php
require_once("dbconfig.php"); // 5.12.17 21:15

echo "<div class='row'><div class='col-sm-offset-3 col-sm-6 center'><table>";
echo "<tr><th>Fruit</th><th>Condition</th><th>BagSize</th><th>PotSize</th><th>Length</th><th>Width</th><th>Height</th><th>Quantity</th></tr>";

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
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT `fruit`, `condition`, `bagSize`, `potSize`, `length`, `width`, `height`, `quantity` FROM `list`"); 
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
echo "</table></div></div>";

?>


