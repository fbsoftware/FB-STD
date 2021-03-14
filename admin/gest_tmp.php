<?php  
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * -------------------------------------------------------------------------
   * Gestione dei templates      
============================================================================= */
  
//   toolbar
$btx = new bottoni_str_par($TEMPLATES,'tmp','upd_tmp.php',array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi'));     
     $btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];
     
// zona messaggi
require_once 'msg.php'; 

//  testata di tabella 
echo "<section id='tmp'>";

echo "<div class='table fb-h80'>"; 
   
echo "<div class='th'>"; 
echo "<div class='td'>$SCEL</div>";
echo "<div class='td'>$ST</div>";
echo "<div class='td'>$PROG</div>";  
echo "<div class='td'>Selezionato</div>";
echo "<div class='td'>Codice</div>";
echo "<div class='td'>Tipo</div>";
echo "<div class='td'>Percorso</div>";
echo "<div class='td'>Descrizione</div>";
echo "<div class='td'>Menù</div>";
echo "<div class='td'>Lingua</div>";
echo "</div>"; 
// mostra la tabella  --------------------------------------------------
     $sql = "  SELECT * 
               FROM `".DB::$pref."tmp` 
               ORDER BY `tprog` ";
          foreach($PDO->query($sql) as $row)      
          {
           require('fields_tmp.php');
		echo "<div class='tr'>";
		$f2 = new input(array($tid,'tid',2,'',$TT_SCEL,'ck-n'));     
		echo "<div class='td'>"; $f2->field_n(); echo "</div>";
		$st = new input(array($tstat,'tstat',2,'','','st-n'));        
		echo "<div class='td'>"; $st->field_n(); echo "</div>";		   

?>
	<div class="td"><?php echo $tprog ?></div>
<?php 
	echo "<div class='td'>"; 
	$f2 = new input(array($tsel,'tsel',1,'','tooltip','star-n'));     
     $f2->field_n();     	
	echo "</div>"; 
?>
	<div class='td'><?php echo $tcod ?></div>
	<div class='td'><?php echo $ttipo ?></div>
	<div class='td'><?php echo $tfolder ?></div>
	<div class='td'><?php echo $tdesc ?></div>
	<div class='td'><?php echo $tmenu ?></div>
	<div class='td'><?php echo $tlang ?></div>
<?php
     echo "</div>";               
          }
	echo "</div>";
	echo "</section>";
	echo "</form>";  
?> 