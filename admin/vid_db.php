<?php   session_start();
/*** Fausto Bresciani   fbsoftware.bresciani@gmail.com  www.faustobresciani.it
   * package		Gestione Associazione
   * versione 1.3
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
=============================================================================
   *  visualizza struttura tabella database
=============================================================================  */
require_once('init_admin.php');
//print_r($_POST);//debug
$azione = $_POST['submit'];
$table  = $_POST['table'];
echo "<body class='admin' data-theme='".TMP::$tcolor."'>";

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

echo "<div class='table fb-hv80'>";
echo "<div class='th'>";
echo "<div class='td'>Campo</div>";
echo "<div class='td'>Tipo</div>";
echo "<div class='td'>Null</div>";
echo "<div class='td'>Default</div>";
echo "<div class='td'>Extra</div>";
echo "<div class='td'>Descrizione</div>";
echo "</div>";
     //     while($row2 = mysql_fetch_row($result2))
			foreach($PDO->query($sql) as $row)

               {
               echo "<div class='tr'>";
               echo "<div class='td'>".$row[0]."</div>";  // nome campo
               echo "<div class='td'>".$row[1]."</div>";  // tipo campo
               echo "<div class='td'>".$row[3]."</div>";
               echo "<div class='td'>".$row[4]."</div>";  // key si-no
               echo "<div class='td'>".$row[6]."</div>";  // extra
               echo "<div class='td'>".$row[8]."</div>";  // descrizione
               echo "</div>";
               }

			echo '</div>';
          break;

     }
}
echo "</body>";
?>
