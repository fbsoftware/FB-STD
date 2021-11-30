<?php  session_start(); 
/*** ========================================================================
	*   	TEMPLATE PER APP GEST_XXX.PHP
	*========================================================================
   * Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'ctt'.      
============================================================================= */ 

//   bottoni gestione
	$btx = new bottoni_str_par('Contatti','ctt','upd_ctt.php',array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi'));     
     	$btx->btn();

// memorizza location iniziale
     $_SESSION['location'] = $_SERVER['QUERY_STRING'];
     
// zona messaggi
require_once 'msg.php';

//   mostra la tabella filtrata --------------------------------------------------
echo "<section id='ctt'>"; 

echo "<div class='table fb-hv80'>"; 
   
echo "<div class='th'>"; 
echo "<div class='td'>$SCEL</div>";
echo "<div class='td'>$ST</div>";
echo "<div class='td'>$PROG</div>"; 
echo "<div class='td'>$COD</div>";
echo "<div class='td'>$DESC</div>";
echo "<div class='td'>$TEMP</div>";
echo "</div>"; 
// lettura database
     $sql =   "SELECT * 
               FROM ".DB::$pref."ctt 
               WHERE estat <> 'A'    
               ORDER BY eprog";

          foreach($PDO->query($sql) as $row)      
          {   
     require('fields_ctt.php');      
			echo "<div class='tr'>";
		$f2 = new input(array($eid,'eid',2,'',$TT_SCEL,'ck-n'));     
		echo "<div class='td'>"; $f2->field_n(); echo "</div>";
		$st = new input(array($estat,'estat',2,'','','st-n'));        
		echo "<div class='td'>"; $st->field_n(); echo "</div>";		
?>   
     <div class='td'><?php echo $eprog ?></div>
     <div class='td'><?php echo $ecod ?></div>
     <div class='td'><?php echo $edes ?></div>
     <div class='td'><?php echo $etmp ?></div>
     </div>
     
<?php
    }
	echo "</div>";
	echo "</section>";
	echo "</form>";
?>