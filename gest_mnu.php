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
echo "<th style='width:2%;'>Scelta</th>";
echo "<th style='width:2%;'>Stato</th>";
echo "<th style='width:2%;'>Progressivo</th>"; 
echo "<th>Nome</th>";
echo "<th>Tipo</th>";
echo "<th>Descrizione</th>";
echo "<th>Selezionato</th>";
echo "</thead>";   

$sql = "SELECT * FROM ".DB::$pref."mnu 
		ORDER BY bprog";
	foreach($PDO->query($sql) as $row)
      {       
      include('fields_mnu.php');
     echo "<tr>";
  $f1 = new fieldi($bid,'bid',2,'');            
  echo "<td class='center'>"; $f1->field_ck(); echo "</td>";
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
