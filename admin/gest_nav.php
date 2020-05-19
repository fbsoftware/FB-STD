<?php   session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.0   
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
=============================================================================  
   * Gestione della tabella 'nav' voci di menu e sottovoci.
   * Aggiunto "nhead" per gestire header per ogni voce menu (Max.9).
   * 1.0.0	nuovo head breve
=============================================================================  */
require_once('../loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once('../lingua.php');

  //   toolbar
	$param  = array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi');    
	$btx    = new bottoni_str_par($VOCI_MENU,'nav','upd_nav.php',$param);  
		$btx->btn();
      
// memorizza location iniziale
	$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
require_once 'msg.php';
  
     // mostra la tabella filtrata --------------------------------------------------
echo "<section id='table'>"; 
echo "<div class='tableFixHead'>";    
echo "<table class='table table-hover table-striped table-bordered table-condensed'>"; 
echo "<thead>";
echo "<tr>";
echo "<th style='width:2%;'>$SCEL</th>";
echo "<th style='width:2%;'>$ST</th>";
echo "<th style='width:2%;'>$PROG</th>";  
echo "<th>$MENU</th>";
echo "<th>$VOCE</th>";
echo "<th>$SVOCE</th>";
echo "<th>$DES</th>";
echo "<th>$TIPO</th>";             
echo "<th>$CONT</th>";
echo "<th>$SEL</th>";
echo "<th>$ACC</th>";
echo "<th>$PARAM</th>";
echo "</tr>";
echo "</thead>";          

     $sql = "  SELECT * 
               FROM `".DB::$pref."nav` 
               ORDER BY nprog";
            foreach($PDO->query($sql) as $row)             
  {  require('fields_nav.php');


     echo "<tr>";
	$f1 = new fieldi($nid,'nid',2,'');            
	echo "<td class='center'>"; $f1->field_ck(); echo "</td>";
	$st = new fieldi($nstat,'nstat',2,'');        
	echo "<td class='center'>"; $st->field_st(); echo "</td>";
       ?>
     <td class="center"><?php echo $nprog ?></td> 
     <td><?php echo $nmenu ?></td>
     <td><?php echo $nli ?></td>
     <td><?php echo $ndesc ?></td>
     <td><?php echo $ntesto ?></td>
     <td><?php echo $ntipo ?></td>
     <td><?php echo $nsotvo ?></td>
     <td><?php echo $nselect ?></td>
     <td><?php echo $naccesso ?></td>  
	 <td><?php echo $npag ?></td> 
	 
<?php 
	echo "</tr>";
  }
     echo "</table>"; 
	echo "</div>";
	echo "</section>";
	echo "</form>";
?> 