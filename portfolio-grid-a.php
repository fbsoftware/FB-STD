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
require_once(' '); 
$app->closeHead();

echo "<body> ";
echo "<section id='portfolio'>";

//-- Pannello --
	$head	= new section_head(2,TMP::$tportit,TMP::$tportext,TMP::$tcolor);
		$head->head();
     
$lcod="port-f1";//<=========  parametro  =======================================

// determina il tipo di griglia

        $sql = "SELECT *
                FROM `".DB::$pref."por`
                WHERE ptmp= '".TMP::$tmenu."' 
                    and pstat <> 'A'
					and pcod = '$lcod' 
                ORDER BY pprog ";
				
		Statomt = $PDO->prepare($sql);
		Statomt->execute();		
		$rows = Statomt->fetchAll(PDO::FETCH_ASSOC);
		json_encode($rows);
		$colonne = Statomt->rowCount();

	echo "<div class='grid".$colonne." fb-col".$colonne."'>";
		
		foreach($rows as $row)
			{
				require'fields_por.php';

//-- Elementi di portfolio -->

		echo "<div class='portfolio-thumbnail'>";
		echo "<a data-toggle='modal' href='#portfolio".$pid."'>";
		echo "<img src='".$pimg."' alt='".$pimg."'>  </a>";
			echo "<div>";
			echo "<h4 class='center'>".$pcapt."</h4>";
			echo "</div>";		//-- .portfolio-caption -->
		echo "</div>";		//-- .portfolio-thumbnail -->
		//-- dialogo modale --
		$target	= "portfolio".$pid;
		$modal	= new dialogo_modale($target,$pmheader,$pimg,$pmlink,$pmtext);
			$modal->dialog();
		} 
			
echo "</div>";		// grid	
            
echo "</section>";	
echo "</body> ";
echo "</html>";	
?> 

