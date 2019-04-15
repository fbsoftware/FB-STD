<?php   session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 2.0    
   * copyright	Copyright (C) 2012 - 2013 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= */
//   bottoni gestione
$param = array('ritorno');
$btx   = new bottoni_str_par('Strumenti di debug','config','index.php?urla=widget.php&pag=',$param);     
     $btx->btn();     
     
echo "<fieldset style='width:700px;'><legend>REQUEST</legend>";
echo "<pre>";
echo print_r($_REQUEST);
echo "</pre></fieldset>";

echo "<fieldset style='width:700px;'><legend>SESSION:</legend>";
echo "<pre>";
echo print_r($_SESSION);
echo "</pre></fieldset>";

echo "<fieldset style='width:700px;'><legend>COOKIES</legend>";
if (isset($_COOKIE))
     {   echo "<table cellpadding='0' cellspacing='0' >";
         echo "<tr><th>Nome</th><th>Valore</th></tr>";
    foreach ($_COOKIE as $name => $value)
          {
          echo "<tr>";
          echo "<td class='fc'>";  echo $name  = htmlspecialchars($name);  echo "</td>";
          echo "<td>";  echo $value = htmlspecialchars($value); echo "</td>";
          echo "</tr>";
          }
     }   echo "</table>";
echo "</fieldset>";

echo "<fieldset style='width:700px;'><legend>POST</legend>";
echo "<pre>";
echo print_r($_POST);
echo "</pre>";
echo "</fieldset>";

echo "<fieldset style='width:700px;'><legend>GET</legend>";
echo "<pre>";
echo print_r($_GET);
echo "</pre>";
echo "</fieldset>";
  
?>
