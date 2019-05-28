<?php   session_start();
/*** -------------------------------------------------------------------------
   * Gestione della tabella 'aim' articolo con immagine
=============================================================================  */
require_once('loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once('lingua.php');
require_once('connectDB.php');

//   bottoni gestione
$param    = array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi');
$btx      = new bottoni_str_par($AIM,'aim','upd_aim.php',$param);     
          $btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
include_once 'msg.php';

// mostra la tabella filtrata --------------------------------------------------
echo "<div class='tableFixHead'>";
echo "<table class='table table-striped table-bordered table-condensed'>"; 
echo "<thead>"; 
echo "<th style='width:2%;'>$SCEL</th>";
echo "<th style='width:2%;'>$ST</th>";
echo "<th style='width:2%;'>$PROG</th>"; 
echo "<th>Tmp.</th>";
echo "<th>Codice</th>"; 
echo "<th>Descrizione</th>";
echo "<th>Articolo</th>";
echo "</thead>";
      
    $sql = "  SELECT * 
               FROM `".DB::$pref."aim` 
               ORDER BY iprog";

     foreach($PDO->query($sql) as $row)            
  {  include('fields_aim.php');
     echo "<tr>";
     echo "<td class='center'>";
     $f1 = new fieldi($iid,'iid',5,'');            
     $f1->field_ck(); echo "</td>";
     echo "<td class='center'>";  
     $st = new fieldi($istat,'istat',2,'');        
     $st->field_st(); echo "</td>";
    
  ?>
  <td><?php echo $iprog ?></td>
  <td><?php echo $itmp  ?></td>  
  <td><?php echo $icod  ?></td>
  <td><?php echo $ides  ?></td>
  <td><?php echo $iart  ?></td>
  <?php
     echo "</tr>";
     }
     echo "</tbody>";
     echo "</table>";
     echo "</form>";
     echo "</div>";
?> 