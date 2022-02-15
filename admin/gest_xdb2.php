<?php    session_start();       ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3
   * copyright	Copyright (C) 2022 - 2023 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'xdb' sipologie codificate.
   * 28/5/2019	aggiunta copia
============================================================================= */
require_once('init_admin.php');
echo "<body class='admin' data-theme='".TMP::$tcolor."'>";

 //   toolbar
$param = array("nuovo","modifica","copia","cancella","ritorno");
$btx   = new bottoni_str_par('Tipologie','xdb','upd_xdb.php',$param);
     $btx->btn();

     // mostra la tabella filtrata

echo "<section id='xdb'>";

echo "<div class='table fb-hv80'>";

echo "<div class='th'>";
echo "<div class='td'>Scelta</div>";
echo "<div class='td'>Stato</div>";
echo "<div class='td'>Progr.</div>";
echo "<div class='td'>Settore</div>";
echo "<div class='td'>Codice</div>";
echo "<div class='td'>Descrizione</div>";
echo "</div>";

 // lettura database
if ($_POST['settori'] == 'tutti')
	{     $sql = "SELECT *
               FROM ".DB::$pref."xdb
               ORDER BY xtipo,xcod";	}
else {
	     $sql = "SELECT *
               FROM ".DB::$pref."xdb
			   WHERE xtipo = '".$_POST['settori']."'
               ORDER BY xtipo,xcod";
}

// transazione
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction();
      foreach($PDO->query($sql) as $row)
          {
          require('fields_xdb.php');
          echo "<div class='tr'>";
		$f2 = new input(array($xid,'xid',2,'','','ck-n'));
		echo "<div class='td'>";
      $f2->field_n(); echo "</div>";
		$f = new input(array($xstat,'xstat',2,'','','st-n'));
		echo "<div class='td'>";
      $f->field_n(); echo "</div>";
                    ?>
          <div class='td'><?php echo $xprog ?></div>
          <div class='td'><?php echo $xtipo ?></div>
          <div class='td'><?php echo $xcod ?></div>
          <div class='td'><?php echo $xdes ?></div>
          <?php
     echo "</div>";
          }
	echo "</div>";
	echo "</section>";
	echo "</form>";
	echo "</body>";
?>
