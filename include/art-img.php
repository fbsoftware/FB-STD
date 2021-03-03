<?php
/* --------------------------------
	28/02/21	struttura flex
----------------------------------- */
          // ricerca articolo
          echo "<div class='f-item'>";  // flex     
          $art = new getArt($titolo_art);
          $art->getFieldsdArt();
          $a = new txt($art->atext);
          $a->ingloba();
          echo "</div>";
?>