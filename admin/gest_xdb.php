<?php    session_start();       ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'xdb' sipologie codificate. 
   * 28/5/2019	aggiunta copia
============================================================================= */ 

 //   toolbar
$param = array($NEW."|nuovo",$MOD."|modifica",$COPY."|copia",$DEL."|cancella",$CLO."|chiudi");
$btx   = new bottoni_str_par($TIP,'xdb','upd_xdb.php',$param);     
     $btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
require_once 'msg.php';
   
//echo "<div class='row'>";  
echo "<div class='tableFixHead'>";    
echo "<table class='table table-striped table-bordered table-condensed'>"; 
echo "<thead>";
echo "<tr>";                
echo "<th style='width:2%;'>Scelta</th>";
echo "<th style='width:2%;'>Stato</th>";
echo "<th style='width:2%;'>Progressivo</th>"; 
echo "<th>Tipo</th>"; 
echo "<th>Codice</th>"; 
echo "<th>Descrizione</th>";
echo "</tr>";
echo "</thead>";       
echo "<tbody>";
 // lettura database
     $sql = "SELECT * 
               FROM ".DB::$pref."xdb     
               ORDER BY xtipo,xdes";
// transazione    
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction(); 
      foreach($PDO->query($sql) as $row)
          {   
          require('fields_xdb.php');
          echo "<tr>";
          echo "<td class='center'>";       
          $f0 = new fieldi($xid,'xid',2,'');           
               $f0->field_ck();  
          echo "</td>";
          echo "<td class='center'>";  
          $f1 = new fieldi($xstat,'xstat',2,'');       
               $f1->field_st();
          echo "</td>";
                    ?>
          <td class="center"><?php echo $xprog ?></td> 
          <td><?php echo $xtipo ?></td> 
          <td><?php echo $xcod ?></td> 
          <td><?php echo $xdes ?></td>      
          <?php
          echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
          echo "</form>";
          echo "</div>";
//         echo "</div>";
?> 
