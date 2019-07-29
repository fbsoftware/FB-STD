<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'cap' capitoli. 
   * 2.0 aggiunto codice argomento del capitolo.        
============================================================================= */ 
require_once('connectDB.php');

//   bottoni gestione
$btx = new bottoni_str_par($CAP,'cap','upd_cap.php',array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi'));     
     $btx->btn();
     
// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
require_once 'msg.php';

//   mostra la tabella filtrata --------------------------------------------------
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
     $sql = "  SELECT * 
               FROM ".DB::$pref."cap
               ORDER BY cprog";
     foreach($PDO->query($sql) as $row)
     {
          include('fields_cap.php');   
          echo "<tr>";
          echo "<td class='center fc'>";
               $f1 = new fieldi($cid,'cid',2,'');          
                    $f1->field_ck(); echo "</td>";
          echo "<td class='center'>";
               $f2 = new fieldi($cstat,'cstat',2,'');      
                    $f2->field_st(); echo "</td>";
          echo "<td class='center'>".$cprog."</td>";
          echo "<td>".$ccod."</td>";
          echo "<td>".htmlspecialchars($cdesc, ENT_QUOTES)."</td>";
          echo "<td>".$cmostra."</td>";
          echo "</tr>";
     }
          echo "</table>";
          echo "</form>";
          echo "</div>";     // col
          echo "</div>";     // row
?> 