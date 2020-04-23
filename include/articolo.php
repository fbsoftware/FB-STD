<?php
          // ricerca articolo
          echo "<div class='$dcol'>";          
          $art = new getArt($atit);
          $art->getFieldsdArt();
          $a = new txt($art->atext);
          $a->ingloba();
          echo "</div>";
?>