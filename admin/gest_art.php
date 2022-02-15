<?php session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 2.0
   * copyright	Copyright (C) 2011 - 2012 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ==========================================================================
   * Gestione articoli
   * ======================================================================= */

   //   toolbar
$param = array('nuovo','modifica','cancella','chiudi');
$btx   = new bottoni_str_par('Articoli','art','upd_art.php',$param);
     $btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
$parm = $_SESSION['esito'];
$m = new msg($parm);
$m->msg();

//  mostra tabella
echo "<section id='table'>";
echo "<div class='tableFixHead'>";
echo "<table class='table table-hover table-striped table-bordered table-condensed'>";
echo "<thead>";
echo "<th style='width:2%; text-align:center;'>Scelta</th>";
echo "<th style='width:2%; text-align:center;'>Stato</th>";
echo "<th style='width:2%; text-align:center;'>Progr.</th>";
echo "<th>Titolo</th>";
echo "<th>Argomento</th>";
echo "<th>Capitolo</th>";
echo "<th>Si/No titolo</th>"; 
echo "</thead>";
 echo "<tbody>";
$sql =    "SELECT * FROM `".DB::$pref."art`
                       ORDER BY `aprog` ";
// transazione
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction();
     foreach($PDO->query($sql) as $row)
          {
			require('fields_art.php');
			echo "<tr>";
			$f1 = new fieldi($aid,'aid',2,'');
			echo "<td class='center'>"; $f1->field_ck(); echo "</td>";
			$f2 = new fieldi($astat,'astat',2,'');
			echo "<td class='center'>"; $f2->field_st(); echo "</td>";
  ?>
			<td class="center"><?php echo $aprog ?></td>
			<td><?php echo $atit ?></td>
			<td><?php echo $aarg ?></td>
			<td><?php echo $acap ?></td>
			<td><?php echo $amostra ?></td>
<?php
			echo "</tr>";
          }
		  echo "</tbody>";
     echo "</table>";
	echo "</div>";
	echo "</section>";
	echo "</form>";
?>
