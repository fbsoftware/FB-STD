<?php  
/* SEZIONE PORTFOLIO --------------------------------------------
   Elenca gli elementi del portfolio presi dalla tabella "por" in 
   base al layout e autodetermina la il numero di colonne che lo 
   compongono. Usa il valore del campo "pid" per differenziare i 
   riferimenti ai vari componenti.
   -------------------------------------------------------------*/  
echo "<section id='portfolio'>";

// stampa il titolo se richiesto
	if (TMP::$tportitle == 1) 
	{
		echo "<div class='f-flex fd-column fb-bgcolor-".TMP::$tcolor."'>"; 
		echo "<div class='f-dim1'>";
		if (isset(TMP::$tportit)) { echo "<h1>".TMP::$tportit."</h1>"; } 
				if (isset(TMP::$tportext)) { echo "<p>".TMP::$tportext."</p>"; }
		echo "</div>";
		echo "</div>";
	}  
            
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

echo "<div class='f-flex fd-row jc-between  ai-stretch'>";
		
		foreach($rows as $row)
			{
			require'admin/fields_por.php';

			//-- Elementi di portfolio -->
			echo "<div class='f-dim1'>";
			echo "<a data-toggle='modal' href='#portfolio".$pid."'>";
			echo "<img src='".$pimg."' alt='".$pimg."' width='250'>  </a>";

			//-- .portfolio-caption -->
			echo "<div class='portfolio-caption'>";
			echo "<h4 class='text-center'>".$pcapt."</h4>";
			echo "</div>";
			
			//-- dialogo modale --
			$target	= "portfolio".$pid;
			$modal	= new dialogo_modale($target,$pmheader,$pimg,$pmlink,$pmtext);
			$modal->dialog();
			echo "</div>";		//-- elemento -->
			} 			

	echo "</div>";		// flex	
	
echo "</section>";		
?> 