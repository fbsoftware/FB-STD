<?php   session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 2.0    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= */
require_once('loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once('lingua.php');
require_once('connectDB.php');
//   bottoni gestione
$param = array('ritorno');
$btx   = new bottoni_str_par('Strumenti di debug','config','admin.php?urla=widget.php&pag=',$param);     
     $btx->btn();     
     
echo "<fieldset class='col-md-6'><legend>REQUEST</legend>";
echo "<pre>";
echo print_r($_REQUEST);
echo "</pre></fieldset>";

echo "<fieldset class='col-md-6'><legend>SESSION:</legend>";
echo "<pre>";
echo print_r($_SESSION);
echo "</pre></fieldset>";

echo "<fieldset class='col-md-6'><legend>COOKIES</legend>";
if (isset($_COOKIE))
     {   echo "<table class='table table-striped table-bordered table-condensed'>"; 
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

echo "<fieldset class='col-md-6'><legend>POST</legend>";
echo "<pre>";
echo print_r($_POST);
echo "</pre>";
echo "</fieldset>";

echo "<fieldset class='col-md-6'><legend>GET</legend>";
echo "<pre>";
echo print_r($_GET);
echo "</pre>";
echo "</fieldset>";
  
?>
