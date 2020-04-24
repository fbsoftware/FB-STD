<?php
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
	 
		// ampiezza colonne
		$num_colart	=	$iartcol;
		$num_colvid	=	$iimgcol;
		$titolo_art =   $iart;

          //  immagine-video a sinistra                                       
          echo "<div class='row'>";
          if ($iimgpos == 'sx') 
          {
               if ($itipo == 'img') 
               { ?>
               <div class="<?php echo $iimgcol; ?>">
 			<div class="portfolio-thumbnail">
 			<a data-toggle="modal"  href="#artimg<?php echo $count; ?>">
  			<img src="<?php echo $iimg; ?>" class="img-thumbnail img-responsive" title="<?php echo $iimgtit; ?>"> 
 			</a> 
 			</div>
 			</div>
 			<?php
			$target	= "artimg".$count;
			$modal	= new dialogo_modale($target,$iimgtit,$iimg,"",$iimgalt);
				$modal->dialog();
               }
               
			   elseif ($itipo == 'video')
               {
                require 'video.php';               	
               }
				require 'art-img.php';
			    $count++;

          }
          
          //  immagine-video a destra
          elseif ($iimgpos == 'dx') 
          {
          require 'art-img.php';
               if ($itipo == 'img') 
               {  ?>
               <div class="<?php echo $iimgcol; ?>">
 			<div class="portfolio-thumbnail">
 			<a data-toggle="modal"  href="#artimg<?php echo $count; ?>">
  			<img src="<?php echo $iimg; ?>" class="img-thumbnail img-responsive" title="<?php echo $iimgtit; ?>"> 
 			</a> 
 			</div>
 			</div>
 			<?php
			$target	= "artimg".$count;
			$modal	= new dialogo_modale($target,$iimgtit,$iimg,"",$iimgalt);
				$modal->dialog();
	
               }
               // video
               elseif ($itipo == 'video')
               {
               require 'video.php';               	
               }
				$count++;
		  }

          }
          echo "</div>";     // row
   //  }     
?>
</section>