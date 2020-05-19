<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'arg' argomenti. 
   * 22/12/2013 incasellamento in tabella        
============================================================================= */ 

//   toolbar
     $btx = new bottoni_str_par($ARGS,'arg','upd_arg.php',array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi'));     
          $btx->btn();
              
// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
require_once 'msg.php';

//  mostra tabella
echo "<div class='tableFixHead'>";    
echo "<table class='table table-striped table-bordered table-condensed'>"; 
echo "<thead>"; 
echo "<th style='width:2%;'>$SCEL</th>";
echo "<th style='width:2%;'>$ST</th>";
echo "<th style='width:2%;'>$PROG</th>"; 
echo "<th>$COD</th>";
echo "<th>$DESC</th>";
echo "<th>$S_N_TIT</th>";
echo "</thead>";

echo "<tbody>";
 // lettura database
     $sql = "   SELECT * 
     FROM ".DB::$pref."arg
     ORDER BY rprog";
          foreach($PDO->query($sql) as $row)
  { require('fields_arg.php');
     echo "<tr>";
     echo "<td class='center'>";
     $f1= new fieldi($rid,'rid',2,'');
          $f1->field_ck();     
     echo "</td>";
     echo "<td class='center'>";                       
     $f2 = new fieldi($rstat,'rstat',2,'');
          $f2->field_st();
     echo "</td>";
     echo "<td class='center'>$rprog</td>";
     echo "<td>".htmlspecialchars($rcod, ENT_QUOTES)."</td>";
     echo "<td>".htmlspecialchars($rdesc, ENT_QUOTES)."</td>";
     echo "<td>$rmostra</td>" ;
     echo "</tr>";

} 
          echo "</table>";
          echo "</form>";
          echo "</div>";     // col
?>