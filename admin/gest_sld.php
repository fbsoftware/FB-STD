<?php   session_start();
/*** -------------------------------------------------------------------------
   * Gestione della tabella 'sld' slide.
=============================================================================  */

 //   bottoni gestione
$btx      = new bottoni_str_par($TAB_SLD,'sld','upd_sld.php',array('nuovo','modifica','cancella','chiudi'));     
$btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
require_once 'msg.php';

// mostra la tabella filtrata --------------------------------------------------
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
    $sql2 = "  SELECT * 
               FROM `".DB::$pref."sld` 
               ORDER BY slprog";
            foreach($PDO->query($sql2) as $row)             
  {  require('fields_sld.php');
     echo "<tr>";
  $f1 = new fieldi($slid,'slid',2,'');            
  echo "<td class='center'>"; 
  	$f1->field_ck(); echo "</td>";
  $st = new fieldi($slstat,'slstat',2,'');        
  echo "<td class='center'>"; 
  	$st->field_st(); echo "</td>";
  ?>
  <td class="center"><?php echo $slprog ?></td>
  <td><?php echo $slcod ?></td>
  <td><?php echo $slde ?></td>
  <td><?php echo $sltmp ?></td>
  <?php
     echo "</tr>";
     }
     echo "</tbody>";
     echo "</table>";
     echo "</form>";
     echo "</div>";
?> 