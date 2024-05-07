<?php    session_start();       ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3
   * copyright	Copyright (C) 2022 - 2024 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'spz' spaziature fra moduli
============================================================================= */
 //   toolbar
$param = array("nuovo","modifica","copia","cancella","ritorno");
$btx   = new bottoni_str_par('Spaziature','spz','upd_spz.php',$param);
     $btx->btn();
// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];
     // mostra la tabella filtrata

echo "<section id='spazio'>";

echo "<div class='table fb-hv80'>";

echo "<div class='th'>";
echo "<div class='td'>Scelta</div>";
echo "<div class='td'>Stato</div>";
echo "<div class='td'>Progr.</div>";
echo "<div class='td'>Template</div>";
echo "<div class='td'>Pagina</div>";
echo "<div class='td'>Codice</div>";
echo "<div class='td'>Spaziatura</div>";
echo "<div class='td'>Descrizione</div>";
echo "</div>";

 // lettura database
	     $sql = "SELECT *
               FROM ".DB::$pref."spz
			ORDER BY rcod";

// transazione
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction();
      foreach($PDO->query($sql) as $row)
          {
          require('fields_spz.php');
          echo "<div class='tr'>";
     $f2 = new input(array($rid,'rid',2,'','','ck-n'));
		echo "<div class='td'>";
     $f2->field_n(); echo "</div>";
		$f = new input(array($rstat,'rstat',2,'','','st-n'));
		echo "<div class='td'>";
     $f->field_n(); echo "</div>";
                    ?>
          <div class='td'><?php echo $rprog ?></div>
          <div class='td'><?php echo $rtmp ?></div>
          <div class='td'><?php echo $rpage ?></div>
          <div class='td'><?php echo $rcod ?></div>
          <div class='td'><?php echo $rspa ?></div>
          <div class='td'><?php echo $rdesc ?></div>
          <?php
     echo "</div>";
          }
	echo "</div>";
	echo "</section>";
	echo "</form>";
	echo "</body>";
?>