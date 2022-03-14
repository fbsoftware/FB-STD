<?php  session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'cap' capitoli.
   * 2.0 aggiunto codice argomento del capitolo.
	07.03.21	tolto bootstrap sostituito da flex
=============================================================================*/

//   toolbar
$btx = new bottoni_str_par('Capitoli','cap','upd_cap.php',array('nuovo','modifica','copia','cancella','chiudi'));
     $btx->btn();
//print_r($_SESSION['esito']);

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
$parm = $_SESSION['esito'];
$m = new msg($parm);
$m->msg();

//   mostra la tabella filtrata --------------------------------------------------
echo "<section id='cap'>";

echo "<div class='table fb-hv80'>";

echo "<div class='th'>";
echo "<div class='td'>Scelta</div>";
echo "<div class='td'>Stato</div>";
echo "<div class='td'>Progr.</div>";
echo "<div class='td'>Codice</div>";
echo "<div class='td'>Descrizione</div>";
echo "<div class='td'>Si/No titolo</div>";
echo "</div>";
 // lettura database
     $sql = "  SELECT *
               FROM ".DB::$pref."cap
               ORDER BY cprog";
     foreach($PDO->query($sql) as $row)
     {
          require('fields_cap.php');
			echo "<div class='tr'>";
		$f2 = new input(array($cid,'cid',2,'','','ck-n'));
		echo "<div class='td'>";
      $f2->field_n(); echo "</div>";
		$s = new input(array($cstat,'cstat',2,'','','st-n'));
		echo "<div class='td'>";
      $s->field_n(); echo "</div>";

          echo "<div class='td'>".$cprog."</div>";
          echo "<div class='td'>".$ccod."</div>";
          echo "<div class='td'>".htmlspecialchars($cdesc, ENT_QUOTES)."</div>";
          echo "<div class='td'>".$cmostra."</div>";
          echo "</div>";
      }
	echo "</div>";
	echo "</section>";
	echo "</form>";
?>
