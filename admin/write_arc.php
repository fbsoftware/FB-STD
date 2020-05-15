<?php session_start();
/** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * aggiornamento tabella 'arc'      
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
include_once('post_arc.php');
   
$azione   =    $_POST['submit'];       print_r($_POST);//debug

// test validità codice  
if (($hcod <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          {
          $_SESSION['errore'] = 1;
          $_SESSION['errore0'] = 1;
          }
// test validità descrizione   
if (($hdes <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          {
          $_SESSION['errore'] = 1;
          $_SESSION['errore4'] = 1;
          }
 
switch ($azione)
{
case 'nuovo':
echo           $sql = "INSERT INTO `".DB::$pref."arc` 
                      (hid,hprog,hstat,htmp,hcod,hdes,hsino1,htit1,hsino2,htit2,hsino3,htit3,hsino4,htit4) 
                      VALUES (NULL,'$hprog','$hstat','$htmp','$hcod','$hdes',
                                   '$hsino1','$htit1','$hsino2','$htit2','$hsino3','$htit3','$hsino4','$htit4')";
                      $PDO->exec($sql);    
                      $PDO->commit();
                      $_SESSION['esito'] = 54;                      
                      break;

case 'modifica':
echo           $sql = "UPDATE `".DB::$pref."arc` 
                   SET hprog='$hprog',hstat='$hstat',htmp='$htmp',hcod='$hcod',hdes='$hdes',
                         hsino1='$hsino1',hsino2='$hsino2', hsino3='$hsino3', hsino4='$hsino4',  
						 htit1='$htit1',htit2='$htit2',htit3='$htit3',htit4='$htit4'
                    WHERE hid= '$hid' ";
               $PDO->exec($sql);    
               $PDO->commit();
               $_SESSION['esito'] = 55;
               break;
  
case 'cancella':
            $sql = "DELETE from `".DB::$pref."arc` 
                    WHERE hid= '$hid' ";
                    $PDO->exec($sql);    
                    $PDO->commit();
                    $_SESSION['esito'] = 53;
                    break;
  
case 'ritorno':
               $_SESSION['esito'] = 2;
               header('location:gest_arc.php');
               break;
   
default:
  echo "[".$azione."]-Operazione invalida";
}
          header('location:admin.php?'.$_SESSION['location'].'');
?> 