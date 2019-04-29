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
require_once('connectDB.php');

//   toolbar
     $btx = new bottoni_str_par($ARGS,'arg','upd_arg.php',array('nuovo','modifica','cancella','chiudi'));     
          $btx->btn();
              
// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
$M = new msg($_SESSION['esito']); $M->msg();

//  mostra tabella
echo "<div class='tableFixHead'>";    
echo "<table class='table table-striped table-bordered table-condensed'>"; 
echo "<thead>"; 
echo "<th>Scelta</th>";
echo "<th>Stato</th>"; 
echo "<th>Progressivo</th>";
echo "<th>Codice</th>";
echo "<th>Descrizione</th>";
echo "<th>Si/No titolo</th>";
echo "</thead>";

echo "<tbody>";
 // lettura database
     $sql = "   SELECT * 
     FROM ".DB::$pref."arg
     ORDER BY rprog";
          foreach($PDO->query($sql) as $row)
  { include('fields_arg.php');
     echo "<tr>";
     echo "<td class='center fc'>";
     $f1= new fieldi($rid,'rid',2,'');
          $f1->field_ck();     
     echo "</td>";
     echo "<td class='center'>";                       
     $f2 = new fieldi($rstat,'rstat',2,'');
          $f2->field_st();
     echo "</td>";
     echo "<td>$rprog</td>";
     echo "<td>".htmlspecialchars($rcod, ENT_QUOTES)."</td>";
     echo "<td>".htmlspecialchars($rdesc, ENT_QUOTES)."</td>";
     echo "<td>$rmostra</td>" ;
     echo "</tr>";

} 
          echo "</table>";
          echo "</form>";
          echo "</div>";     // col
?>