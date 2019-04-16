<?php session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
=============================================================================
   * Fissa il template attivo per il sito
   * Se deve aggiornare:   
   * - pulisce il flag di selezionato template   
   * - assegna con '*' in base al parametro postato poi chiude il frame 
   * - altrimenti (ritorno) chiude solo il frame   
 ============================================================================*/
require_once('loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once("connectDB.php");
// DOCTYPE & head
$app = new Head('Gestione menu');
$app->openHead();
require_once("include_head.php");
require_once("jquery_link.php");
require_once("bootstrap_link.php");
require_once('lingua.php'); 
$app->closeHead();

require_once 'transactDB.php';
$num    = $_POST['scelto']; 
$return = $_POST['submit'];

switch($return)
{
case 'Conferma':


     $result = $PDO->query("UPDATE ".DB::$pref."tmp
                            SET tsel =' ' ")
             or die ('fix_tmp/conferma:'.mysql_error());   // pulisce
     $result = $PDO->query("UPDATE ".DB::$pref."tmp
                            SET   tsel ='*'  
                            WHERE tprog='$num'")
                            or die ('fix_tmp/conferma:'.mysql_error());   // seleziona
     $url='';
     $iframe='';
     break;
  
case 'Ritorno':
     $url='';
     $iframe='';
     $forma='';
     break;
	   
case 'chiudi':
     $url='';
     $iframe='';
     $forma='';
     break;
}
     header('location:index.php?'.$_SESSION['location'].'');

?>
