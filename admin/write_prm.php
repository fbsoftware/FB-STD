<?php session_start();
/** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
   * package		FB open template
   * versione 1.3
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * aggiornamento tabella 'prm'
============================================================================= */
require_once('init_admin.php');
require_once("post_".$_SESSION['tab'].".php");
$azione   =    $_POST['submit'];
print_r($_POST);//debug

// test campi mancanti
             if (($azione != 'cancella') && ($azione != 'ritorno'))
             {
               $m = new testNoDati($ocod,$odes);
               $m->alert();
             }

switch ($azione)
{
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
case 'ritorno':
               array_push($_SESSION['esito'],'2');
               break;

default:
  echo "Operazione invalida";
  break;
}
unset($_SESSION['tab']);
$loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
?>
