<?php session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
	* ------------------------------------------------------------------------
	* aggiornamento tabella 'arg'
	* 1.0.0	nuova head
============================================================================= */
require_once('init_admin.php');
require_once("post_".$_SESSION['tab'].".php");
$azione  =$_POST['submit'];
/*
// test validità codice
$_SESSION['esito'] = array();
if (($rcod <= '') && (($azione != 'cancella') && ($azione != 'ritorno')))
          {
          array_push($_SESSION['esito'],'151');
          }

// test validità descrizione
if (($rdesc <= '') && (($azione != 'cancella') && ($azione != 'ritorno')))
          {
          array_push($_SESSION['esito'],'154');
          }
*/
if (($azione != 'cancella') && ($azione != 'ritorno'))
{
  $m = new testNoDati($rcod,$rdesc);
  $m->alert();
}


switch ($azione)
{
case 'ritorno':
      array_push($_SESSION['esito'],'2');
			$loc = "location:admin.php?".$_SESSION['location']."";
     		header($loc);
     	     break;

case 'nuovo':
echo     $sql = "INSERT INTO `".DB::$pref."arg`
                         (rid,rprog,rstat,rcod,rdesc,rtext,rmostra)
                         VALUES (NULL,'$rprog','$rstat','$rcod','$rdesc','$rtext','$rmostra')";
               $PDO->exec($sql);
               $PDO->commit();
               array_push($_SESSION['esito'],'54');
               break;

case 'modifica':
     $sql = "UPDATE `".DB::$pref."arg`
                  SET rprog='$rprog',rstat='$rstat',rcod='$rcod',rdesc='$rdesc',
                      rtext='$rtext',rmostra='$rmostra'
                  WHERE rid= '$rid' ";
                  $PDO->exec($sql);
                  $PDO->commit();
                  array_push($_SESSION['esito'],'55');
                        break;
case 'cancella':
     $sql = "DELETE from `".DB::$pref."arg`
                  WHERE rid= '$rid' ";
                  $PDO->exec($sql);
                  $PDO->commit();
                  array_push($_SESSION['esito'],'53');
                break;
default:
               array_push($_SESSION['esito'],'1');
}
     $loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
?>
