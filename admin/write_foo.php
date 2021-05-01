<?php session_start();
/** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * Scrittura tabella '£tab'      
============================================================================= */ 
require_once('init_admin.php');
require_once('post_foo.php');
           
$azione   =    $_POST['submit'];          
print_r($_POST);//debug

// test validità codice  
if (($fcod <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          {
          $_SESSION['errore'] = 1;
          $_SESSION['errore0'] = 1;
          }
// test validità descrizione   
if (($fdes <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
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
echo           $sql = "INSERT INTO `".DB::$pref."foo` 
                      (fid,fprog,fstat,ftmp,fcod,fdes,fcol,ftipo,ftitolo,felemento,ftext,flink) 
                      VALUES (NULL,$fprog,'$fstat','$ftmp','$fcod','$fdes','$fcol','$ftipo','$ftitolo','$felemento','$ftext','$flink')";
                      $PDO->exec($sql);    
                      $PDO->commit();
                      $_SESSION['esito'] = 54;                      
                      break;

case 'modifica':
echo           $sql = "UPDATE `".DB::$pref."foo` 
                   SET fprog=$fprog,fstat='$fstat',fcod='$fcod',fdes='$fdes',
                         ftmp='$ftmp',fcol='$fcol',ftipo='$ftipo',ftitolo='$ftitolo',
                         felemento='$felemento',ftext='$ftext',flink='$flink'  
                   WHERE fid= $fid ";
                  $PDO->exec($sql);    
                  $PDO->commit();
                  $_SESSION['esito'] = 55;
                  break;
  
case 'cancella':
            $sql = "DELETE from `".DB::$pref."foo` 
                    WHERE fid= '$fid' ";
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