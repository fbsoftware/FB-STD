<?php  session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * scelta del tema tabella 'lay' layout di pagina.
	 		15/03/2022	aggiunta, copia nuove include in "write"
============================================================================= */
// toolbar, scelta del tema
$param  = array('mostra','chiudi');
$btx   = new bottoni_str_par('Scelta del tema','lay','gest_lay2.php',$param);
     $btx->btn();

// memorizza location iniziale
	$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
$parm = $_SESSION['esito'];
$m = new msg($parm);
$m->msg();

// scelta tema
$arg2 = new DB_sel_lt('tmp','tcod','','tcod','tema','tstat','ttdes','Tema','Scelta del tema');
$arg2->select_lt();
echo "</form>";
?>