<?php  session_start();   ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package            fbot-boot
   * versione 1.0    
   * copyright  Copyright (C) 2012 - 2013 FB. All rights reserved.
   * license            GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= 
   *    
============================================================================= */
require_once('loadLibraries.php');
require_once('loadTemplateSito.php');	
require_once("connectDB.php");
// DOCTYPE & head
$app = new Head('Gestione sito');
$app->openHead();
require_once("jquery_link.php");
//require_once("bootstrap_link.php");
require_once("include_head.php");
require_once('lingua.php'); 
$app->closeHead();

echo "<body id='body'>";
// parametri passati con l'url e memorizzati 
require_once 'request.php';		//var_dump($_SESSION);//debug

//  template   
require_once(TMP::$tfolder.'index.php'); 

echo "</body>"; 
echo "</html>";   
ob_end_flush();    
?>