<?php session_start();
/** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
    package		FB open template
    versione 1.3
    copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
    license		GNU/GPL
    Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
    all'uso anche improprio di FB open template.
    ------------------------------------------------------------------------
    aggiornamento tabella 'asl'
	25.03.21	aggiunto si-no titolo sezione
  15/03/2022	aggiunta copia, nuove include in "write"
============================================================================= */
require_once('init_admin.php');
require_once("post_".$_SESSION['tab'].".php");     print_r($_POST);//debug
$azione   =    $_POST['submit'];

// test campi mancanti
             if (($azione != 'cancella') && ($azione != 'ritorno'))
             {
               $m = new testNoDati($dcod,$ddes);
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
               $loc = "location:admin.php?".$_SESSION['location']."";
               header($loc);
               break;

default:
  echo "[".$azione."]-Operazione invalida";
}
unset($_SESSION['tab']);
header('location:admin.php?'.$_SESSION['location'].'');
?>
