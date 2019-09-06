<?php session_start();
/** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * aggiornamento tabella 'gly'      
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
include_once('post_gly.php');
           
$azione   =    $_POST['submit'];          print_r($_POST);//debug

// test validità codice  
if (($gcod <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          {
          $_SESSION['errore'] = 1;
          $_SESSION['errore0'] = 1;
          }
// test validità descrizione   
if (($gdes <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          {
          $_SESSION['errore'] = 1;
          $_SESSION['errore4'] = 1;
          } 
          
// transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 

switch ($azione)
{
case 'nuovo':
           $sql = "INSERT INTO `".DB::$pref."gly` 
                      (gid,gprog,gstat,gtmp,gcod,gdes,gcol,gdim,gtitle,gfa,gtext,gcolor,graggio,glink) 
                      VALUES (NULL,$gprog,'$gstat','$gtmp','$gcod','$gdes','$gcol',
                                   '$gdim','$gtitle','$gfa','$gtext','$gcolor','$graggio','$glink')";
                      $PDO->exec($sql);    
                      $PDO->commit();
                      $_SESSION['esito'] = 54;                      
                      break;

case 'modifica':
           $sql = "UPDATE `".DB::$pref."gly` 
                   SET gprog=$gprog,gstat='$gstat',gcod='$gcod',gdes='$gdes',
                         gtmp='$gtmp',gcol='$gcol',gdim='$gdim',gtitle='$gtitle',
                         gfa='$gfa',gtext='$gtext',gcolor='$gcolor',graggio='$graggio',
					glink='$glink'  
                   WHERE gid= $gid ";
                  $PDO->exec($sql);    
                  $PDO->commit();
                  $_SESSION['esito'] = 55;
                  break;
  
case 'cancella':
            $sql = "DELETE from `".DB::$pref."gly` 
                    WHERE gid= '$gid' ";
                    $PDO->exec($sql);    
                    $PDO->commit();
                    $_SESSION['esito'] = 53;
                    break;
  
case 'ritorno':
               $_SESSION['esito'] = 2;              
               break;
   
default:
  echo "Operazione invalida";
}
$loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
?> 