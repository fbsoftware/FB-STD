<?php
/* --------------------------------
	28/02/21	struttura flex
----------------------------------- */
echo	"<section id='artimg'>";
?>
  <script>
  $( function() {
  $( ".fb-primary p" ).addClass('fb-primary');
  $( ".fb-primary h1" ).addClass('fb-primary');
  } );
  </script>

<?php
// stampa riga di separazione
			echo "<hr class='fb-primary'>"; 
 //echo "CODICE=".$lcod;//debug    

// cerca gli articoli con immagine
       $sql = "SELECT *
                FROM `".DB::$pref."aim`
                WHERE itmp = '".TMP::$tcod."'
                    and istat <> 'A'
				and icod = '$lcod'  
                ORDER BY iprog ";
     foreach($PDO->query($sql) as $row)
     {    require 'admin/fields_aim.php'; 
	 		$titolo_art =   $iart;
		echo "<div class='f-flex fd-row jc-around fw fb-secondary'>";		// flex

		//  immagine/video a sinistra ============================================                                      
          if ($iimgpos == 'sx') 
          {			echo "<div class='f-flex'>";		// div interno

               if ($itipo == 'img') 
               { 
		   ?>
			<?php $target	= "artimg".$count; 
 			echo "<a popup-open='".$target."' href='javascript:void(0)'>";?>
  			<img src="<?php echo $iimg; ?>" class="img-thumbnail img-responsive img-h300" title="<?php echo $iimgtit; ?>"> 
 			</a> 
 			
 			<?php
			
			$modal	= new popup_modale($target,$iimgtit,$iimg,"",$iimgalt);
				$modal->popup();
				}
               
			elseif ($itipo == 'video')
               {
                require 'video.php';
               }
			echo "</div>";  
// testo
               echo "<div class='f-flex'>";		// div interno
				require 'art-img.php';
				$count++;
			echo "</div>";
          }
          
          //  immagine/video a destra =========================================
          elseif ($iimgpos == 'dx') 
          echo "<div class='f-flex'>";		// div interno
          {
			// testo
               echo "<div class='f-flex'>";		// div interno
				require 'art-img.php';
				$count++;
			echo "</div>";
               if ($itipo == 'img') 
               {  
               echo "<div class='f-flex'>";		// div interno?>
			<?php $target	= "artimg".$count; 			
 			echo "<a popup-open='".$target."' href='javascript:void(0)'>";?>
  			<img src="<?php echo $iimg; ?>" class="img-thumbnail img-responsive img-h300" title="<?php echo $iimgtit; ?>"> 
 			</a> 
 			
 			<?php
			$modal	= new popup_modale($target,$iimgtit,$iimg,"",$iimgalt);
				$modal->popup();
	
               }
               // video
               elseif ($itipo == 'video')
               {
               require 'video.php';  
               }
				$count++;
			   echo "</div>";
		  }
echo "</div>";     // flex
          }
  
?>
</section>