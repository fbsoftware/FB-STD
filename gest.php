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
   * gestione tabella 'tab'.      
============================================================================= */ 
require_once('connectDB.php');

//   bottoni gestione
	$btx = new bottoni_str_par('Titolo','tab','upd_tab.php',array('nuovo','modifica','cancella','chiudi'));     
     	$btx->btn();

// memorizza location iniziale
     $_SESSION['location'] = $_SERVER['QUERY_STRING'];
     
// zona messaggi
include_once 'msg.php';

//  mostra tabella
echo "<div class='tableFixHead'>";
echo "<table class='table table-striped table-bordered table-condensed'>"; 
echo "<thead>"; 
echo "<th>Scelta</th>";
echo "<th>Stato</th>"; 
echo "<th>Progressivo</th>";
echo "<th>colonna-1</th>";
echo "<th>Colonna-2</th>"; 
echo "<th>colonna-3</th>";
echo "</thead>";

// lettura database
     $sql =   "SELECT * 
               FROM ".DB::$pref."tab 
               WHERE £stat <> 'A'    
               ORDER BY xprog";

          foreach($PDO->query($sql) as $row)      
          {   
     include('fields_tab.php');      
     echo "<tr>";  
     $f1 = new fieldi($£id,'£id',2,'');               
     echo "<td class='mid'>"; 
		$f1->field_ck(); echo "</td>";   
     $st = new fieldi($£stat,'£stat',2,'');           
     echo "<td class='mid'>"; 
		$st->field_st(); echo "</td>"; 
		
     ?>   
     <td class="mid"><?php echo $£prog ?></td>
     <td><?php echo $gtmpcolonna_1 ?></td>
     <td><?php echo htmlspecialchars($gtmpcolonna_2, ENT_QUOTES) ?></td>
     <td><?php echo $gtmpcolonna_3 ?></td>
            
<?php
     echo "</tr>";
     }
     echo "</tbody>";
     echo "</table>";
     echo "</form>";
     echo "</div>";
?>