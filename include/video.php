<?php //  video YouTube 
echo "<div class='$num_colvid'>"; 
echo "<div id='wrapp'> ";
$src = "https://www.youtube.com/embed/".$ivideo."";
echo "<iframe id='player' src='".$src ."' frameborder='0' allowfullscreen></iframe>   ";
echo "</div>"; 
echo "</div>";
?>