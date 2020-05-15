<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'arc' articoli in colonna
============================================================================= */ 
//   bottoni gestione
	$btx = new bottoni_str_par('articoli in colonna','arc','upd_arc.php',array('nuovo','modifica','cancella','chiudi'));     
     	$btx->btn();

// memorizza location iniziale
     $_SESSION['location'] = $_SERVER['QUERY_STRING'];
     
// zona messaggi
include_once 'msg.php';

//  mostra tabella
echo "<div class='tableFixHead'>";
echo "<table class='table table-striped table-bordered table-condensed'>"; 
echo "<thead>"; 
echo "<th style='width:2%;'>$SCEL</th>";
echo "<th style='width:2%;'>$ST</th>";
echo "<th style='width:2%;'>$PROG</th>"; 
echo "<th>$TEMP</th>";
echo "<th>$COD</th>";
echo "<th>$DESC</th>"; 
echo "</thead>";

// lettura database
     $sql =   "SELECT * 
               FROM ".DB::$pref."arc 
               ORDER BY hprog";

          foreach($PDO->query($sql) as $row)      
          {   
     include('fields_arc.php');      
     echo "<tr>";  
     $f1 = new fieldi($hid,'hid',2,'');               
     echo "<td class='center'>"; 
		$f1->field_ck(); echo "</td>";   
     $st = new fieldi($hstat,'hstat',2,'');           
     echo "<td class='center'>"; 
		$st->field_st(); echo "</td>";   
     ?>   
     <td class="center"><?php echo $hprog ?></td>
     <td><?php echo $htmp ?></td>
     <td><?php echo $hcod ?></td>
     <td><?php echo htmlspecialchars($hdes, ENT_QUOTES) ?></td>
            
<?php
     echo "</tr>";
     }
     echo "</tbody>";
     echo "</table>";
     echo "</form>";
     echo "</div>";
?>