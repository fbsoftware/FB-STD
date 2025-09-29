<?php   session_start();
/*** -------------------------------------------------------------------------
   * Gestione della pagina tipo Elementor
   23/05/24 	
=============================================================================  */

require_once('init_admin.php');
require_once("editor.php");			// scelta editor
?>
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
  width:100px;
  height: 100px; 
  border:#99FF66 solid 1px;
  background-color:#E2FFC6;
  cursor:move;
  color:#000;
  font-size:13px;
}

.dropper{ width:270px;
  height:125px;
  margin:10px; 
}

.dropper_hover{ 
  border:#999999 dashed 1px; 
  background:#cacaca;
}

//you can show arrow image to suggest where user has to drop selected UI.
</style>

<body>
    <div class="content_box" id="content_box_drag" onMouseOver="drag();"> Drag label
        <p class='dragelement' id='dragelement_$i'></p>
    </div>

    <div class="content_holder_box" id="content_box_drop">Drop here
        <p class="dropper"></p>
    </div>

    </div>
    <div id="footer">

    </div>
</body>

<script>
function drag() {

$("#content_box_drag p").draggable({
    appendTo: "body",
    helper: "clone",
    revert: "invalid"
   /*add comma to previous last line & uncomment this if u want to remove the dropped item
   stop: function(){$(this).remove();}*/
});

$("#content_box_drop p").droppable({
    activeClass: "dropper_hover",
    hoverClass: "dropper_hover",
    accept: ":not(.ui-sortable-helper)",
    drop: function (event, ui) {
        var ele = "<div>Rilascia qui</div>";
        $.ajax({
            url: "store.php",
            type: "POST",
            data: {
                element: ele
            },
            beforeSend: function () {
                $('#search_result').html("<center><br/><h4>Loading.....</h4></center>");
            },
            success: function (data) {
                $("#search_result").html(data);
            }
        });
    }
});

}
</script>
</html>