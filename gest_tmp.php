<?php  
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * -------------------------------------------------------------------------
   * Gestione dei templates      
============================================================================= */
require_once('connectDB.php');  
     
//   bottoni gestione
$btx = new bottoni_str_par($TEMPLATES,'tmp','upd_tmp.php',array('nuovo','modifica','cancella','chiudi'));     
     $btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];
     
// zona messaggi
include_once 'msg.php'; 

//  testata di tabella 
echo "<div class='tableFixHead'>";    
     
echo "<table class='table table-striped table-bordered table-condensed'>"; 
echo "<thead>"; 
echo "<tr>";
echo "<th>Sce</th>";
echo "<th>Stato</th>"; 
echo "<th>Prg</th>";
echo "<th>Selezionato</th>";
echo "<th>Codice</th>";
echo "<th>Tipo</th>";
echo "<th>Percorso template</th>";
echo "<th>Descrizione del template</th>";
echo "<th>Menù</th>";
echo "</tr>";
echo "</thead>";

echo "<tbody>";
// mostra la tabella  --------------------------------------------------
     $sql = "  SELECT * 
               FROM `".DB::$pref."tmp` 
               ORDER BY `tprog` ";
          foreach($PDO->query($sql) as $row)      
          {
           include('fields_tmp.php');
     echo "<tr>";
	echo "<td class='center fc'>"; 
	$f0 = new fieldi($tid,'tid',2);            
     	$f0->field_ck(); 
	echo "</td>";
	echo "<td class='center'>"; 
	$f2 = new fieldi($tstat,'tstat',2);        
     	$f2->field_st(); 
	echo "</td>";
?>
	<td><?php echo $tprog ?></td>
<?php 
	echo "<td class='center'>"; 
	$f2 = new input(array($tsel,'tsel',1,'','tooltip','star'));     
     $f2->field();     	
	echo "</td>"; 
?>
	<td><?php echo $tcod ?></td>
	<td><?php echo $ttipo ?></td>
	<td><?php echo $tfolder ?></td>
	<td><?php echo $tdesc ?></td>
	<td><?php echo $tmenu ?></td>
<?php
     echo "</tr>";
          }
     echo "</tbody>";
     echo "</table>";
     echo "</form>";
     echo "</div>";     
?> 