﻿<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.02    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= */  
require_once('connectDB.php'); 
 
 //   bottoni gestione
$param = array('nuovo','modifica','cancella','chiudi');
$btx   = new bottoni_str_par('Utenti','ute','upd_ute.php',$param);     
     $btx->btn();
     
// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
	include_once('msg.php');

//   testate
echo "<div class='tableFixHead'>";    
echo "<table class='table table-striped table-bordered table-condensed'>"; 
echo "<thead>"; 
echo "<th>Scelta</th>";
echo "<th>Stato</th>"; 
echo "<th>Progressivo</th>";
echo "<th>Utente</th>";
echo "<th>Livello accesso</th>";
echo "<th>Numero utente</th>";
 
// transazione
     $sql = "SELECT * FROM `".DB::$pref."ute`
          ORDER BY username";
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction(); 
     foreach($PDO->query($sql) as $row)
     {
     include('fields_ute.php');                 
     echo "<tr>";
                $f1 = new fieldi($uid,'uid',2,'');           
     echo "<td>"; $f1->field_ck(); echo "</td>";
           $f2 = new fieldi($ustat,'ustat',2,'');       
     echo "<td>"; $f2->field_st(); echo "</td>";
?>
     <td><?php echo $uprog ?></td>
     <td><?php echo $username ?></td>
     <td><?php echo $uaccesso ?></td>
     <td><?php echo $uiscritto ?></td> 
<?php              
     echo "<tr>";
     }
     echo "</table></div></form>";     
?>
