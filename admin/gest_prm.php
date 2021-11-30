<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'prm' moduli 'promo'    
============================================================================= */ 
require_once('init_admin.php');
//   bottoni gestione
	$param = array('nuovo','modifica','cancella','chiudi');
	$btx = new bottoni_str_par('Moduli promo','prm','upd_prm.php',$param);     
     	$btx->btn();

// memorizza location iniziale
     $_SESSION['location'] = $_SERVER['QUERY_STRING'];
     
// zona messaggi
require_once 'msg.php';

//  mostra tabella
echo "<div class='table fb-hv80'>"; 
echo "<div class='th'>"; 
echo "<div class='td'>$SCEL</div>";
echo "<div class='td'>$ST</div>";
echo "<div class='td'>$PROG</div>"; 
echo "<div class='td'>$TEMP</div>";
echo "<div class='td'>$COD</div>";
echo "<div class='td'>$DESC</div>"; 
echo "</div>"; 
// lettura database
     $sql =   "SELECT * 
               FROM ".DB::$pref."prm 
               ORDER BY oprog";

          foreach($PDO->query($sql) as $row)      
          {   
     require('fields_prm.php');      
     echo "<div class='tr'>";  
     $f1 = new fieldi($oid,'oid',2,'');               
     echo "<div class='td'>"; 
		$f1->field_ck(); echo "</div>";   
     $st = new fieldi($ostat,'ostat',2,'');           
     echo "<div class='td'>"; 
		$st->field_st(); echo "</div>";   
     ?>   
     <div class="td"><?php echo $oprog ?></div>
     <div class='td'><?php echo $otmp ?></div>
     <div class='td'><?php echo $ocod ?></div>
     <div class='td'><?php echo htmlspecialchars($odes, ENT_QUOTES) ?></div>
            
<?php
     echo "</div>";
     }

     echo "</form>";
     echo "</div>";
?>