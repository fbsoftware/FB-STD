
<section id='artslide'>
<?php
//-- Pannello --       
		$head	= new section_head(TMP::$tsldtitle,TMP::$tsldtit,TMP::$tsldtext,TMP::$tcolor);
			$head->head();
?>

<div class="row">
<div id="segnalazioni-carousel" class="carousel slide" data-ride='carousel' data-interval='<?php echo TMP::$tslidetime ?>'>

<!-- navigazione -->
   <div class="panel-carousel-nav">
  <a class="left-carousel-control" href="#segnalazioni-carousel" data-slide="prev">
   <span class="glyphicon glyphicon-chevron-left"></span>
  </a>  &nbsp;&nbsp;&nbsp; NAVIGAZIONE &nbsp;&nbsp;&nbsp;
  <a class="right-carousel-control" href="#segnalazioni-carousel" data-slide="next">
   <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
 </div> 
 
<!-- parte interna --> 
 <div class="carousel-inner">
      <?php
	  
// cerca nel layout le slide
require_once("connectDB.php");
        $sql = "SELECT *
                FROM `".DB::$pref."asl`
                WHERE dtmp = '".TMP::$tmenu."'
                    and dtipo = 'artslide'
                    and dstat <> 'A'
				 
                ORDER BY dprog ";    //and dcod = '$lcod'
          foreach($PDO->query($sql) as $row)
          {     
			$dcap     =    $row['dcap'];
			$ddes     =    $row['ddes'];
 	  
      $count = 0;
// lettura articoli della categoria
        $sql = "SELECT *
                FROM `".DB::$pref."art`
                WHERE acap = '$dcap'
                    and astat <> 'A' 
                ORDER BY aprog ";
// =======================================================================				
          foreach($PDO->query($sql) as $row)
          {     
            if ($count == 0) 
               {
               echo    '<div class="item active">';	
               }
          else
               {
               echo    '<div class="item">';	
               }       
      ?>
  <!-- items -->
   <div class="panel-carousel">
<!-- navigazione -->
   <div class="panel-carousel-nav">
    <div class="panel-carousel-heading fb-bgcolor-<?php echo TMP::$tcolor; ?>">
     <h4><?php echo $row['atit']; ?></h4>
    </div> 
    <div class="panel-carousel-body">
<?php
          $a = new txt($row['atext']);
          $a->ingloba();
?>    
	</div>
	</div>
	</div> 
     <?php
          $count++;
          };   // lettuta art
     };        // lettura asl
     ?>
</div>        
</div>        <!-- carousel-inner -->
</div>       <!-- carousel-slide --> 
</div>      <!-- segnalazioni-carousel -->               
</div>   <!-- row -->
</section>   
