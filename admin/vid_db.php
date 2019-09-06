<?php   session_start();
/*** Fausto Bresciani   fbsoftware.bresciani@gmail.com  www.fbsoftware.altervista.org
   * package		Gestione Associazione
   * versione 1.3
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
=============================================================================
   *  visualizza struttura tabella database
=============================================================================  */
require_once('../loadLibraries.php');
require_once('loadTemplateAdmin.php');
$app = new Head('Gestione menu');
$app->openHead();
require_once("../jquery_link.php");
require_once("../bootstrap_link.php");
require_once("../include_head.php");
require_once('../lingua.php'); 
$app->closeHead();
//----------------------------------------------
//print_r($_POST);//debug
$azione = $_POST['submit'];
$table  = $_POST['table'];

// toolbar
	$param  = array('ritorno');    
	$btx    = new bottoni_str_par('Struttura della tabella : <strong>'.$table.'</strong>','config','admin.php?'.$_SESSION['location'],$param);  
		$btx->btn();
switch ($azione) 
     {
		case 'chiudi':
            $loc = "location:admin.php?urla=widget.php&pag=";
                 header($loc);                          
            break;
		case 'ritorno':
			header('location:admin.php?'.$_SESSION['location'].'');
            break;
            
     default:
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
    $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction();  


if (isset($table))
     {
$sql = "SHOW FULL COLUMNS FROM ".$table;

echo "<div class='tableFixHead'>";    
          echo "<table class='table table-striped table-bordered table-condensed'>"; 
          echo '<tr>
				<th>Campo</th>
				<th>Tipo</th>
				<th>Null</th>
				<th>Default<th>
				Extra</th>
				<th>Descrizione</th>
				</tr>';
     //     while($row2 = mysql_fetch_row($result2))
			foreach($PDO->query($sql) as $row)
  
               {
               echo '<tr>';
               echo '<td class="fc">',$row[0],'</td>';
               echo '<td>',$row[1],'</td>';  // nome campo
               echo '<td>',$row[3],'</td>';  // tipo campo
               echo '<td>',$row[4],'</td>';  // key si-no
               echo '<td>',$row[6],'</td>';  // extra
               echo '<td>',$row[8],'</td>';  // descrizione
               echo '</tr>';               
               }

          echo '</table>';
echo '</div>';          
          break;

     }
}
?>