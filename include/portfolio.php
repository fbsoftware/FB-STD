<?php    
echo "<section id='portfolio'>";
//-- Pannello --
	$head	= new section_head(TMP::$tportitle,TMP::$tportit,TMP::$tportext,TMP::$tcolor);
		$head->head();
     
$count    = 0;
// echo "<div class='row'>";
// lettura portfolio
        $sql = "SELECT *
                FROM `".DB::$pref."por`
                WHERE ptmp= '".TMP::$tmenu."' 
                    and pstat <> 'A'
				and pcod = '$lcod' 
                ORDER BY pprog ";
          foreach($PDO->query($sql) as $row)
               {    
               include'fields_por.php';
               $count++;            

//-- Elementi di portfolio -->
echo "<div class='".$pcol."'>";
echo "<div class='portfolio-thumbnail'>";
echo "<a data-toggle='modal' href='#portfolio".$count."'>";
echo "<img src='".$pimg."' alt='".$pimg."'>  </a>";
echo "<div class='portfolio-caption'>";
echo "<h4 class='text-center'>".$pcapt."</h4>";
echo "</div>";		//-- .portfolio-caption -->
echo "</div>";		//-- .portfolio-thumbnail -->
echo "</div>";		//-- .col... -->
			
//-- dialogo modale --
$target	= "portfolio".$count;
$modal	= new dialogo_modale($target,$pmheader,$pimg,$pmlink,$pmtext);
	$modal->dialog();
}              
echo "</section>";		
?> 