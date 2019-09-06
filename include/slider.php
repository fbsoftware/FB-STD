<?php //  carousel slider     
 ?>
<section id="slider" class="grid1 fb-col1">
<div id='myCarousel' class='carousel slide' data-ride='carousel' data-interval='<?php echo TMP::$tslidetime; ?>'>
<?php
 if (TMP::$tslidebutt === '1') 
 {  ?>
     <ol class="carousel-indicators"> 
<?php
// lettura slide
     $count = 0;
        $sql = "SELECT *
                FROM `".DB::$pref."sld`
                WHERE slcod = '$lcod'
                    and sltmp= '".TMP::$tcod."' 
                    and slstat <> 'A' 
                ORDER BY slprog ";
          foreach($PDO->query($sql) as $row)
          {    
if ($count == 0) { echo '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';}
if ($count == 1) { echo '<li data-target="#myCarousel" data-slide-to="1"></li>';}
if ($count == 2) { echo '<li data-target="#myCarousel" data-slide-to="2"></li>';}
if ($count == 3) { echo '<li data-target="#myCarousel" data-slide-to="3"></li>';}
if ($count == 4) { echo '<li data-target="#myCarousel" data-slide-to="4"></li>';} 
echo "<li data-target='#myCarousel' data-slide-to='".$count."'></li>";
  	
      $count++;     
      }    ?>   
      </ol> 
<?php      }    ?>            
      <div class="carousel-inner" role="listbox">
      
<?php
           $count = 0;
// lettura slide
        $sql = "SELECT *
                FROM `".DB::$pref."sld`
                WHERE slcod = '$lcod'
                    and sltmp= '".TMP::$tmenu."' 
                    and slstat <> 'A' 
                ORDER BY slprog ";
          foreach($PDO->query($sql) as $row)
          {     //print_r($row);//debug
            if ($count == 0) 
               {
               echo    '<div class="item active">';	
               }
          else
               {
               echo    '<div class="item">';	
               }
?>
        
          <img class="centro" src="<?php echo $row['slimg'] ?>" alt="<?php echo $row['slimg'] ?>" title="<?php echo $row['slalt'] ?>">
            
<?php 
              echo	"<div class='carousel-caption'>";

              if (($row['slcaption'] > '') || ($row['sldesc'] > '')) 
		    {
              echo	"<h1>".$row['slcaption']."</h1>";
              echo	"<p class='text-center'>".$row['sldesc']."</p>";	
              }
              if (($row['slink'] > '') || ($row['slinkcap'] > '')) {
              echo	"<p class='text-center'><a class='btn btn-lg btn-".TMP::$tcolor." page-scroll' href='".$row['slink']."' role='button' target='_new'>".$row['slinkcap']."</a></p>";              	
              }

              echo	"</div>";   //-- .carousel-caption -- 
              echo	"</div>";   //-- .carousel-inner -- 
?>               
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>


<?php 
     $count++;
          }  
?>  
</div>     <!-- #myCarousel -->
</section>