<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="title" content="Drag and drop with php/mysql working example | infoandapps.com">
    <meta name="description" content="Let's see a demo of drag and drop example in php mysql">
    <meta name="author" content="infoandapps">
    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="stylesheet.css" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        
<style>
.content_box { 
  padding:5px; 
  width:300px; 
  float:left;
  height:250px; 
  border:#00FFFF solid 1px; 
  font-family:Verdana, Arial, Helvetica, sans-serif;
  margin:10px;
  overflow:auto;
  color:#999999;
  font-size:14px;
}

.content_holder_box{ width:300px;
  float:right;
  height: 250px;
  border:#0099FF solid 1px;
  padding:10px;
  margin:10px;
  color:#999999;
  font-size:14px;
}

.content_holder_box:hover{ 
  border:#0099FF solid 1px; 
}

.dragelement{ 
  padding:5px; 
  margin:3px; 
  cursor:move;
  border:#99FF66 solid 1px; 
  color:#000;  
  width:270px; 
  height: 25px;
  font-size:13px;
  background-color:#E2FFC6;
}

.dropper{ 
  width:270px;
  height:25px;
  margin:10px;
  border:#0099FF solid 1px;  
}

.dropper_hover{ 
  border:#999999 dashed 1px; 
  background:url(images/donna.png) center no-repeat;
}

.column {
    border: 1px solid black;
    height: 30px;
    width: 100%;
    background-color:#FFFFFF;
}
</style>
</head>

<body>

    <div class="content_box" id="content_box_drag" onMouseOver="drag();"> Blocchi:


   <p class='dragelement' id='dragelement_1'>Distanziatore</p>
   <p class='dragelement' id='dragelement_2'>Separatore</p>
   <p class='dragelement' id='dragelement_3'>Immagine</p>
   <p class='dragelement' id='dragelement_4'>Testo</p>

</div>
<div class="content_holder_box" id="content_box_drop">Rilascia qui
<p class="dropper"></p> 
</div>
<div style="clear:both;"></div>
<br/><br/>
<div id="search_result"></div>

<script> 
//initialize the drag and drop functions.
function drag() {

$("#content_box_drag p").draggable({
    appendTo: "body",
    helper: "clone",
    revert: "invalid"
    //add comma to previous last line & uncomment this if u want to remove the dropped item
   /*stop: function(){$(this).remove();}*/
});

$("#content_box_drop ").droppable({
    activeClass: "dropper_hover",
    hoverClass: "dropper_hover",
    class: "column",
    accept: ":not(.ui-sortable-helper)",
    drop: function (event, ui)
     {
       /* var ele = document.getElementById("Dragelement_2").innerHTML;*/
       var ele = "<div class='column'></div>"
        $.ajax({
            url: "store.php",
            type: "POST",
            data: { element: ele },
            /*beforeSend: function () 
            {
                $('#search_result').html("<center><br/><h4>Loading.....</h4></center>");
            },*/
            success: function (data) 
            {
                $("#content_box_drop").html(data)                           /* $("#search_result").html(data); */
            }
        });

    }
});
$("#content_box_drag p").sortable();
}
</script>
</body>