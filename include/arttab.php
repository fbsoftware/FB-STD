<section id="arttab">
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
			if ($row['atit']) // omette articoli vuoti
			{
			array_push($testo ,$row['atext']);	
			array_push($titolo,$row['atit']);
			}
          }
	} 

// pannello
		echo "<div class='f-flex fd-column fb-bgcolor-sec'>"; 
		echo "<div class='f-dim1'>";
		if (TMP::$ttabtit > " ")  { echo "<h1>".TMP::$ttabtit."</h1>"; } 
		if (TMP::$ttabtext > " ") { echo "<p>".TMP::$ttabtext."</p>"; }
		echo "</div>";
		echo "</div>";
?>			
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>

 <!-- articoli -->
<div class="f-flex fd-column">
<div id="tabs">
<?php
// lettura titoli per tab
// conto gli articoli del capitolo
$count = count($testo); 
 echo "<ul>";
for ($i = 0; $i < $count; ++$i)
	{
?>		
	<li class="fb-bgcolor-sec">
	<?php
	echo "<a href='#tab-".$i."' >".$titolo[$i]."</a></li>";	  
	}
	echo "</ul>";	
// lettura testi per tab 
for ($i = 0; $i < $count; ++$i)
	{
    echo "<div id='tab-".$i."'>";
    $a = new txt($testo[$i]);
		$a->ingloba();
    echo "</div>";                
	}  
echo "</div>";		// #tabs -->
echo "</div>";    	// flex -->
echo "</section>";
?>