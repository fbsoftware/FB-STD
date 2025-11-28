<?php session_start();
/**
  Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
    package		FB open template
    versione 1.3
    copyright	Copyright (C) 2011 - 2012 FB. All rights reserved.
    license		GNU/GPL
    Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
    all'uso anche improprio di FB open template.
    ========================================================================
    Scrive il nuovo articolo.
============================================================================= */
require_once('init_admin.php');
require_once("post_".$_SESSION['tab'].".php");
$azione =$_POST['submit'];
$_SESSION['esito'] = array();

if (($azione != 'cancella') && ($azione != 'ritorno')) 
{
  $m = new testNoDati($atit,$atext);
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
             $_SESSION['tab'] = "art";
            include_once('DB_nuovo.php');
                    break;

case 'modifica':
            include_once('DB_modifica.php');
                        break;

case 'cancella':
            include_once('DB_cancella.php');
                        break;

default :      array_push($_SESSION['esito'],'0');
}
unset($_SESSION['tab']);
$loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);

?>
