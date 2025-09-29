<?php  session_start();
/*** ========================================================================
	*   	TEMPLATE PER APP GEST_XXX.PHP
	*========================================================================
   * Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2022 - 2023 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'ctt'.
============================================================================= */

//   bottoni gestione
	$btx = new bottoni_str_par('Contatti','ctt','upd_ctt.php',array('nuovo','modifica','copia','cancella','chiudi'));
     	$btx->btn();

// memorizza location iniziale
     $_SESSION['location'] = $_SERVER['QUERY_STRING'];
$_SESSION['tab'] = "ctt";
// zona messaggi
$parm = $_SESSION['esito'];
$m = new msg($parm);
$m->msg();

//   mostra la tabella filtrata --------------------------------------------------
echo "<section id='ctt'>";

echo "<div class='table fb-hv80'>";

echo "<div class='th'>";
echo "<div class='td'>Scelta</div>";
echo "<div class='td'>Stato</div>";
echo "<div class='td'>Progr.</div>";
echo "<div class='td'>Codice</div>";
echo "<div class='td'>Descrizione</div>";
echo "<div class='td'> Template</div>";
echo "</div>";
// lettura database
     $sql =   "SELECT *
               FROM ".DB::$pref."ctt
               WHERE estat <> 'A'
               ORDER BY eprog";

          foreach($PDO->query($sql) as $row)
          {
     require('fields_ctt.php');
			echo "<div class='tr'>";

               $f1 = new fieldi($eid,'eid',2,'');
                    echo "<div class='td'>";
				$f1->field_ck(); echo "</div>";
		
		$s = new input(array($estat,'estat',2,'','','st-n'));
		echo "<div class='td'>";
			$s->field_n(); echo "</div>";
?>
     <div class='td'><?php echo $eprog ?></div>
     <div class='td'><?php echo $ecod ?></div>
     <div class='td'><?php echo $edes ?></div>
     <div class='td'><?php echo $etmp ?></div>
     </div>

<?php
    }
	echo "</div>";
	echo "</section>";
	echo "</form>";
?>
