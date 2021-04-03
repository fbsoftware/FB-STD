<?php
/* =========================================================
	Articoli di un capitolo in ACCORDION
   =======================================================*/
?>
<section id="artacc">

  <script>
  $( function() {
    $( "#accordion" ).accordion({
      collapsible: true,
	  heightStyle: "content"
    });
    $( "#accordion p" ).addClass(' fb-bgcolor-pri');
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
          foreach($PDO->query($sql) as $row)
          {  
			require('admin/fields_asl.php');	
			// stampa il titolo dell'accordion se richiesto
		
	if ($dtit_sn == 1) 
	{
		echo "<div class='f-flex fd-column ui-state-default ui-widget-content'>"; 
		if ($dtit > " ") { echo "<h1>".$dtit."</h1>"; } 
		if ($dtext > " ") { echo $dtext; }
		echo "</div>";	
	}  
  
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

// lettura articoli
	echo "<div id='accordion'>";
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
 ?>    
</div>    <!-- accordion -->
</section>
