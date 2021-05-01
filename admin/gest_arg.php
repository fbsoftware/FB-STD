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
     $btx = new bottoni_str_par($ARGS,'arg','upd_arg.php',array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi'));     
          $btx->btn();
              
// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
require_once 'msg.php';

//   mostra la tabella filtrata --------------------------------------------------
echo "<section id='arg'>"; 


   
echo "<div class='th'>"; 
echo "<div class='td'>$SCEL</div>";
echo "<div class='td'>$ST</div>";
echo "<div class='td'>$PROG</div>"; 
echo "<div class='td'>$COD</div>";
echo "<div class='td'>$DESC</div>";
echo "<div class='td'>$S_N_TIT</div>";
echo "</div>"; 

 // lettura database
     $sql = "   SELECT * 
     FROM ".DB::$pref."arg
     ORDER BY rprog";
          foreach($PDO->query($sql) as $row)
  { require('fields_arg.php');
		echo "<div class='tr'>";
		$f2 = new input(array($rid,'rid',2,'',$TT_SCEL,'ck-n'));     
		echo "<div class='td'>"; $f2->field_n(); echo "</div>";
		$st = new input(array($rstat,'rstat',2,'','','st-n'));        
		echo "<div class='td'>"; $st->field_n(); echo "</div>"; 
	 
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