<?php session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
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

// test campi mancanti
             if (($azione != 'cancella') && ($azione != 'ritorno'))
             {
               $m = new testNoDati($rcod,$rdesc);
               $m->alert();
             }
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
           case 'copia':
                       include('DB_nuovo.php');
                               break;

           case 'modifica':
                       include('DB_modifica.php');
                                   break;

           case 'cancella':
                       include('DB_cancella.php');
                                   break;
default:
               array_push($_SESSION['esito'],'1');
}
unset($_SESSION['tab']);
     $loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
?>
