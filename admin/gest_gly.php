<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'gly' icone.      
============================================================================= */ 

//   bottoni gestione
	$btx = new bottoni_str_par('Icone','gly','upd_gly.php',array('nuovo','modifica','cancella','chiudi'));     
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
echo "<th>$TEMP</th>";
echo "</thead>";
echo "<tbody>";
// lettura database
     $sql =   "SELECT * 
               FROM ".DB::$pref."gly 
               WHERE gstat <> 'A'    
               ORDER BY gprog";

          foreach($PDO->query($sql) as $row)      
          {   
     require('fields_gly.php');      
     echo "<tr>";  
     $f1 = new fieldi($gid,'gid',2,'');               
     echo "<td class='center'>"; 
		$f1->field_ck(); echo "</td>";   
     $st = new fieldi($gstat,'gstat',2,'');           
     echo "<td class='center'>"; 
		$st->field_st(); echo "</td>";   
     ?>   
     <td class="center"><?php echo $gprog ?></td>
     <td><?php echo $gcod ?></td>
     <td><?php echo htmlspecialchars($gdes, ENT_QUOTES) ?></td>
     <td><?php echo $gtmp ?></td>       
<?php
     echo "</tr>";
     }
     echo "</tbody>";
     echo "</table>";
     echo "</form>";
     echo "</div>";
?>