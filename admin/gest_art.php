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
=============================================================================
	07.03.21	tolto bootstrap sostituito da flex
=============================================================================*/
require_once('init_admin.php');
   //   toolbar
$param = array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi');
$btx   = new bottoni_str_par($ARTS,'art','upd_art.php',$param);
     $btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
require_once 'msg.php';

// prefisso eventuale
 echo  "<fieldset class='fb-w25'>";
$f3 = new input(array('','progre',10,'Parti dal progressivo:',' ','i'));
    $f3->field();
 echo  "</fieldset>";

//  mostra tabella
echo "<section id='art'>";
echo "<div class='table fb-hv80'>";
echo "<div class='th'>";
echo "<div class='td'>$SCEL</div>";
echo "<div class='td'>$ST</div>";
echo "<div class='td'>$PROG</div>";
echo "<div class='td'>$COD</div>";
echo "<div class='td'>Categoria</div>";
echo "<div class='td'>$TIT</div>";
echo "<div class='td'>$PREZ</div>";
//echo "<div class='td'>$DESC</div>";
//echo "<div class='td'>$IMG</div>";
echo "</div>";

$sql =    "SELECT * FROM `".DB::$pref."art`
                       ORDER BY `aprez` DESC";
// transazione
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction();
     foreach($PDO->query($sql) as $row)
          {
			require('fields_art.php');
		echo "<div class='tr'>";
		$f2 = new input(array($aid,'aid',2,'',$TT_SCEL,'ck'));
		echo "<div class='td'>"; $f2->field(); echo "</div>";
		$st = new input(array($astat,'astat',2,'','','st'));
		echo "<div class='td'>"; $st->field(); echo "</div>";
  ?>
			<div class="td"><?php echo $aid ?></div>
			<div class='td'><?php echo $acod ?></div>
			<div class='td'><?php echo $acat ?></div>
			<div class='td'><?php echo $atit ?></div>
			<div class='td'><?php echo $aprez ?></div>
<!--			<div class='td'><?php echo $ades ?></div>
			<div class='td'><?php echo $aimg ?></div>  -->
<?php
     echo "</div>";
          }
	echo "</div>";
	echo "</section>";
	echo "</form>";
?>
