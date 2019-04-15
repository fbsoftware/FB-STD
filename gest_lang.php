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
if (!function_exists('getBootHead')) 
{
// DOCTYPE & head
include_once 'include_gest.php';
$head = new getBootHead('Lingue',$_SESSION['ambito']);
     $head->getBootHead(); 
     echo "</head>";   
}
//   bottoni gestione
$btx      = new bottoni_str_par($LANG,'lang','upd_lang.php',array('nuovo','modifica','cancella','chiudi'));     
$btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
include_once 'msg.php';

// mostra la tabella
echo "<div class='col-md-4'>";
echo "<table class='table table-striped table-bordered table-condensed'>"; 
echo "<thead>"; 
echo "<th>Scel</th>";
echo "<th>Stringa codifica</th>";
echo "<th>--- Traduzione nella lingua ---</th>";
echo "</thead>";

echo "<tbody>";
 // lettura it.ini
$lang = parse_ini_file("language/it.ini");
ksort($lang);
foreach($lang as $chiave => $valore)
     {  $$chiave=$valore;
     echo "<tr>";
     echo "<td class='center'>"; 
     $f0 = new fieldi($chiave,'chiave',0); $f0->field_ck(); echo "</td>";
     echo "<td><strong>".$chiave."</strong></td>";
     echo "<td>".$valore."</td>";
     echo "</tr>";
     }
     unset($chiave);
     echo "</tbody>";
     echo "</table>";
     echo "</form>";
     echo "</div>";     // col
?> 