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

require_once('post_arg.php');
$azione  =$_POST['submit'];

// test validità codice
if (($rcod <= '') && (($azione != 'cancella') && ($azione != 'ritorno')))
          {
          $_SESSION['errore'] = 1;
          $_SESSION['errore0'] = 1;
          }

// test validità descrizione
if (($rdesc <= '') && (($azione != 'cancella') && ($azione != 'ritorno')))
          {
          $_SESSION['errore'] = 1;
          $_SESSION['errore4'] = 1;
          }

switch ($azione)
{
case 'ritorno':
               $_SESSION['esito'] = 2;
			$loc = "location:admin.php?".$_SESSION['location']."";
     		header($loc);
     	     break;

case 'nuovo':
echo     $sql = "INSERT INTO `".DB::$pref."arg`
                         (rid,rprog,rstat,rcod,rdesc,rtext,rmostra)
                         VALUES (NULL,'$rprog','$rstat','$rcod','$rdesc','$rtext','$rmostra')";
               $PDO->exec($sql);
               $PDO->commit();
               $_SESSION['esito'] = 54;
               break;

case 'modifica':
     $sql = "UPDATE `".DB::$pref."arg`
                  SET rprog='$rprog',rstat='$rstat',rcod='$rcod',rdesc='$rdesc',
                      rtext='$rtext',rmostra='$rmostra'
                  WHERE rid= '$rid' ";
                  $PDO->exec($sql);
                  $PDO->commit();
                  $_SESSION['esito'] = 55;
                        break;
case 'cancella':
     $sql = "DELETE from `".DB::$pref."arg`
                  WHERE rid= '$rid' ";
                  $PDO->exec($sql);
                  $PDO->commit();
                  $_SESSION['esito'] = 53;
                break;
default:
               $_SESSION['esito'] = 1;
}
     $loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
?>
