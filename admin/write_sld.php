<?php session_start();
ob_start();
/**
 * ** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
 * package		FB open template
 * versione 2.0    
 * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
 * license		GNU/GPL
 * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
 * all'uso anche improprio di FB open template.
 * ------------------------------------------------------------- 
 * Aggiornamento tabella 'sld' per slides
 * =============================================================================  */
require_once('../loadLibraries.php');
require_once('loadTemplateAdmin.php');
$app = new Head('Gestione menu');
$app->openHead();
require_once("../jquery_link.php");
//require_once("../bootstrap_link.php");
require_once("../include_head.php");
require_once('../lingua.php'); 
$app->closeHead();
//----------------------------------------------

require_once('post_sld.php');
$azione = $_POST['submit'];    //print_r($_POST); //debug

// test validità codice  
if (($slcod <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          {
          $_SESSION['errore'] = 1;
          $_SESSION['errore0'] = 1;
          }
// test validità descrizione   
if (($slde <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          {
          $_SESSION['errore'] = 1;
          $_SESSION['errore4'] = 1;
          }
 
switch ($azione)
 {
case 'nuovo':
     $sql = "INSERT INTO `" . DB :: $pref . "sld` 
                (slid,slstat,slprog,slcod,slde,sltmp,
                    slimg,slalt,slcaption,sldesc,slinkcap,slink) 
                VALUES (NULL,'$slstat',$slprog, '$slcod','$slde','$sltmp',
                    '$slimg','$slalt','$slcaption','$sldesc','$slinkcap','$slink')";
     		$PDO -> exec($sql);
     		$PDO -> commit();
     		$_SESSION['esito'] = 54;
     	break;

case 'modifica':
     $sql = "UPDATE `" . DB :: $pref . "sld` 
                  SET slprog=$slprog,slstat='$slstat',slcod='$slcod',slde='$slde',sltmp='$sltmp',
                         slimg='$slimg',slalt='$slalt', slcaption='$slcaption',sldesc='$sldesc',
                         slinkcap='$slinkcap',slink='$slink'
                  WHERE slid=$slid";
     		$PDO -> exec($sql);
     		$PDO -> commit();
     		$_SESSION['esito'] = 55;
     	break;

case 'cancella':
     $sql = "DELETE from `" . DB :: $pref . "sld` 
                  WHERE slid='$slid'";
		     $PDO -> exec($sql);
     		$PDO -> commit();
     		$_SESSION['esito'] = 53;
     	break;

case 'uscita':
     $_SESSION['esito'] = 2;
     break;
default:
     $_SESSION['esito'] = 0;
     break;
    } 

$loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
ob_end_flush();
?> 