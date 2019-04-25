<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.2.0
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione descrizionbi in lingua
============================================================================= */
require_once('connectDB.php');

//   bottoni gestione
$btx      = new bottoni_str_par($LANG,'lang','upd_lang.php',array('nuovo','modifica','cancella','chiudi'));     
	$btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
include_once 'msg.php';

// mostra la tabella
echo "<div class='tableFixHead'>";    
echo "<table class='table table-striped table-bordered table-condensed'>"; 
echo "<thead>"; 
echo "<th>Scelta</th>";
echo "<th>Stringa codificata da tradurre</th>";
echo "<th>Traduzione nella lingua specifica</th>";
echo "</thead>";
echo "<tbody>";

 // lettura it.ini
$lang = parse_ini_file("language/".TMP::$tlang.".ini");

ksort($lang);
foreach($lang as $chiave => $valore)
     {  $$chiave=$valore;
     echo "<tr>";
     echo "<td class='center'>"; 
     $f0 = new fieldi($chiave,'chiave',0); 
	 $f0->field_ck(); 
	 echo "</td>";
     echo "<td><strong>".$chiave."</strong></td>";
     echo "<td>".$valore."</td>";
     echo "</tr>";
     }
     unset($chiave);
     echo "</tbody>";
     echo "</table>";
     echo "</fieldset>";     // col
     echo "</form>";
?> 