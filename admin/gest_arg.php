<?php  session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'arg' argomenti.
   * 22/12/2013 incasellamento in tabella
============================================================================= */
//   toolbar
     $btx = new bottoni_str_par('Argomenti','arg','upd_arg.php',array('nuovo','modifica','copia','cancella','chiudi'));
          $btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
$parm = $_SESSION['esito'];
$m = new msg($parm);
$m->msg();

//   mostra la tabella filtrata --------------------------------------------------
echo "<section id='arg'>";



echo "<div class='th'>";
echo "<div class='td'>Scelta</div>";
echo "<div class='td'>Stato</div>";
echo "<div class='td'>Progr.</div>";
echo "<div class='td'>Codice</div>";
echo "<div class='td'>Descrizione</div>";
echo "<div class='td'>Si/No titolo</div>";
echo "</div>";

 // lettura database
     $sql = "   SELECT *
     FROM ".DB::$pref."arg
     ORDER BY rprog";
          foreach($PDO->query($sql) as $row)
  { require('fields_arg.php');
		echo "<div class='tr'>";
		$f2 = new input(array($rid,'rid',2,'','','ck-n'));
		echo "<div class='td'>";
      $f2->field_n(); echo "</div>";
		$s = new input(array($rstat,'rstat',2,'','','st-n'));
		echo "<div class='td'>";
      $s->field_n(); echo "</div>";

     echo "<div class='td'>$rprog</div>";
     echo "<div class='td'>".htmlspecialchars($rcod, ENT_QUOTES)."</div>";
     echo "<div class='td'>".htmlspecialchars($rdesc, ENT_QUOTES)."</div>";
     echo "<div class='td'>$rmostra</div>" ;
     echo "</div>";
}
	echo "</div>";
	echo "</section>";
	echo "</form>";
?>
