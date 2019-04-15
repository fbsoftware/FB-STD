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
if (!function_exists('getBootHead')) 
{
require_once('loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once('lingua.php');
$head = new getBootHead('gestione iscritti');
     $head->getBootHead(); 
echo  "<link rel='stylesheet' type='text/css' href='css/style.css'>";
echo "</head>"; 
}  
 
//print_r($_POST);//debug
$azione = $_POST['submit'];
$table  = $_POST['table'];
   
      //   bottoni gestione
     $param  = array( 'Struttura della tabella : <strong>'.$table.'</strong>','config','index.php?urla=widget.php&pag=','ritorno');  
     $btx    = new bt_param($param);     $btx->show_bottoni($param);

switch ($azione) 
     {
            case 'chiudi':
            $loc = "location:index.php?urla=widget.php&pag=";
                 header($loc);                          
            break;
            case 'ritorno':
             $loc = "location:admin.php?".$_SESSION['location']."";
                  header($loc);
            break;
            
     default:
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
    $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction();  


if (isset($table))
     {
 //    echo '<h3>Tabella : '.$table.'</h3>';
$sql = "SHOW FULL COLUMNS FROM ".$table;

          echo '<table cellpadding="0" cellspacing="0">';
          echo '<tr><th>Campo</th><th>Tipo</th><th>Key</th><th>Default<th>Extra</th><th>Descrizione</th></tr>';
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
          
          break;

     }
}
?>