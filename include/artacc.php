<section id="artacc">

  <script>
  $( function() {
    $( "#accordion" ).accordion({
      collapsible: true,
	  heightStyle: "content"
    });
  } );
  </script>

<?php
// cerca nel layout gli articoli per accordion
 $sql = "SELECT *FROM `".DB::$pref."asl`
                WHERE dtmp = '".TMP::$tmenu."'
                    and dtipo = 'artacc'                
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
		  }
// conto gli articoli del capitolo
$count = count($testo);         

if ($count != 0) 
	{

// Pannello 
	$head = new section_head(TMP::$taccotitle,TMP::$taccotit,TMP::$taccotext,TMP::$tcolor);
		$head->head();

echo "<div id='accordion'>";

// lettura articoli
for ($i = 0; $i < $count; ++$i) 
		{
		echo "<h3>";
		echo $titolo[$i];
		echo "</h3>";
		echo "<div>";
		$a = new txt($testo[$i]);
		$a->ingloba();
		echo "</div>";                
		}
    }
 ?>    
</div>    <!-- accordion -->
</section>