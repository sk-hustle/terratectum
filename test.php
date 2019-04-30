
<?php 

require_once("dbconfig.php");

$fruit = $condition = $bagSize = $potSize = "";
$length = $width = $height = $quantity = 0;


$fruit = $_GET["fruit"];
$condition = $_GET["condition"];
$bagSize = $_GET["bagSize"];
$potSize = $_GET["potSize"];
$length = intval($_GET["length"]);
$width = intval($_GET["width"]);
$height = intval($_GET["height"]);
$quantity = intval($_GET["quantity"]);



if(isset($quantity)){

    if(!isset($fruit)) $fruit = "";
    if(!isset($condition)) $condition = "";
    if(!isset($bagSize)) $bagSize = "";
    if(!isset($potSize)) $potSize = "";
    if(!isset($length)) $length = 0;
    if(!isset($width)) $width = 0;
    if(!isset($height)) $height = 0;

    
    try{
        $conn = new PDO("mysql:host=localhost;dbname=dbtest","markschuster","");
        // prepare statement                                      
        $stmt = $conn->prepare("INSERT INTO `list` (`fruit`, `condition`, `bagSize`, `potSize`, `length`, `width`, `height`, `quantity`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute(array($fruit,$condition,$bagSize,$potSize,$length,$width,$height,$quantity)); 
    } 
    catch (Exception $e) 
    {
        echo "Fehlercode: ". $e;
    }
    
    // Setze zurück
    $fruit = $condition = $bagSize = $potSize = "";
    $length = $width = $height = $quantity = 0;

}

require_once("table.php");

?>


