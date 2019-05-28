<?php
echo	"<section id='artsingle'>";
$count = 0; 
// cerca nel layout gli articoli singoli
       $sql = "SELECT *
                FROM `".DB::$pref."ars`
                WHERE itmp = '".TMP::$tcod."'
                    and istat <> 'A' 
                ORDER BY iprog ";
     foreach($PDO->query($sql) as $row)
     {    include 'fields_aim.php';   
          echo "<div class='container'>";
          echo "<div class='row'>";
          //  immagine-video a sinistra                                       
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
			$modal	= new dialogo_modale($target,$iimgtit,$iimg,NULL,$iimgalt);
				$modal->dialog();
               }
               elseif ($itipo == 'video')
               {
               include 'video.php';               	
               }
          	include 'art-img.php';
          }
          
          //  immagine-video a destra
          elseif ($iimgpos == 'dx') 
          {
          include 'art-img.php';
               if ($itipo == 'img') 
               {  ?>
               <div class="<?php echo $iimgcol; ?>">
 			<div class="portfolio-thumbnail">
 			<a data-toggle="modal"  href="#artimg<?php echo $count; ?>">
  			<img src="<?php echo $iimg; ?>" class="img-thumbnail img-responsive" title="<?php echo $iimgtit; ?>"> 
 			</a> 
 			</div>
 			<?php
			$target	= "artimg".$count;
			$modal	= new dialogo_modale($target,$iimgtit,$iimg,'',$iimgalt);
				$modal->dialog();
	
               }
               // video
               elseif ($itipo == 'video')
               {
               include 'video.php';               	
               }

          }
          echo "</div>";     // row
          echo "</div>";     // container
          $count++;
     }     
?>
</section>