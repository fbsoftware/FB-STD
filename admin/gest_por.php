<?php   session_start();
/*** -------------------------------------------------------------------------
   * Gestione della tabella 'por' portafoglio.
=============================================================================  */

//   bottoni gestione
$param    = array('nuovo','modifica','cancella','chiudi');
$btx      = new bottoni_str_par($POR,'por','upd_por.php',$param);     
$btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
require_once 'msg.php';

// mostra la tabella filtrata --------------------------------------------------
echo "<div class='tableFixHead'>";
echo "<table class='table table-striped table-bordered table-condensed'>"; 
echo "<thead>"; 
echo "<th>Scel</th>";
echo "<th>Stato</th>"; 
echo "<th>Prg</th>"; 
echo "<th>- Ampiezza colonna -</th>";
echo "<th>Tmp.</th>";
echo "<th>- Codice</th>"; 
echo "<th>---- Descrizione --- --- ---</th>";
echo "</thead>";

echo "<tbody>";         
    $sql2 = "  SELECT * 
               FROM `".DB::$pref."por` 
               ORDER BY pprog";
// transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 
              
            foreach($PDO->query($sql2) as $row)             
  {  require('fields_por.php');
     echo "<tr>";
  $f1 = new fieldi($pid,'pid',2,'');            
  echo "<td class='center'>"; $f1->field_ck(); echo "</td>";
  $st = new fieldi($pstat,'pstat',2,'');        
  echo "<td class='center'>"; $st->field_st(); echo "</td>";
  ?>
  <td><?php echo $pprog ?></td>
  <td><?php echo $pcol ?></td>
  <td><?php echo $ptmp ?></td>  
  <td><?php echo $pcod ?></td>
  <td><?php echo $pdes ?></td>
  <?php
     echo "</tr>";
     }
     echo "</tbody>";
     echo "</table>";
     echo "</form>";
     echo "</div>";
?> 