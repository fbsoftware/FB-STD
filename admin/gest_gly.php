<?php  session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'gly' icone.
============================================================================= */

//   bottoni gestione
	$btx = new bottoni_str_par('Icone','gly','upd_gly.php',array('nuovo','modifica','cancella','chiudi'));
     	$btx->btn();

// memorizza location iniziale
     $_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
$parm = $_SESSION['esito'];
$m = new msg($parm);
$m->msg();

//  mostra tabella
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
               FROM ".DB::$pref."gly
               WHERE gstat <> 'A'
               ORDER BY gprog";

          foreach($PDO->query($sql) as $row)
          {
     require('fields_gly.php');
     echo "<div class='tr'>";
     $f1 = new fieldi($gid,'gid',2,'');
     echo "<div class='td'>"; 
		$f1->field_ck(); echo "</div>";
     $st = new fieldi($gstat,'gstat',2,'');
     echo "<div class='td'>";
		$st->field_st(); echo "</div>";
     ?>
     <div class='td'><?php echo $gprog ?></div>
     <div class='td'><?php echo $gcod ?></div>
     <div class='td'><?php echo htmlspecialchars($gdes, ENT_QUOTES) ?></div>
     <div class='td'><?php echo $gtmp ?></div>
<?php
     echo "</div>";
     }
     echo "</form>";
     echo "</div>";
?>
