<?php session_start();
/** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * aggiornamento tabella 'asl'      
============================================================================= */ 
require_once('../loadLibraries.php');
require_once('loadTemplateAdmin.php');
$app = new Head('Gestione menu');
$app->openHead();
require_once("../jquery_link.php");
require_once("../bootstrap_link.php");
require_once("../include_head.php");
require_once('../lingua.php'); 
$app->closeHead();
//----------------------------------------------
require_once('post_asl.php');
   
$azione   =    $_POST['submit'];       print_r($_POST);//debug

// test validità codice  
if (($dcod <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          {
          $_SESSION['errore'] = 1;
          $_SESSION['errore0'] = 1;
          }
// test validità descrizione   
if (($ddes <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          {
          $_SESSION['errore'] = 1;
          $_SESSION['errore4'] = 1;
          }
 
switch ($azione)
{
case 'nuovo':
echo           $sql = "INSERT INTO `".DB::$pref."asl` 
                      (did,dprog,dstat,dtmp,dcod,ddes,dcap,dtipo,dcol,dart) 
                      VALUES (NULL,'$dprog','$dstat','$dtmp','$dcod','$ddes',
                                   '$dcap','$dtipo','$dcol','$dart')";
                      $PDO->exec($sql);    
                      $PDO->commit();
                      $_SESSION['esito'] = 54;                      
                      break;

case 'modifica':
echo           $sql = "UPDATE `".DB::$pref."asl` 
                   SET dprog='$dprog',dstat='$dstat',dtmp='$dtmp',dcod='$dcod',ddes='$ddes',
                         dcap='$dcap', dtipo='$dtipo',dcol='$dcol',dart='$dart'
                    WHERE did= '$did' ";
               $PDO->exec($sql);    
               $PDO->commit();
               $_SESSION['esito'] = 55;
               break;
  
case 'cancella':
            $sql = "DELETE from `".DB::$pref."asl` 
                    WHERE did= '$did' ";
                    $PDO->exec($sql);    
                    $PDO->commit();
                    $_SESSION['esito'] = 53;
                    break;
  
case 'ritorno':
               $_SESSION['esito'] = 2;
               header('location:gest_asl.php');
               break;
   
default:
  echo "[".$azione."]-Operazione invalida";
}
          header('location:admin.php?'.$_SESSION['location'].'');
?> 