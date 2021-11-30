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
echo "<div class='table fb-hv80'>"; 

echo "<div class='th'>"; 
echo "<div class='td'>$SCEL</div>";
echo "<div class='td'>$ST</div>";
echo "<div class='td'>$PROG</div>"; 
echo "<div class='td'>$COD</div>";
echo "<div class='td'>$DESC</div>";
echo "<div class='td'>$TEMP</div>";
echo "</div>";       
    $sql2 = "  SELECT * 
               FROM `".DB::$pref."sld` 
               ORDER BY slprog";
            foreach($PDO->query($sql2) as $row)             
  {  require('fields_sld.php');
     echo "<div class='tr'>";
  $f1 = new fieldi($slid,'slid',2,'');            
  echo "<div class='td'>"; 
  	$f1->field_ck(); echo "</div>";
  $st = new fieldi($slstat,'slstat',2,'');        
  echo "<div class='td'>"; 
  	$st->field_st(); echo "</div>";
  ?>
  <div class='td'><?php echo $slprog ?></div>
  <div class='td'><?php echo $slcod ?></div>
  <div class='td'><?php echo $slde ?></div>
  <div class='td'><?php echo $sltmp ?></div>
  <?php
     echo "</div>";
     }

     echo "</form>";
     echo "</div>";
?> 