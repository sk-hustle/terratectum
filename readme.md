
# Präsentation


## Inhaltsverzeichnis

Das Erdauswahlmodul und seine Anforderungen
1. Ablauf bei der Sortenauswahl
	2.1. Beispiel "Apfel"
		
2. Wahl der Transportart
	2.1. Festlegung der Menge
	2.2. Berechnung des Flächeninhalts
	2.3. Bestimmung der Größe
	
3. Ablauf und Operationen des Bestellvorgangs
	3.1. Javascript 
	3.2. PHP
	
---
### 1. Ablauf bei der Sortenauswahl

Beispiel: Wir klicken zunächst auf die Sorte "Apfel".
```
[...]
<h3 id="selectfruit">Wählen Sie für welche Pflanze Sie Erde benötigen.</h3>
    <!--image picker -->
    <select onchange="getFruit(this);" class="image-picker show-html">
[...]
        <option data-img-src="/img/apple.svg" data-img-alt="Apfel"  value="Apfel">Apfel</option>
        [...]
    </select>
[...]
```

Bei Klick auf die Sorte „Apfel“ speichert die onChange-Funktion in die Variable fru.
```
// Frucht
function getFruit(sel){
    fru = sel.value;
    showConditions();
}
```

Die Variable fru wird gebraucht, um die Kondition zu bestimmen.
```
// Zeige Kondition
function showConditions(){
    [...]
    switch(fru){
	[...]
	case "Apfel":
            condition = 6;
            break;
	[...]
	}
    getCondition();
```

Ist die Kondition bestimmt, werden die Varianten für "Apfel" gezeigt.
Für "Apfel" werden hier die Variante Sack und Topf angezeigt.
```
    switch(condition){
    [...]
    case 6:
            $("#sack").fadeTo("fast" , 1.0);
            $("#topf").fadeTo("fast" , 1.0);
            document.getElementById('lose').style.display = 'none';
            $("#selectcon").text("Wählen Sie die Menge und Art an Pflanzenerde.")
            break;
    [...]
``` 

Wird nun z.B. innerhalb der Variante Sack geklickt, wird die Kondition bestimmt,
dies wäre dann con = "sack".

```
function getCondition(){
    // Auswahl ein- und ausschalten
    [...]
    if(fru == "Apfel"){
        $("#sack").click(function() {
            $("#sack").fadeTo("fast" , 1.0);
            $("#topf").show()
            document.getElementById('lose').style.display = 'none';
            con = "sack";
        });
     [...]
    }
```

---
---
---
---
---

### 2. Wahl der Transportart
---
#### 2.3. Bestimmung der Größe
Bei den Varianten „Sack“ und „Topf“ gibt es zusätzlich
die Select-Box zur Wahl der gewünschten Größe.

```
[...]
// Wählbare Größen S, M, L und XL.
  <label for="size">Größenangabe:</label>
  <select class="form-control" onchange="getSize(this);"  id="potSize">
    <option>S (2 Liter)</option>
    <option>M (5 Liter)</option>
    <option>L (10 Liter)</option>
    <option>XL (25 Liter)</option>
  </select>
[...]
```
onChange-Funktion speichert in Variable siz.
```
// Größe
function getSize(sel)
{
    siz = sel.value;
    console.log(siz);
}
``` 
---


#### 2.1. Festlegung der Menge
Divboxen der Varianten enthalten Input-Boxen,
wo die Menge angegeben werden kann.
```
[...]
  <label for="quantity">Wieviele Säcke?</label>
  <input type="number" class="form-control" onchange="getQuantity(this);" min="1" id="quantity" placeholder="Enter quantity">
[...]
```
Die onchange-Funktion speichert in Variable qua.
```
// Menge
function getQuantity(sel)
{
    qua = sel.value;
    [...]
}
```
---

#### 2.2. Berechnung des Flächeninhalts
In Lose gibt es 3 zusätzliche Input-Boxen für Höhe, Breite und Länge.

```
[...]
    <label for="x">Länge:</label>
    <input type="number" class="form-control" onchange="calculateQuantity();" id="x" min="1" max="100" value="1"/>
</div>
<div class="form-group">
    <label for="y">Breite:</label>
    <input type="number" class="form-control" onchange="calculateQuantity();" id="y" min="1" max="100" value="1"/>
</div>
<div class="form-group">
    <label for="z">Höhe:</label>
    <input type="number" class="form-control" onchange="calculateQuantity();" id="z" min="1" max="100" value="1"/>
[...]

```
Die onchange-Funktion speichert in Variablen xyz,
```
// Dimension
function calculateQuantity() {
    x = $("#x").val();
    y = $("#y").val();
    z = $("#z").val();
```

diese werden mit der parseInt-Funktion in Integer-Werte gewandelt.
```
    parseInt(x);
    parseInt(y);
    parseInt(z);
```
Anschließend findet eine Multiplikation statt.
```
    sum = x * y * z;
    $("#dimensionsum").val(sum);
    qua = sum;
    [...]
}
```

---
---
---
---


### 3. Ablauf und Operation des Bestellvorgangs

---

#### 3.1. Javascript

Bei Klick auf den Testbutton, wird überprüft, ob die Menge und Sorte angegeben ist.

```
$("#test").click(function(){
	if(qua != undefined && fru != undefined){
```
Ist dem so, werden anschließend folgende Variablen an die Datenbank geschickt.

#### 3.1.1. Bei Variante Sack oder Topf:

```
     if(con == "sack"){
            $.ajax({
                type: "GET",
                url: 'test.php',
                data: {fruit: fru, condition: con, bagSize: siz, quantity: qua}
            });
            alert(qua + " Säcke à " + siz + " von " + fru + "-Pflanzenerde im Warenkorb!");
            
        }
```
fruit[fru], condition[con], quantity[qua],

bagSize[siz] bei Sack bzw. 
potSize[siz] bei Topf

#### 3.1.2. Bei Variante Lose:

```
	if(con == "lose"){
            $.ajax({
                type: "GET",
                url: 'test.php',
                data: {fruit: fru, condition: con, length: x, width: y, 
	                height: z, quantity: qua}
            });
             alert(qua + " Kubikmeter von " +fru+  "-Pflanzenerde im Warenkorb!");
        }
``` 
fruit[fru], condition[con], quantity[qua]
width[x], length[y], height[z]

*Fehlermeldungen:*
Ist die Menge nicht bestimmt und man klickt den Test-Button,
erscheint ein PopUp mit „*Bitte wählen Sie die gewünschte Menge*“,
ansonsten: "*Bitte wählen Sie die Pflanzenerde und Menge*"
```
} else if(fru != undefined){
        alert("Bitte wählen Sie die gewünschte Menge");
    } else {
        alert("Bitte wählen Sie die Pflanzenerde und Menge")
    }
```

---

#### 3.2. PHP

Alle definierten Variablen werden zurückgesetzt,

```
$fruit = $condition = $bagSize = $potSize = "";
$length = $width = $height = $quantity = 0;
```

Alle GET-Parameter werden in Variablen gespeichert, 
zudem werden alle int GET-Parameter, 
mit der intval-Funktion zu int gecastet.

Beispiel:
```
$fruit = $_GET["fruit"];
$condition = $_GET["condition"];
$bagSize = $_GET["bagSize"];
$potSize = $_GET["potSize"];

$length = intval($_GET["length"]);
$width = intval($_GET["width"]);
$height = intval($_GET["height"]);
$quantity = intval($_GET["quantity"]);
```

Wird auf den Test-Button gedrückt und es erscheinen keine Fehler,
passieren folgende Dinge:

Zuerst wird mit der isset-Funktion geprüft, ob die Menge festgelegt ist.
```
if(isset($quantity)){
``` 
Ist dem so, werden alle Variablen mit der isset-Funktion geprüft,
dabei werden String-Variablen leer gesetzt und int-Variablen zu 0 definiert.
```
	if(!isset($fruit)) $fruit = "";
    if(!isset($condition)) $condition = "";
    if(!isset($bagSize)) $bagSize = "";
    if(!isset($potSize)) $potSize = "";
    if(!isset($length)) $length = 0;
    if(!isset($width)) $width = 0;
    if(!isset($height)) $height = 0;
```

Eine Verbindung zur MySQL-Datenbank wird aufgebaut.
```
try{
    $conn = new PDO("mysql:host=localhost;dbname=[***]","[username]","");
``` 
Anweisung wird vorbereitet (Prepared Statements) 
```
	// prepare statement                                      
    $stmt = $conn->prepare("INSERT INTO `list` (`fruit`, `condition`, `bagSize`, `potSize`, `length`, `width`, `height`, `quantity`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute(array($fruit,$condition,$bagSize,$potSize,$length,$width,$height,$quantity)); 
    } 
```

Die Anweisung wird ausgeführt.
```
	$stmt->execute(array($fruit,$condition,$bagSize,$potSize,$length,$width,$height,$quantity)); 
```

Sind Exceptions vorhanden werden sie ausgegeben.
```
catch (Exception $e) 
    {
        echo "Fehlercode: ". $e;
    }
```

Variablen werden wieder zurückgesetzt.
```
// Setze zurück
    $fruit = $condition = $bagSize = $potSize = "";
    $length = $width = $height = $quantity = 0;
```

---

Vielen Dank für die Aufmerksamkeit! 


