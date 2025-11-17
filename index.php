<?php  session_start();   ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package            fbot-boot
   * versione 1.0    
   * copyright  Copyright (C) 2012 - 2013 FB. All rights reserved.
   * license            GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= 
   * 20/04/2021		colore di sfondo nel <body>   
============================================================================= */
require_once('init_site.php');
// log errori
 
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//tema
echo "<body>";
// parametri passati con l'url e memorizzati 
require_once 'request.php';		
//var_dump($_SESSION);//debug

//  index del template   
require_once(TMP::$tfolder.'index.php'); 

echo "</body>"; 
echo "</html>";   
ob_end_flush();    
?>