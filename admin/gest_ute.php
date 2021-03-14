<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.02    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= */

//   bottoni gestione
	$param = array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi');
	$btx   = new bottoni_str_par($UTES,'ute','upd_ute.php',$param);     
		$btx->btn();
     
// memorizza location iniziale
	$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
require_once 'msg.php';

//   testate
echo "<section id='ute'>"; 

echo "<div class='table fb-h80'>"; 

echo "<div class='th'>"; 
echo "<div class='td'>$SCEL</div>";
echo "<div class='td'>$ST</div>";
echo "<div class='td'>$PROG</div>"; 
echo "<div class='td'>Utente</div>";
echo "<div class='td'>Livello accesso</div>";
echo "</div>";

// transazione
     $sql = "SELECT * FROM `".DB::$pref."ute`
          ORDER BY username";
     foreach($PDO->query($sql) as $row)
     {
     require('fields_ute.php');                 
     echo "<div class='tr'>";
		$f2 = new input(array($uid,'uid',2,'',$TT_SCEL,'ck-n'));     
		echo "<div class='td'>"; $f2->field_n(); echo "</div>";
		$st = new input(array($ustat,'ustat',2,'','','st-n'));        
		echo "<div class='td'>"; $st->field_n(); echo "</div>";
?>
     <div class='td'><?php echo $uprog ?></div>
     <div class='td'><?php echo $username ?></div>
     <div class='td'><?php echo $uaccesso ?></div>
<?php              
     echo "</div>";               
          }
	echo "</div>";
	echo "</section>";
	echo "</form>";
?>
