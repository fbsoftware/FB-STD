<?php
          // ricerca articolo
          echo "<div class='$dcol'>";          
          $art = new getArt($dart);
          $art->getFieldsdArt();
          $a = new txt($art->atext);
          $a->ingloba();
          echo "</div>";
?>