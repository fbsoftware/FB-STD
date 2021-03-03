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
echo "<div class='tableFixHead'>";
echo "<table class='table table-striped table-bordered table-condensed'>"; 
echo "<thead>"; 
echo "<th style='width:2%; text-align:center;'>$SCEL</th>";
echo "<th style='width:2%; text-align:center;'>$ST</th>";
echo "<th style='width:2%; text-align:center;'>$PROG</th>"; 
echo "<th>$COD</th>";
echo "<th>$DESC</th>"; 
echo "<th>$TIPO</th>";
echo "<th>$TEMP</th>";
echo "</thead>";
echo "<tbody>";
// lettura database
     $sql =   "SELECT * 
               FROM ".DB::$pref."foo 
               ORDER BY fprog";

          foreach($PDO->query($sql) as $row)      
          {   
     require('fields_foo.php');      
     echo "<tr>";  
     $f1 = new fieldi($fid,'fid',2,'');               
     echo "<td class='center'>"; 
		$f1->field_ck(); echo "</td>";   
     echo "<td class='center'>"; 
$f2 = new input(array($fstat,'fstat',2,'','tooltip','st'));     
     $f2->field(); 
		echo "</td>";  
    		
     ?>   
     <td class="center"><?php echo $fprog ?></td>
     <td><?php echo $fcod ?></td>
     <td><?php echo htmlspecialchars($fdes, ENT_QUOTES) ?></td>
     <td><?php echo $ftipo ?></td>
	 <td><?php echo $ftmp ?></td>
            
<?php
     echo "</tr>";
     }
     echo "</tbody>";
     echo "</table>";
     echo "</form>";
     echo "</div>";
?>