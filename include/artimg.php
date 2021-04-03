<?php
/* --------------------------------
	28/02/21	struttura flex
----------------------------------- */
echo	"<section id='artimg'>";
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
		echo "<div class='f-flex fd-row jc-center fw'>";		// flex

		//  immagine/video a sinistra ============================================                                      
          if ($iimgpos == 'sx') 
          {	
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
			   
				require 'art-img.php';
				$count++;
				echo "</div>";
          }
          
          //  immagine/video a destra =========================================
          elseif ($iimgpos == 'dx') 
          {
			require 'art-img.php';
               if ($itipo == 'img') 
               {  ?>
			<?php $target	= "artimg".$count; 			
 			echo "<a popup-open='".$target."' href='javascript:void(0)'>";?>
  			<img src="<?php echo $iimg; ?>" class="img-thumbnail img-responsive img-h300" title="<?php echo $iimgtit; ?>"> 
 			</a> 
 			
 			<?php
			$modal	= new popup_modale($target,$iimgtit,$iimg,"",$iimgalt);
				$modal->popup();
			echo "</div>";
	
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