<?php   session_start();
/*** -------------------------------------------------------------------------
   * Gestione della tabella 'asl' articoli slide/tab
=========================================================e====================  */

//   bottoni gestione
$btx = new bottoni_str_par('Articoli slide/tab','asl','upd_asl.php',array('nuovo','modifica','cancella','chiudi'));     
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
echo "<th>$TIPO</th>";
echo "<th>$CAP</th>";
echo "<th>$ART</th>"; 
echo "</thead>";
echo "<tbody>";
// transazione    
   
    $sql2 = "  SELECT * 
               FROM `".DB::$pref."asl` 
               ORDER BY dprog ";
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 
     foreach($PDO->query($sql2) as $row)             
  	{ require('fields_asl.php');
     echo "<tr>";
  	$f1 = new fieldi($did,'did',5,'');            
  	echo "<td class='center'>"; $f1->field_ck(); echo "</td>";
  	$st = new fieldi($dstat,'dstat',2,'');        
  	echo "<td class='center'>"; $st->field_st(); echo "</td>";
?>
  <td><?php echo $dprog ?></td>
  <td><?php echo $dcod  ?></td>
  <td><?php echo $ddes  ?></td>  
  <td><?php echo $dtmp  ?></td> 
  <td><?php echo $dtipo ?></td> 
  <td><?php echo $dcap  ?></td>
  <td><?php echo $dart  ?></td>
  <?php
     echo "</tr>";
     }
     echo "</tbody>";
     echo "</table>";
     echo "</div>";
     echo "</form>";

?> 