<?php
          // ricerca articolo
          echo "<div class='$num_colart'>";     // colonne dell'articolo     
          $art = new getArt($titolo_art);
          $art->getFieldsdArt();
          $a = new txt($art->atext);
          $a->ingloba();
          echo "</div>";
?>