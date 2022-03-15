<?php  session_start();
/**
 Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
    package		FB open template
    versione 3.1
    copyright	Copyright (C) 2022 - 2023 FB. All rights reserved.
    license		GNU/GPL
    Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
    all'uso anche improprio di FB open template.
    ------------------------------------------------------------------------
    gestione tabella 'foo'.
	 15/03/2022	aggiunta copia, nuove include in "write"
============================================================================= */

//   bottoni gestione
	$btx = new bottoni_str_par('Footer','foo','upd_foo.php',array('nuovo','modifica','copia','cancella','chiudi'));
     	$btx->btn();

// memorizza location iniziale
     $_SESSION['location'] = $_SERVER['QUERY_STRING'];
		 $_SESSION['tab'] = "foo";

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
echo "<div class='td'>$COD</div>";
echo "<div class='td'>Descrizione</div>";
echo "<div class='td'>Tipo</div>";
echo "<div class='td'> Template</div>";
echo "</div>";
// lettura database
     $sql =   "SELECT *
               FROM ".DB::$pref."foo
               ORDER BY fprog";

          foreach($PDO->query($sql) as $row)
          {
     require('fields_foo.php');
     echo "<div class='tr'>";
     $f1 = new fieldi($fid,'fid',2,'');
     echo "<div class='td'>";
		$f1->field_ck(); echo "</div>";
     echo "<div class='td'>";
$f2 = new input(array($fstat,'fstat',2,'','tooltip','st'));
     $f2->field();
		echo "</div>";

     ?>
     <div class='td'><?php echo $fprog ?></div>
     <div class='td'><?php echo $fcod ?></div>
     <div class='td'><?php echo htmlspecialchars($fdes, ENT_QUOTES) ?></div>
     <div class='td'><?php echo $ftipo ?></div>
	 <div class='td'><?php echo $ftmp ?></div>

<?php
     echo "</div>";
     }

     echo "</form>";
     echo "</div>";
?>
