<?php session_start();
/*** ========================================================================
	*   	TEMPLATE PER APP WRITE_XXX.PHP
	*========================================================================
   * Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
	£tab	nome tabella 
	£id		campo prefisso + id
	£stat	campo prefisso + stato
	£prog	campo prefisso + progressivo
	£cod	campo prefisso + codice
	£des	campo prefisso + descrizione
	£link	campo prefisso + link 
	£tmp	campo prefisso + template   
============================================================================= */ 
include_once('post_£tab.php');
           
$azione   =    $_POST['submit'];          
//print_r($_POST);//debug

// test validità codice  
if (($£cod <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
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
           $sql = "INSERT INTO `".DB::$pref."£tab` 
							(£id,£prog,£stat,£tmp,£cod,£des,£col,£link,) 
                      VALUES (NULL,$£prog,'$£stat','$£tmp','$£cod','$£des','$£col','$£link')";
                      $PDO->exec($sql);    
                      $PDO->commit();
                      $_SESSION['esito'] = 54;                      
                      break;

case 'modifica':
           $sql = "UPDATE `".DB::$pref."£tab` 
                   SET £prog=$£prog,£stat='$£stat',£cod='$£cod',£des='$£des',
                         £tmp='$£tmp',£col='$£col',gtext='$gtext',£link='$£link'  
                   WHERE £id= $£id ";
                  $PDO->exec($sql);    
                  $PDO->commit();
                  $_SESSION['esito'] = 55;
                  break;
  
case 'cancella':
            $sql = "DELETE from `".DB::$pref."£tab` 
                    WHERE £id= '$£id' ";
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