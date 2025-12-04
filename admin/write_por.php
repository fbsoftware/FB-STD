<?php session_start();
ob_start();
/**
 * ** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
 * package		FB open template
 * versione 2.0
 * copyright	Copyright (C) 2025 - 2026 FB. All rights reserved.
 * license		GNU/GPL
 * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
 * all'uso anche improprio di FB open template.
 * -------------------------------------------------------------
 * Aggiornamento tabella 'por' per portfolio
 15/03/2022	aggiunta copia, nuove include in "write"
 * =============================================================================  */
require_once('init_admin.php');
require_once("post_".$_SESSION['tab'].".php");
$_SESSION['esito'] = array();
$azione = $_POST['submit'];
print_r($_POST); //debug

// test campi mancanti
             if (($azione != 'cancella') && ($azione != 'ritorno'))
             {
               $m = new testNoDati($pcod,$pdes);
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
     array_push($_SESSION['esito'],'0');
     break;
    }
unset($_SESSION['tab']);
$loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
ob_end_flush();
?>
