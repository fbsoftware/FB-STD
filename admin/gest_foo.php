<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'foo'.      
============================================================================= */ 

//   bottoni gestione
	$btx = new bottoni_str_par('Footer di pagina','foo','upd_foo.php',array('nuovo','modifica','cancella','chiudi'));     
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
echo "</div>"; 
// lettura database
     $sql =   "SELECT * 
               FROM ".DB::$pref."foo 
               ORDER BY fprog";

          foreach($PDO->query($sql) as $row)      
          {   
     require('fields_foo.php');      
     echo "<div class='tr'>";  
     $f1 = new fieldi($fid,'fid',2,'');               
     echo "<div class='td'>"; 
		$f1->field_ck(); echo "</div>";   
     echo "<div class='td'>"; 
$f2 = new input(array($fstat,'fstat',2,'','tooltip','st'));     
     $f2->field(); 
		echo "</div>";  
    		
     ?>   
     <div class='td'><?php echo $fprog ?></div>
     <div class='td'><?php echo $fcod ?></div>
     <div class='td'><?php echo htmlspecialchars($fdes, ENT_QUOTES) ?></div>
     <div class='td'><?php echo $ftipo ?></div>
	 <div class='td'><?php echo $ftmp ?></div>
            
<?php
     echo "</div>";
     }

     echo "</form>";
     echo "</div>";
?>