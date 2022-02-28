<?php session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * aggiornamento tabella 'cap'
   * 2.0 aggiunto argomento del capitolo.
============================================================================= */
require_once('init_admin.php');
require_once('post_cap.php');
$azione  =$_POST['submit'];

// test validità codice
$_SESSION['esito'] = array();
if (($ccod <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          { array_push($_SESSION['esito'],'151'); }
// test validità descrizione
if (($cdesc <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          { array_push($_SESSION['esito'],'154'); }

switch ($azione)
{
case 'nuovo':
     $sql = "INSERT INTO `".DB::$pref."cap`
                         (cid,cprog,cstat,ccod,cdesc,ctext,cmostra,carg)
                         VALUES (NULL,'$cprog','$cstat','$ccod','$cdesc','$ctext','$cmostra','$carg')";
// transazione
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();
               $PDO->exec($sql);
               $PDO->commit();
               { array_push($_SESSION['esito'],'54'); }
               //$_SESSION['esito'] = 54;
               break;

case 'modifica':
     $sql = "UPDATE `".DB::$pref."cap`
                  SET cprog='$cprog',cstat='$cstat',ccod='$ccod',cdesc='$cdesc',
                      ctext='$ctext',cmostra='$cmostra' ,carg='$carg'
                  WHERE cid= '$cid' ";
// transazione
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();

                  $PDO->exec($sql);
                  $PDO->commit();
                  //$_SESSION['esito'] = 55;
                  { array_push($_SESSION['esito'],'55'); }
                  break;
case 'cancella':
     $sql = "DELETE from `".DB::$pref."cap`
                  WHERE cid= '$cid' ";
// transazione
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();

                  $PDO->exec($sql);
                  $PDO->commit();
                  //$_SESSION['esito'] = 53;
                  { array_push($_SESSION['esito'],'53'); }
                  break;
case 'ritorno':
               //$_SESSION['esito'] = 2;
               { $_SESSION = array($_SESSION['esito'],'2'); }
               header("location:admin.php?".$_SESSION['location']."");
               break;

default:
                    { array_push($_SESSION['esito'],'0'); }
}
     $loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
?>
