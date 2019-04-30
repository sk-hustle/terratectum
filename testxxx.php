<form method="get" action="test.php">
    <input type="text" name="name"/>
    <input type="submit" value="Submit"/>
</form>

<input onchange="bla(this);"></input>

<script type="application/javascript">
/*global $*/

function bla(sel){
    var bla = sel.value;
    
    $.ajax({
        type: "GET",
        url: 'test.php',
        data: {name: bla}
    });
}
</script>
