<?php   session_start();       ob_start();
/** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
    package		FB open template
    versione 1.3
    copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
    license		GNU/GPL
    Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
    all'uso anche improprio di FB open template.
    ------------------------------------------------------------------------
01/03/2022	aggiunta copia nuove include in "write"
============================================================================= */
require_once('init_admin.php');
require_once ("post_".$_SESSION['tab'].".php");
$azione  =$_POST['submit'];
print_r($_POST); //debug
$_SESSION['esito'] = array();

// test campi mancanti
if (($azione != 'cancella') && ($azione != 'ritorno'))
{
  $m = new testNoDati($xcod,$xdes);
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

  echo "Operazione invalida";
}
unset($_SESSION['tab']);
$loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
?>
