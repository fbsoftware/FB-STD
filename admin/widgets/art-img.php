<?php
/**
----------------------------------------------
	28/02/21	articolo in struttura flex
---------------------------------------------- */
        echo "<div class='f-flex fd-column'>";  
          $art = new getArt($titolo_art);
          $art->getFieldsdArt();
          $a = new txt($art->atext);
          $a->ingloba();
        echo "</div>";
?>