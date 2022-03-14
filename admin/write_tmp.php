<?php  session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * Scrittura sul DB tabella templates
	* 1.0.0 nuova head
	* 30/5/20	tolto tsld... perchè non utilizzato (Rimangono i campi sul database)
	* 07/02/21	gestito editor di testi e colori

============================================================================= */
require_once('init_admin.php');
require_once("post_".$_SESSION['tab'].".php");
$azione   =$_POST['submit'];

echo "<br />";
print_r($_POST);//debug

// test campi mancanti
             if (($azione != 'cancella') && ($azione != 'ritorno'))
             {
               $m = new testNoDati($tcod,$tdesc);
               $m->alert();
             }

     // transazione
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();


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
          header('location:gest_tmp.php');
          break;
}
unset($_SESSION['tab']);
header('location:admin.php?'.$_SESSION['location'].'');
ob_end_flush();

?>
