<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.0    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= */ 
require_once("connectDB.php");

// toolbar
	$param  = array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi');    
	$btx    = new bottoni_str_par($MENU,'mnu','upd_mnu.php',$param);  
		$btx->btn();
		
// memorizza location iniziale
	$_SESSION['location'] = $_SERVER['QUERY_STRING'];
	
// zona messaggi
require_once 'msg.php';
 
//   testata
echo "<div class='tableFixHead'>";    
echo "<table class='table table-hover table-striped table-bordered table-condensed'>"; 
echo "<thead>"; 
echo "<th style='width:2%;'>$SCEL</th>";
echo "<th style='width:2%;'>$ST</th>";
echo "<th style='width:2%;'>$PROG</th>"; 
echo "<th>$NAME</th>";
echo "<th>$TIPO</th>";
echo "<th>$DESC</th>";
echo "<th>$SEL</th>";
echo "</thead>";   

$sql = "SELECT * FROM ".DB::$pref."mnu 
		ORDER BY bprog";
	foreach($PDO->query($sql) as $row)
      {       
      include('fields_mnu.php');
     echo "<tr>";
$f2 = new input(array($bid,'bid',2,'',$TT_SCEL,'ck'));     
  echo "<td class='center'>"; $f2->field(); echo "</td>";
  $st = new fieldi($bstat,'bstat',2,'');        
  echo "<td class='center'>"; $st->field_st(); echo "</td>";
  ?>
	<td class="center"><?php echo $bprog ?></td>
	<td><?php echo $bmenu ?></td>
	<td><?php echo $btipo ?></td>
	<td><?php echo $btesto ?></td>
	<td><?php echo $bselect ?></td>
	</tr>
<?php
     }
	echo "</table>";
	echo "</form>";
	echo "</fieldset>";
	echo "</div>";
?> 
