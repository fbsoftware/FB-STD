<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'lay' layout di pagina.   
============================================================================= */ 
// toolbar
	$param  = array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi');
	$btx = new bottoni_str_par($LAY,'lay','upd_lay.php',$param);     
		$btx->btn();

     // memorizza location iniziale
     $_SESSION['location'] = $_SERVER['QUERY_STRING'];
     
// zona messaggi
require_once 'msg.php';

//  mostra tabella
echo "<div class='table fb-h80'>"; 

echo "<div class='th'>"; 
echo "<div class='td'>$SCEL</div>";
echo "<div class='td'>$ST</div>";
echo "<div class='td'>$PROG</div>"; 
echo "<div class='td'>$COD</div>";
echo "<div class='td'>$DESC</div>";
echo "<div class='td'>$TIPO</div>";
echo "<div class='td'>$TEMP</div>";
echo "<div class='td'>$INCL</div>";
echo "</div>"; 
// lettura database
     $sql =   "SELECT * 
               FROM ".DB::$pref."lay 
               ORDER BY lprog";

          foreach($PDO->query($sql) as $row)      
          {   
     require('fields_lay.php');      
     echo "<div class='tr'>";  
     echo "<div class='td'>"; 
     $f1 = new input(array($lid,'lid',2,'','','ck'));
          $f1->field(); echo "</div>";        
     $st = new fieldi($lstat,'lstat',2,'');           
     echo "<div class='td'>"; $st->field_st(); echo "</div>";   
	 ?>   
          <div class='td'><?php echo $lprog ?></div>
          <div class='td'><?php echo $lcod ?></div>  
          <div class='td'><?php echo htmlspecialchars($ldesc, ENT_QUOTES) ?></div>
          <div class='td'><?php echo $ltipo ?></div> 
          <div class='td'><?php echo $ltmp ?></div>
          <div class='td'><?php echo $linclude ?></div>  
<?php
     echo "</div>";
     }
	 echo "</div>";		// table
	 echo "</form>";

?>