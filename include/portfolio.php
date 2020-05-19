<?php  
/* SEZIONE PORTFOLIO --------------------------------------------
   Elenca gli elementi del portfolio presi dalla tabella "por" in 
   base al layout e autodetermina la il numero di colonne che lo 
   compongono. Usa il valore del campo "pid" per differenziare i 
   riferimenti ai vari componenti.
   -------------------------------------------------------------*/  
echo "<section id='portfolio'>";

//-- Pannello --
	$head	= new section_head(TMP::$tportitle,TMP::$tportit,TMP::$tportext,TMP::$tcolor);
		$head->head();
     
// lettura portfolio
        $sql = "SELECT *
                FROM `".DB::$pref."por`
                WHERE ptmp= '".TMP::$tmenu."' 
                    and pstat <> 'A'
					and pcod = '$lcod' 
                ORDER BY pprog ";
				
		$stmt = $PDO->prepare($sql);
		$stmt->execute();		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		json_encode($rows);
		$colonne = $stmt->rowCount();

	echo "<div class='grid".$colonne." fb-col".$colonne." fb-bgcolor-".TMP::$tcolor."'>";
		
		foreach($rows as $row)
			{
			require'admin/fields_por.php';

//-- Elementi di portfolio -->
			echo "<div class='portfolio-thumbnail'>";
			echo "<a data-toggle='modal' href='#portfolio".$pid."'>";
			echo "<img src='".$pimg."' alt='".$pimg."'>  </a>";
			echo "<div class='portfolio-caption'>";
			echo "<h4 class='text-center'>".$pcapt."</h4>";
			echo "</div>";		//-- .portfolio-caption -->
			echo "</div>";		//-- .portfolio-thumbnail -->
//-- dialogo modale --
			$target	= "portfolio".$pid;
			$modal	= new dialogo_modale($target,$pmheader,$pimg,$pmlink,$pmtext);
			$modal->dialog();
			} 
	echo "</div>";		// grid	
	
echo "</section>";		
?> 