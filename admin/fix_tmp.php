<?php session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.1
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
=============================================================================
   * Fissa il template attivo per il sito
   * Se deve aggiornare:
   * - pulisce il flag di selezionato template
   * - assegna con '*' in base al parametro postato poi chiude il frame
   * - altrimenti (ritorno) chiude solo il frame
 ============================================================================ */
require_once('init_admin.php');
$num    = $_POST['scelto'];
print_r($_POST);//debug

switch($_POST['submit'])
{
case 'Conferma':
echo	$sql = ("UPDATE ".DB::$pref."tmp
              SET tsel =' '
			  WHERE ttipo != 'admin'");
		$PDO->exec($sql);    // pulisce

echo	$sql = ("UPDATE ".DB::$pref."tmp
			SET   tsel ='*'
			WHERE tcod='$num'");
		$PDO->exec($sql);    // seleziona
		$PDO->commit();
		$_SESSION['esito'] = 61;
          header('location:admin.php?'.$_SESSION['location'].'');
		break;

case 'Ritorno':
          header('location:admin.php?'.$_SESSION['location'].'');

case 'chiudi':
          header('location:admin.php?urla=widget.php&pag=');
}
?>
