<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'lay' layout di pagina.   
============================================================================= */ 
require_once('connectDB.php');

// toolbar
	$param  = array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi');
	$btx = new bottoni_str_par($LAY,'lay','upd_lay.php',$param);     
		$btx->btn();

     // memorizza location iniziale
     $_SESSION['location'] = $_SERVER['QUERY_STRING'];
     
// zona messaggi
require_once 'msg.php';

//  mostra tabella
echo "<div class='tableFixHead'>";
echo "<table class='table table-striped table-bordered table-condensed'>"; 
echo "<thead>";
echo "<tr>";  
echo "<th style='width:2%;'>$SCEL</th>";
echo "<th style='width:2%;'>$ST</th>";
echo "<th style='width:2%;'>$PROG</th>"; 
echo "<th>$COD</th>";
echo "<th>$DESC</th>"; 
echo "<th>$TIPO</th>";
echo "<th>$TEMP</th>";
echo "<th>$INCL</th>";
echo "</tr>"; 
echo "</thead>";

echo "<tbody>"; 
// lettura database
     $sql =   "SELECT * 
               FROM ".DB::$pref."lay 
               ORDER BY lprog";

          foreach($PDO->query($sql) as $row)      
          {   
     include('fields_lay.php');      
     echo "<tr>";  
     echo "<td class='center'>"; 
     $f1 = new input(array($lid,'lid',2,'','','ck'));
          $f1->field(); echo "</td>";        
     $st = new fieldi($lstat,'lstat',2,'');           
     echo "<td class='center'>"; $st->field_st(); echo "</td>";   ?>   
          <td class='center'><?php echo $lprog ?></td>
          <td><?php echo $lcod ?></td>  
          <td><?php echo htmlspecialchars($ldesc, ENT_QUOTES) ?></td>
          <td><?php echo $ltipo ?></td> 
          <td><?php echo $ltmp ?></td>
          <td><?php echo $linclude ?></td>  
            
<?php
     echo "</tr>";
     }
     echo "</tbody>"; 
     echo "</table></form></div>";
     echo "</div>";     // col
?>