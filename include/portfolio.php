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
		echo "<div class='f-flex fd-row  fb-bgcolor-pri'>"; 
		echo "<div>";
		if (TMP::$tportit > " ")  { echo "<h1>".TMP::$tportit."</h1>"; } 
		if (TMP::$tportext > " ") { echo "<p>".TMP::$tportext."</p>"; }
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

echo "<div class='f-flex fd-row jc-around'>";
		
		foreach($rows as $row)
			{
			require'admin/fields_por.php';

			// portfolio-elemento immagine  
			echo "<div>";
			$target	= "portfolio".$pid;
			echo "<p><a popup-open='".$target."' href='javascript:void(0)'>";
			echo "<img class='img-fit' src='".$pimg."' alt='".$pimg."'>  </a>";

			// portfolio-caption e bottone 
			echo "<div>";
			echo "<h3 class='center'>".$pcapt."</h3>";
				if ($pmlink >= ' ') 
	{ 	echo "<div class='widget'><a class='ui-button ui-widget' href='".$pmlink."' target='_new'>".$pmtext."</a></div>";} 
			echo "</div>";
			
			// dialogo modale 
		$modal	= new popup_modale($target,$pmheader,$pimg,$pmlink,$pmtext);
			$modal->popup();
			echo "</p>";

			echo "</div>";		// elemento 
			} 			

	echo "</div>";		// flex	
	
echo "</section>";		
?> 