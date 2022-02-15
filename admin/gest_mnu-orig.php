<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 2.0.1    
   * copyright	Copyright (C) 2022 - 2023 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= */ 

// toolbar
	$param  = array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi');    
	$btx    = new bottoni_str_par(Menù,'mnu','upd_mnu.php',$param);  
		$btx->btn();
		
// memorizza location iniziale
	$_SESSION['location'] = $_SERVER['QUERY_STRING'];
	
// zona messaggi
$parm = $_SESSION['esito'];
$m = new msg($parm);
$m->msg();
 
//   testata
echo "<section id='table'>";
echo "<div class='tableFixHead'>";    
echo "<table>"; 
echo "<thead>"; 
echo "<th style='width:2%;'>Scelta</th>";
echo "<th style='width:2%;'>Stato</th>";
echo "<th style='width:2%;'>Progr.</th>"; 
echo "<th>Nome</th>";
echo "<th>Tipo</th>";
echo "<th>Descrizione</th>";
echo "<th>Selezionato</th>";
echo "</thead>";   
echo "<tbody>";

$sql = "SELECT * FROM ".DB::$pref."mnu 
		ORDER BY bprog";
	foreach($PDO->query($sql) as $row)
      {       
		require('fields_mnu.php');
		echo "<tr>";
		$f2 = new input(array($bid,'bid',2,'',$TT_SCEL,'ck'));     
		echo "<td>"; $f2->field(); echo "</td>";
		Stato = new fieldi($bstat,'bstat',2,'');        
		echo "<td>"; Stato->field_st(); echo "</td>";
  ?>
		<td><?php echo $bprog ?></td>
		<td><?php echo $bmenu ?></td>
		<td><?php echo $btipo ?></td>
		<td><?php echo $btesto ?></td>
		<td><?php echo $bselect ?></td>
<?php
     echo "</tr>";               
          }
		  echo "</tbody>";
     echo "</table>"; 
	echo "</div>";
	echo "</section>";
	echo "</form>";
?> 
