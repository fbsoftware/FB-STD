<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.0    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= 
	07.03.21	tolto bootstrap sostituito da flex    
=============================================================================*/ 
// toolbar
	$param  = array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi');    
	$btx    = new bottoni_str_par($MENU,'mnu','upd_mnu.php',$param);  
		$btx->btn();
		
// memorizza location iniziale
	$_SESSION['location'] = $_SERVER['QUERY_STRING'];
	
// zona messaggi
require_once 'msg.php';
 
//   testata
echo "<section id='mnu'>";

echo "<div class='table fb-h80'>"; 
   
echo "<div class='th'>"; 
echo "<div class='td'>$SCEL</div>";
echo "<div class='td'>$ST</div>";
echo "<div class='td'>$PROG</div>"; 
echo "<div class='td'>$NAME</div>";
echo "<div class='td'>$TIPO</div>";
echo "<div class='td'>$DESC</div>";
echo "<div class='td'>$SEL</div>";
echo "</div>";   


$sql = "SELECT * FROM ".DB::$pref."mnu 
		ORDER BY bprog";
	foreach($PDO->query($sql) as $row)
      {       
		require('fields_mnu.php');
		echo "<div class='tr'>";
		$f2 = new input(array($bid,'bid',2,'',$TT_SCEL,'ck-n'));     
		echo "<div class='td'>"; $f2->field_n(); echo "</div>";
		$st = new input(array($bstat,'bstat',2,'','','st-n'));        
		echo "<div class='td'>"; $st->field_n(); echo "</div>";
  ?>
		<div class='td'><?php echo $bprog ?></div>
		<div class='td'><?php echo $bmenu ?></div>
		<div class='td'><?php echo $btipo ?></div>
		<div class='td'><?php echo $btesto ?></div>
		<div class='td'><?php echo $bselect ?></div>
<?php
     echo "</div>";               
          }
	echo "</div>";
	echo "</section>";
	echo "</form>";
?> 
