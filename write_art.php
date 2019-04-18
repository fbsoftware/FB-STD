<?php session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3    
   * copyright	Copyright (C) 2011 - 2012 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ========================================================================
   * Scrive il nuovo articolo.      
============================================================================= */ 
require_once('loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once('lingua.php');
$head = new getBootHead('gestione iscritti');
     $head->getBootHead(); 
echo "</head>"; 

include('post_art.php');    
$azione =$_POST['submit'];  
//print_r($_POST);//debug

switch ($azione)
{
case 'ritorno':
               {
               $_SESSION['esito'] = 2;
               $loc = "location:index.php?".$_SESSION['location']."";
               header($loc);
               break; }

case 'nuovo' : 
               { 
               $sql = "INSERT INTO `".DB::$pref."art` 
                    ( `aid`,`astat`,`aprog`,`atit`,`aalias`,`atext`,`aarg`,`acap`,`amostra`) 
               VALUES (NULL ,'$astat','$aprog','$atit','$aalias','$atext','$aarg',
                          '$acap','$amostra') ";
               $PDO->exec($sql);    
               $PDO->commit();
               $_SESSION['esito'] = 54;
               break;
               }

case 'modifica' :
               { 
               $sql = ("UPDATE `".DB::$pref."art` 
                         SET `atext`='$atext',`acap`='$acap',`aarg`='$aarg',`atit`='$atit',
                              `aprog`='$aprog',`amostra`='$amostra',`astat`='$astat' 
                         WHERE `aid` = '$aid' ");
               $PDO->exec($sql);    
               $PDO->commit();
               $_SESSION['esito'] = 55; 
               break;         
               }
           
case 'cancella':
               { 
               $sql= ("DELETE FROM `".DB::$pref."art` where `aprog` = '$aprog' ");
               $PDO->exec($sql);    
               $PDO->commit();
               $_SESSION['esito'] = 53; 
               break; }

default :      $_SESSION['esito'] = 0;
} 
$loc = "location:index.php?".$_SESSION['location']."";
     header($loc);          
 
?>
