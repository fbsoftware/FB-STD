<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.02    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= */

//   bottoni gestione
	$param = array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi');
	$btx   = new bottoni_str_par($UTES,'ute','upd_ute.php',$param);     
		$btx->btn();
     
// memorizza location iniziale
	$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
require_once 'msg.php';

//   testate
echo "<section id='table'>"; 
echo "<div class='tableFixHead'>";    
echo "<table class='table table-hover table-striped table-bordered table-condensed'>"; 
echo "<thead>"; 
echo "<th style='width:2%; text-align:center;'>Scelta</th>";
echo "<th style='width:2%; text-align:center;'>Stato</th>";
echo "<th style='width:2%; text-align:center;'>Progressivo</th>"; 
echo "<th>Utente</th>";
echo "<th>Livello accesso</th>";
echo "</thead>"; 
echo "<tbody>"; 
// transazione
     $sql = "SELECT * FROM `".DB::$pref."ute`
          ORDER BY username";
     foreach($PDO->query($sql) as $row)
     {
     require('fields_ute.php');                 
     echo "<tr>";
		$f1 = new fieldi($uid,'uid',2,'');           
     echo "<td class='center'>"; $f1->field_ck(); echo "</td>";
		$f2 = new fieldi($ustat,'ustat',2,'');       
     echo "<td class='center'>"; $f2->field_st(); echo "</td>";
?>
     <td class='center'><?php echo $uprog ?></td>
     <td><?php echo $username ?></td>
     <td><?php echo $uaccesso ?></td>
<?php              
     echo "</tr>";
     }
	 echo "</tbody>";
     echo "</table>"; 
	echo "</div>";
	echo "</section>";
	echo "</form>";
?>
