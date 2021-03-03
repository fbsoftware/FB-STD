<section id="artacc">

<?php
// cerca nel layout gli articoli per i tab
        $sql = "SELECT *
                FROM `".DB::$pref."asl`
                WHERE dtmp = '".TMP::$tmenu."'
                    and dtipo = 'arttab'                
                    and dstat <> 'A' 
                    and dcod = '$lcod'
                ORDER BY dprog ";
          foreach($PDO->query($sql) as $rowx)
          {     
          $dcap     =    $rowx['dcap'];
          $ddes     =    $rowx['ddes'];
// lettura articoli della categoria
           $titolo = array();
           $testo  = array();
        $sql = "SELECT *
                FROM `".DB::$pref."art`
                WHERE acap = '$dcap'
                    and astat <> 'A' 
                ORDER BY aprog ";
           foreach($PDO->query($sql) as $row)
          {     
          array_push($testo ,$row['atext']);
          array_push($titolo,$row['atit']);
          }
           
?>

<!-- sezione 
<!-- Pannello -->
<div class="row">
<div class="col-lg-12 fb-bgcolor-<?php echo TMP::$tcolor; ?>"><h1><?php echo $ddes; ?></h1></div>
</div>

 <!-- articoli -->
<div class="row">
<div>
<div id="segnalazioni-tab">
 <ul class="nav nav-tabs">
 
<?php
// lettura titoli per tab
foreach ( $titolo as $chiave => $valore) 
{
            if ($chiave == 0) 
               {
         //      echo "<li class='active'><a class='fb-bgcolor-".TMP::$tcolor."'  href='#tab-".$chiave."' data-toggle='tab'>$valore</a></li>";	
               }
      //    else
               {
               echo "<li><a class='fb-color-".TMP::$tcolor." fb-bgcolor-default' href='#tab-".$chiave."' data-toggle='tab'>$valore</a></li>";
               }   
} 
 ?>    

 </ul>
 <div class="tab-content">

<?php
// lettura testi per tab
foreach ( $testo as $chiave => $valore) 
{
            if ($chiave == 0) 
               {
               echo "<div class='tab-pane active' id='tab-".$chiave."'>";
               $a = new txt($valore);
               $a->ingloba();
               }
          else
               {
               echo "<div class='tab-pane' id='tab-".$chiave."'>";
               $a = new txt($valore);
               $a->ingloba();
               }  
          echo "</div>";                
} 
 ?>    
</div>
</div>
</div>    <!-- /.col-sm-12 -->
</div>    <!-- /.row -->
</section>
<?php
     };
      //    };
?>