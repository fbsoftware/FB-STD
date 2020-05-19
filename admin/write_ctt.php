<?php session_start();
/*** ========================================================================
	*   	TEMPLATE PER APP WRITE_CTT.PHP
	*========================================================================
   * Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------

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

require_once('post_ctt.php');
           
$azione   =    $_POST['submit'];          
print_r($_POST);//debug

// test validità codice  
if (($ecod <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          {
          $_SESSION['errore'] = 1;
          $_SESSION['errore0'] = 1;
          }
// test validità descrizione   
if (($edes <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
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
           $sql = "INSERT INTO `".DB::$pref."ctt` 
							(eid,eprog,estat,etmp,ecod,edes,ecat,etipo,eimg,email,
							 epec,esito,etel,efax,ecel,esede,enote) 
                      VALUES (NULL,$eprog,'$estat','$etmp','$ecod','$edes','$ecat','$etipo','$eimg','$email','$epec','$esito','$etel','$efax','$ecel','$esede','$enote')";
                      $PDO->exec($sql);    
                      $PDO->commit();
                      $_SESSION['esito'] = 54;                      
                      break;

case 'modifica':
echo           $sql = "UPDATE `".DB::$pref."ctt` 
                   SET eprog=$eprog,estat='$estat',ecod='$ecod',edes='$edes',
                         etmp='$etmp',ecat='$ecat',etipo='$etipo',eimg='$eimg',email='$email',
						epec='$epec',esito='$esito',etel='$etel',efax='$efax',ecel='$ecel',esede='$esede',
						enote='$enote'
                   WHERE eid= $eid ";
                  $PDO->exec($sql);    
                  $PDO->commit();
                  $_SESSION['esito'] = 55;
                  break;
  
case 'cancella':
            $sql = "DELETE from `".DB::$pref."ctt` 
                    WHERE eid= '$eid' ";
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
        header('location:admin.php?'.$_SESSION['location'].'');
?> 