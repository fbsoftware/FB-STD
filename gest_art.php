<?php session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 2.0    
   * copyright	Copyright (C) 2011 - 2012 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ==========================================================================
   * Gestione articoli 
   * ======================================================================= */
require_once('loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once('lingua.php');
require_once('connectDB.php');

   //   bottoni gestione
$param = array('nuovo','modifica','cancella','chiudi');
$btx   = new bottoni_str_par('Articoli','art','upd_art.php',$param);     
     $btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];     

// zona messaggi
include_once 'msg.php';

//  mostra tabella 
echo "<div class='container fb-table-scroll'>";     
echo "<table class='table table-hover table-striped table-bordered table-condensed'>"; 
echo "<thead class='well'>"; 
echo "<th>Scelta</th>";
echo "<th>Stato</th>"; 
echo "<th>Prog</th>";
echo "<th>Titolo</th>"; 
echo "<th>Argomento</th>"; 
echo "<th>Capitolo</th>";
echo "<th>Tit.</th>"; 
echo "</thead>";
       
$sql =    "SELECT * FROM `".DB::$pref."art` 
                       ORDER BY `aprog` ";
// transazione    
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction(); 
     foreach($PDO->query($sql) as $row)
          { 
           include('fields_art.php'); 
          echo "<tr>";                  
           $f1 = new fieldi($aid,'aid',2);           
  echo "<td>"; $f1->field_ck(); echo "</td>";
           $f2 = new fieldi($astat,'astat',2);       
  echo "<td>"; $f2->field_st(); echo "</td>";
  ?>
<td><?php echo $aprog ?></td>
<td><?php echo $atit ?></td>
<td><?php echo $aarg ?></td>
<td><?php echo $acap ?></td>
<td><?php echo $amostra ?></td> 
<?php              
     echo "<tr>";               
          }
     echo "</table></div></form>";
//     echo "</div></div>"; 
?>
