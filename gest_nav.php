<?php   session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.0   
   * copyright	Copyright (C) 2012 - 2013 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
=============================================================================  
   * Gestione della tabella 'nav' voci di menu e sottovoci.
   * Aggiunto "nhead" per gestire header per ogni voce menu (Max.9).
=============================================================================  */
require_once('loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once('lingua.php');
require_once('connectDB.php');
$tipo         = $_SESSION['pag']; 

  //   toolbar
	$param  = array('nuovo','modifica','cancella','chiudi');    
	$btx    = new bottoni_str_par('Voci di menu','nav','upd_nav.php',$param);  
		$btx->btn();
      
// memorizza location iniziale
	$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
	include_once('msg.php');
  
     // mostra la tabella filtrata --------------------------------------------------
echo "<div class='container fb-table-scroll'>";     
echo "<table class='table table-hover table-striped table-bordered table-condensed'>"; 
echo "<thead class='well'>"; 
echo "<th>Scelta</th>";
echo "<th>Stato</th>"; 
echo "<th>Prog</th>"; 
echo "<th>Menu</th>";
echo "<th>VOCE</th>";
echo "<th>Sottovoce</th>";
echo "<th>Descrizione</th>";
echo "<th>TIPO</th>";             
echo "<th>Contenuto</th>";
echo "<th>SEL</th>";
echo "<th>ACC</th>";
echo "</thead>";          

     $sql = "  SELECT * 
               FROM `".DB::$pref."nav` 
               WHERE nmenu='".TMP::$tmenu."' 
               ORDER BY nprog";
            foreach($PDO->query($sql) as $row)             
  {  include('fields_nav.php');
     echo "<tr>";
  $f1 = new fieldi($nid,'nid',2);            
  echo "<td>"; $f1->field_ck(); echo "</td>";
  $st = new fieldi($nstat,'nstat',2);        
  echo "<td>"; $st->field_st(); echo "</td>";
       ?>
     <td><?php echo $nprog ?></td> 
     <td><?php echo $nmenu ?></td>
     <td><?php echo $nli ?></td>
     <td><?php echo $ndesc ?></td>
     <td><?php echo $ntesto ?></td>
     <td><?php echo $ntipo ?></td>
     <td><?php echo $nsotvo ?></td>
     <td><?php echo $nselect ?></td>
     <td><?php echo $naccesso ?></td>   
<?php 
  }
     echo "</tr>";
     echo "</table></form></div>";
     echo "</div></div>";

?> 