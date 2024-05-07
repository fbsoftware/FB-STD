<?php  session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'lay' layout di pagina.
	 		15/03/2022	aggiunta, copia nuove include in "write"
============================================================================= */
// toolbar
	$param  = array('nuovo','modifica','copia','cancella','chiudi');
	$btx = new bottoni_str_par('Layout di pagina','lay','upd_lay.php',$param);
		$btx->btn();

     // memorizza location iniziale
     $_SESSION['location'] = $_SERVER['QUERY_STRING'];
		 $_SESSION['tab'] = "lay";
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
echo "<div class='td'>Tipo</div>";
echo "<div class='td'>Template</div>";
echo "<div class='td'>Pagina</div>";
echo "<div class='td'>Require</div>";
echo "</div>";
// lettura database
     $sql =   "SELECT *
               FROM ".DB::$pref."lay
               ORDER BY lprog";

          foreach($PDO->query($sql) as $row)
          {
     require('fields_lay.php');
     echo "<div class='tr'>";
     echo "<div class='td'>";
     $f1 = new input(array($lid,'lid',2,'','','ck'));
          $f1->field(); echo "</div>";
     $q = new fieldi($lstat,'lstat',2,'');
     echo "<div class='td'>";
		 	$q->field_st(); echo "</div>";
	 ?>
          <div class='td'><?php echo $lprog ?></div>
          <div class='td'><?php echo $lcod ?></div>
          <div class='td'><?php echo htmlspecialchars($ldesc, ENT_QUOTES) ?></div>
          <div class='td'><?php echo $ltipo ?></div>
          <div class='td'><?php echo $ltmp ?></div>
          <div class='td'><?php echo $lpage ?></div>
          <div class='td'><?php echo $linclude ?></div>
<?php
     echo "</div>";
     }
	 echo "</div>";		// table
	 echo "</form>";

?>
