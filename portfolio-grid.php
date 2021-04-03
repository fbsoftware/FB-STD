<?php
require_once('loadLibraries.php');
require_once('loadTemplateSito.php');
require_once("connectDB.php");
// DOCTYPE & head
$app = new Head('Gestione menu');
$app->openHead();
require_once("jquery_link.php");
//require_once("bootstrap_link.php");
require_once("include_head.php");
require_once('lingua.php'); 
?>
	<link rel="stylesheet" type="text/css" href="css/fb-grid.css" />
<?php
$app->closeHead();

echo "<body> ";
echo "<section id='portfolio'>";

//-- Pannello --
	$head	= new section_head(2,TMP::$tportit,TMP::$tportext,TMP::$tcolor);
		$head->head();
     
$count    = 0;
$lcod="port-f1";

// determina iul tipo di griglia

        $sql = "SELECT *
                FROM `".DB::$pref."por`
                WHERE ptmp= '".TMP::$tmenu."' 
                    and pstat <> 'A'
				and pcod = '$lcod' 
                ORDER BY pprog ";
          foreach($PDO->query($sql) as $row)
               {    
               $count++; 
			   }
			   
switch ($count) {
case 1 :	$ncol="fb-col12";
			$grid="grid12";
			break;
case 2 :	$ncol="fb-col6";
			$grid="grid6";
			break;
case 3 :	$ncol="fb-col4";
			$grid="grid4";
			break;
case 4 :	$ncol="fb-col3";
			$grid="grid3";
			break;
}
// ----------------------------------------------------

echo "<div class='".$grid."'>";
$count    = 0;
// lettura portfolio
        $sql = "SELECT *
                FROM `".DB::$pref."por`
                WHERE ptmp= '".TMP::$tmenu."' 
                    and pstat <> 'A'
				and pcod = '$lcod' 
                ORDER BY pprog ";
          foreach($PDO->query($sql) as $row)
               {    
               require'fields_por.php';
		   

//-- Elementi di portfolio -->
	echo "<div class='grid ".$ncol."'>";
		echo "<div class='portfolio-thumbnail'>";
		echo "<a data-toggle='modal' href='#portfolio".$count."'>";
		echo "<img src='".$pimg."' alt='".$pimg."'>  </a>";
			echo "<div>";
			echo "<h3 class='center'>".$pcapt."</h4>";
			echo "</div>";		//-- .portfolio-caption -->
		echo "</div>";		//-- .portfolio-thumbnail -->
		//-- dialogo modale --
		$target	= "portfolio".$count;
		$modal	= new dialogo_modale($target,$pmheader,$pimg,$pmlink,$pmtext);
			$modal->dialog();			
	echo "</div>";		//-- .col... -->
	$count++;
}  
echo "</div>";		// grid4	
            
echo "</section>";	
echo "</body> ";
echo "</html>";	
?> 

