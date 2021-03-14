<?php    session_start();       ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'xdb' sipologie codificate. 
   * 28/5/2019	aggiunta copia
============================================================================= */ 

 //   toolbar
$param  = array('mostra','chiudi');  
$btx   = new bottoni_str_par('Scelta settori '.$TIP,'xdb','gest_xdb2.php',$param);     
     $btx->btn();

// zona messaggi
require_once 'msg.php';

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

$sect = new DB_xdb();
$settore = $sect->settori();

	echo "</form>";
?> 
