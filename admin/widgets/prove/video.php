<?php  
/**
-----------------------------------------------
video YouTube 	
28/02/21	struttura flex video fisso 400x300
-------------------------------------------------- */

echo "<div id='wrapp'> ";
$src = "https://www.youtube.com/embed/".$ivideo."";
echo "<iframe id='player' src='".$src ."' frameborder='0' width='400' height='300'></iframe>   ";
echo "</div>"; 

?>