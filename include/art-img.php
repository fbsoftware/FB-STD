<?php
          // ricerca articolo
          echo "<div class='$iartcol'>";          
          $art = new getArt($iart);
          $art->getFieldsdArt();
          $a = new txt($art->atext);
          $a->ingloba();
          echo "</div>";
?>