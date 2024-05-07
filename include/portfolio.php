<?php
/**
  SEZIONE PORTFOLIO --------------------------------------------
   Elenca gli elementi del portfolio presi dalla tabella "por" in
   base al layout e autodetermina il numero di colonne che lo
   compongono. Usa il valore del campo "pid" per differenziare i
   riferimenti ai vari componenti.
   =============================================================
   06/20/22 titoli generali dal record e non dal template
   -------------------------------------------------------------*/
echo "<section id='portfolio'>";
?>
  <script>
  $( function() {
  $( ".fb-primary p" ).addClass('fb-primary');
    $( ".fb-primary h1" ).addClass('fb-primary');
  } );
  </script>
<?php
// stampa il titolo se richiesto
	if ((TMP::$tportitle == 1) && ($cnt <= 0))
	{
		echo "<div class='f-flex fd-row  fb-primary'>";
		echo "<div>";
		if (TMP::$tportit > " ")  { echo "<h1>".TMP::$tportit."</h1>"; }
		if (TMP::$tportext > " ") { echo "<p>".TMP::$tportext."</p>"; }
		echo "</div>";
		echo "</div>";
		$cnt = 1;
	}

// lettura portfolio
        $sql = "SELECT *
                FROM `".DB::$pref."por`
                WHERE ptmp= '".TMP::$tmenu."'
                    and pstat <> 'A'
					and pcod = '$lcod'
                ORDER BY pprog ";

		$sttmt = $PDO->prepare($sql);
		$sttmt->execute();
		$rows = $sttmt->fetchAll(PDO::FETCH_ASSOC);
		json_encode($rows);
		$colonne = $sttmt->rowCount();

echo "<div class='f-flex fd-row jc-around fb-secondary'>";
		foreach($rows as $row)
			{
			require'admin/fields_por.php';
			// portfolio-elemento immagine
			echo "<div>";
			$target	= "portfolio".$pid;
			echo "<p><a class='trasp' popup-open='".$target."' href='javascript:void(0)'>";
			echo "<img class='img-fit fb-hp150' src='".$pimg."' alt='".$pimg."'>  </a>";

			// portfolio-caption e bottone
			echo "<div>";
			echo "<h3 class='center'>".$pcapt."</h3>";
				if ($pmlink >= ' ')
	{ 	echo "<div class='center'><a class='fb-button fb-p025 fb-rad5 fb-upper' href='".$pmlink."' target='_new'>".$pmtext."</a></div>";}
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
