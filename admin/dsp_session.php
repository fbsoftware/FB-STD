<?php   session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 2.0
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
============================================================================= */
require_once('../loadLibraries.php');
require_once('loadTemplateAdmin.php');

?>
 <!-- tabs -->
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>
<?php

//   toolbar
$param = array('ritorno');
$btx   = new bottoni_str_par('Strumenti di debug','config','admin.php?urla=widget.php&pag=',$param);
     $btx->btn();
?>
	<div id="tabs">
  <ul>
	<li><a href="#tabs-0">Request</a></li>
    <li><a href="#tabs-1">Session</a></li>
    <li><a href="#tabs-2">Cookies</a></li>
    <li><a href="#tabs-3">Post</a></li>
	<li><a href="#tabs-4">Get</a></li>
  </ul>

 <?php
echo "<div id='tabs-0' class='row'>";
echo "<fieldset>";
echo "<pre>";
echo print_r($_REQUEST);
echo "</pre>";
echo "</fieldset>";
echo "</div>";

echo "<div id='tabs-1' class='row'>";
echo "<fieldset>";
echo "<pre>";
echo print_r($_SESSION);
echo "</pre>";
echo "</fieldset>";
echo "</div>";

echo "<div id='tabs-2' class='row'>";
echo "<fieldset>";
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
echo "</div>";


echo "<div id='tabs-3' class='row'>";
echo "<fieldset>";
echo "<pre>";
echo print_r($_POST);
echo "</pre>";
echo "</fieldset>";
echo "</div>";


	echo "<div id='tabs-4' class='row'>";
	echo "<fieldset>";
echo "<pre>";
echo print_r($_GET);
echo "</pre>";
echo "</fieldset>";
echo "</div>";

	echo "</div>";	// tabs
echo "</form>";

?>
