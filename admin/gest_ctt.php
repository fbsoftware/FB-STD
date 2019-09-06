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
include_once 'msg.php';

//  mostra tabella
echo "<div class='tableFixHead'>";
echo "<table class='table table-striped table-bordered table-condensed'>"; 
echo "<thead>"; 
echo "<th style='width:2%;'>$SCEL</th>";
echo "<th style='width:2%;'>$ST</th>";
echo "<th style='width:2%;'>$PROG</th>"; 
echo "<th>$COD</th>";
echo "<th>$DESC</th>"; 
echo "<th>$TEMP</th>";
echo "</thead>";

// lettura database
     $sql =   "SELECT * 
               FROM ".DB::$pref."ctt 
               WHERE estat <> 'A'    
               ORDER BY eprog";

          foreach($PDO->query($sql) as $row)      
          {   
     include('fields_ctt.php');      
     echo "<tr>";  
     $f1 = new fieldi($eid,'eid',2,'');               
     echo "<td class='center'>"; 
		$f1->field_ck(); echo "</td>";   
     $st = new fieldi($estat,'estat',2,'');           
     echo "<td class='center'>"; 
		$st->field_st(); echo "</td>"; 
		
     ?>   
     <td class="center"><?php echo $eprog ?></td>
     <td><?php echo $ecod ?></td>
     <td><?php echo $edes ?></td>
     <td><?php echo $etmp ?></td>
            
<?php
     echo "</tr>";
     }
     echo "</tbody>";
     echo "</table>";
     echo "</form>";
     echo "</div>";
?>