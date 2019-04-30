
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Selling modul</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="/css/style.css" type="text/css" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <!--image picker-->
  <link rel="stylesheet" href="/image-picker-master/image-picker/image-picker.css" type="text/css" />
  <script src="/image-picker-master/image-picker/image-picker.js"></script>
  
</head>
<body>

<div class="jumbotron text-center">
  <div class="enjoy-css"><b>TerraTectum</b></div>
  <div class="fun-with-css">Erdauswahlmodul für das TerraTectum "Shopsystem"</div> 
</div>
  
<div class="container text-center">
    <!--Auswahl  --> 
    <div class="row text-center choicerow" style="display: table; margin: 0 auto;">
    <h3 id="selectfruit">Wählen Sie für welche Pflanze Sie Erde benötigen.</h3>
        <!--image picker -->
        <select id="lol" onchange="getFruit(this); " class="image-picker show-html">
            <option data-img-src="/img/pear.svg" data-img-alt="Birne"  data-img-class="first" value="Birne">Birne</option>
            <option data-img-src="/img/strawberry.svg" data-img-alt="Erdbeere" value="Erdbeere">Erdbeere</option>
            <option data-img-src="/img/mango.svg" data-img-alt="Mango"  value="Mango">Mango</option>
            <option data-img-src="/img/orange.svg" data-img-alt="Orange"  value="Orange">Orange</option>
            <option data-img-src="/img/grape.svg" data-img-alt="Weintraube"  value="Weintraube">Weintraube</option>
            <option data-img-src="/img/apple.svg" data-img-alt="Apfel"  value="Apfel">Apfel</option>
            <option data-img-src="/img/watermelon.svg" data-img-alt="Wassermelone" data-img-class="last" value="Wassermelone">Wassermelone</option>
        </select>
    </div>
    <!--Auswahl Ende-->


    <div class="row text-center col-sm-12 selectrow">
    <h3 id="selectcon" style="display:none"></h3>
    <p id="selp" style="display:none">Folgende Optionen stehen für die gewählte Pflanze zur Verfügung</p>

    <!---SACK OPTION-->
    <div class="col-sm-4 text-center" id="sack">
      <h3>Sack</h3>
      <p>Für große Flächen</p>
        <img class="img-responsive" width="100px" src="/img/sack.png" alt="bag">
          
        <div class="form-group">
          <label for="size">Größenangabe:</label>
          <select class="form-control" onchange="getSize(this);" id="bagSize">
            <option>S (2 Liter)</option>
            <option>M (5 Liter)</option>
            <option>L (10 Liter)</option>
            <option>XL (25 Liter)</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="quantity">Wieviele Säcke?</label>
          <input type="number" class="form-control" onchange="getQuantity(this);" min="1" id="quantity" placeholder="Enter quantity">
        </div>
    </div>
    <!---SACK OPTION ENDE-->
    
    <!---LOSE OPTION-->
    <div class="col-sm-4 text-center" id="lose">
      <h3>Lose Erde</h3>
      <p>Ab 1 Kubikmeter Erde</p>
        <div class="text-center">
            <img class="img-responsive" width="100px" src="/img/cube.png" alt="cube">
        </div> 
        <div class="form-group">
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
        </div>
        <div class="form-group">
          <label for="quantity">Wieviel Kubikmeter?</label>
          <input type="number" class="form-control" onchange="getQuantity(this);" id="dimensionsum" min="1" placeholder="Enter quantity">
        </div>
    </div>
     <!---LOSE OPTION ENDE-->

    <!---TOPF OPTION-->
    <div class="col-sm-4 text-center" id="topf">
      <h3>Topf</h3>
      <p>Für z.B. Balkone</p>
        <img class="img-responsive" width="100px" src="/img/topf.png" alt="pot">  

        <div class="form-group">
          <label for="size">Größenangabe:</label>
          <select class="form-control" onchange="getSize(this);"  id="potSize">
            <option>S (2 Liter)</option>
            <option>M (5 Liter)</option>
            <option>L (10 Liter)</option>
            <option>XL (25 Liter)</option>
          </select>
        </div>
        
        <label for="quantity">Wieviele Töpfe?</label>
        <div class="form-group">
          <input type="number" class="form-control" onchange="getQuantity(this);" id="quantity" min="1" placeholder="Enter quantity">
        </div>
    </div>
     <!---TOPF OPTION ENDE-->
     
     </div>
</div>

<!--test-->
<div class="row text-center submitajax">
  <button type="button" class="btn" id="test">Bestätigen</button>
</div>


<script type="application/javascript">
/*global $*/

// test
function alert_fn(){
    $.get('https://soil-markschuster.c9users.io/lol.txt', function(data) {
       alert(data);
    });   
}



var val, fru,condition, con, siz, qua, x, y, z, sum, location;


// initialize imagepicker
$("select#lol").imagepicker({
      hide_select : true,
      show_label  : true
})
// jeweilige sektion nur anzeigen, wenn nötig
document.getElementById('topf').style.display = 'none';
document.getElementById('sack').style.display = 'none';
document.getElementById('lose').style.display = 'none';

// Frucht
function getFruit(sel){
    fru = sel.value;
    console.log(fru);
    showConditions();
}


// Dimension
function calculateQuantity() {
    x = $("#x").val();
    y = $("#y").val();
    z = $("#z").val();
    
    parseInt(x);
    parseInt(y);
    parseInt(z);
    
    sum = x * y * z;
    $("#dimensionsum").val(sum);
    qua = sum;
    console.log(qua);
}

// Größe
function getSize(sel)
{
    siz = sel.value;
    console.log(siz);
}

// Menge
function getQuantity(sel)
{
    qua = sel.value;
    console.log(qua);
}

// Zeige Kondition
function showConditions(){
    // Zeige h3 Select conditions
    $("#selectcon").fadeTo("fast" , 1.0);
    $("#selp").fadeTo("fast", 1.0);

    switch(fru){
        case "Birne":
            condition = 1;
            break;
        case "Erdbeere":
            condition = 2;
            break;
        case "Mango":
            condition = 3;
            break;
        case "Orange":
            condition = 4;
            break;
        case "Weintraube":
            condition = 5;
            break;
        case "Apfel":
            condition = 6;
            break;
        case "Wassermelone":
            condition = 7;
            break;    
        
        default:
            condition = 0;
            break;
    }
    getCondition();
    
    
    switch(condition){
        case 1:
            $("#sack").fadeTo("fast" , 1.0);
            document.getElementById('topf').style.display = 'none';
            document.getElementById('lose').style.display = 'none';
            $("#selectcon").text("Wählen Sie die Menge an Pflanzenerde.") 
            break;
        case 2:
            document.getElementById('sack').style.display = 'none';
            $("#topf").fadeTo("fast" , 1.0);
            document.getElementById('lose').style.display = 'none';
             $("#selectcon").text("Wählen Sie die Menge an Pflanzenerde.")
            break;
        case 3:
            document.getElementById('sack').style.display = 'none';
            document.getElementById('topf').style.display = 'none';
            $("#lose").fadeTo("fast" , 1.0);
            $("#selectcon").text("Wählen Sie die Menge an Pflanzenerde.")
            break;
        case 4:
            document.getElementById('sack').style.display = 'none';
            $("#topf").fadeTo("fast" , 1.0);
            $("#lose").fadeTo("fast" , 1.0);
            $("#selectcon").text("Wählen Sie die Menge und Art an Pflanzenerde.")
            break;
        case 5:
            $("#sack").fadeTo("fast" , 1.0);
            document.getElementById('topf').style.display = 'none';
            $("#lose").fadeTo("fast" , 1.0);
            $("#selectcon").text("Wählen Sie die Menge und Art an Pflanzenerde.")
            break;
        case 6:
            $("#sack").fadeTo("fast" , 1.0);
            $("#topf").fadeTo("fast" , 1.0);
            document.getElementById('lose').style.display = 'none';
            $("#selectcon").text("Wählen Sie die Menge und Art an Pflanzenerde.")
            break;
        case 7:
            $("#sack").fadeTo("fast" , 1.0);
            $("#topf").fadeTo("fast" , 1.0);
            $("#lose").fadeTo("fast" , 1.0);
            $("#selectcon").text("Wählen Sie die Menge und Art an Pflanzenerde.")
            break;    
        default:
            document.getElementById('sack').style.display = 'none';
            document.getElementById('topf').style.display = 'none';
            document.getElementById('lose').style.display = 'none';
            break;
    }
    
    $("html.body").scrollTop( 1000 );
    
    getCondition();
}


function getCondition(){
    // Auswahl ein- und ausschalten
    
    
    
    
    if(fru == "Birne"){
        $("#sack").click(function() {
            $("#sack").fadeTo("fast" , 1.0);
            document.getElementById('topf').style.display = 'none';
            document.getElementById('lose').style.display = 'none';
            con = "sack";
        });
    }

    if(fru == "Erdbeere"){
        $("#topf").click(function() {
            $("#topf").fadeTo("fast" , 1.0);
            document.getElementById('sack').style.display = 'none';
            document.getElementById('lose').style.display = 'none';
            con = "topf";
        });
    }
    
    
    if(fru == "Mango"){
        $("#lose").click(function() {
            $("#lose").fadeTo("fast" , 1.0);
            document.getElementById('topf').style.display = 'none';
            document.getElementById('sack').style.display = 'none';
            con = "lose";
        });
    }
    
    
    if(fru == "Orange"){
        $("#lose").click(function() {
            $("#lose").fadeTo("fast" , 1.0);
            $("#topf").show()
            document.getElementById('sack').style.display = 'none';
            con = "lose";
        });
        
        $("#topf").click(function() {
            $("#topf").fadeTo("fast" , 1.0);
            $("#lose").show()
            document.getElementById('sack').style.display = 'none';
            con = "topf";
        });
    }
    
    if(fru == "Weintraube"){
        $("#lose").click(function() {
            $("#lose").fadeTo("fast" , 1.0);
            $("#sack").show()
            document.getElementById('topf').style.display = 'none';
            con = "lose";
        });
        
        $("#sack").click(function() {
            $("#sack").fadeTo("fast" , 1.0);
            $("#lose").show()
            document.getElementById('topf').style.display = 'none';
            con = "sack";
        });
    }
    
    if(fru == "Apfel"){
        $("#sack").click(function() {
            $("#sack").fadeTo("fast" , 1.0);
            $("#topf").show()
            document.getElementById('lose').style.display = 'none';
            con = "sack";
        });
        
        $("#topf").click(function() {
            $("#topf").fadeTo("fast" , 1.0);
            $("#sack").show()
            document.getElementById('lose').style.display = 'none';
            con = "topf";
        });
    }
    
    
    if(fru == "Wassermelone"){
        $("#sack").click(function() {
            $("#sack").fadeTo("fast" , 1.0);
            $("#topf").show()
            $("#lose").show()
            con = "sack";
        });
        
        $("#topf").click(function() {
            $("#topf").fadeTo("fast" , 1.0);
            $("#sack").show()
            $("#lose").show()
            con = "topf";
        });
        
        $("#lose").click(function() {
            $("#lose").fadeTo("fast" , 1.0);
            $("#topf").show()
            $("#sack").show()
            con = "lose";
        });
    }
}


// In die Datenbank 
$("#test").click(function(){
    if(qua != undefined && fru != undefined){
        if(con == "sack"){
            $.ajax({
                type: "GET",
                url: 'test.php',
                data: {fruit: fru, condition: con, bagSize: siz, quantity: qua}
            });
            alert(qua + " Säcke à " + siz + " von " + fru + "-Pflanzenerde im Warenkorb!");
            
        }
        
        if(con == "topf"){
            $.ajax({
                type: "GET",
                url: 'test.php',
                data: {fruit: fru, condition: con, potSize: siz, quantity: qua}
            });
            alert(qua + " Töpfe à " + siz + " von " + fru + "-Pflanzenerde im Warenkorb!");
        }
        
        if(con == "lose"){
            $.ajax({
                type: "GET",
                url: 'test.php',
                data: {fruit: fru, condition: con, length: x, width: y, height: z, quantity: qua}
            });
             alert(qua + " Kubikmeter von " +fru+  "-Pflanzenerde im Warenkorb!");
        }
    } else if(fru != undefined){
        alert("Bitte wählen Sie die gewünschte Menge");
    } else {
        alert("Bitte wählen Sie die Pflanzenerde und Menge")
    }
    
    //Setze alles zurück
    
    location.reload(true);

});



</script>

<?php require_once("table.php");?>

</body>
</html>
