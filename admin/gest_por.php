<?php  session_start();
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
echo "<div class='table fb-hv80'>"; 

echo "<div class='th'>"; 
echo "<div class='td'>$SCEL</div>";
echo "<div class='td'>$ST</div>";
echo "<div class='td'>$PROG</div>"; 
echo "<div class='td'>$TEMP</div>";
echo "<div class='td'>$COD</div>";
echo "<div class='td'>$DESC</div>"; 
echo "</div>";
       
    $sql2 = "  SELECT * 
               FROM `".DB::$pref."por` 
               ORDER BY pprog";
// transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 
              
            foreach($PDO->query($sql2) as $row)             
  {  require('fields_por.php');
  
     echo "<div class='tr'>";
  $f1 = new fieldi($pid,'pid',2,'');            
  echo "<div class='td'>"; $f1->field_ck(); echo "</div>";
  $st = new fieldi($pstat,'pstat',2,'');        
  echo "<div class='td'>"; $st->field_st(); echo "</div>";
  ?>
  <div class='td'><?php echo $pprog ?></div>
  <div class='td'><?php echo $ptmp ?></div>  
  <div class='td'><?php echo $pcod ?></div>
  <div class='td'><?php echo $pdes ?></div>
  <?php
     echo "</div>";
     }

     echo "</form>";
     echo "</div>";
?> 