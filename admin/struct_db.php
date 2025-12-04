<?php   session_start();
/*** Fausto Bresciani   fbsoftware.bresciani@gmail.com  www.faustobresciani.it
   * package		Gestione Associazione
   * versione 1.3
   * copyright	Copyright (C) 2025 - 2026 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
=============================================================================
   *  Scelta della tabella 
=============================================================================  */
//   bottoni gestione
$param  = array('mostra','chiudi');    
$btx    = new bottoni_str_par('Struttura del database','config','vid_db.php',$param);  
     $btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];
  
//  filtro la tabella da visualizzare
echo "<div><fieldset><div>";
$tb = new DB_sel_table(DB::$pref);
	$tb->select_table() ;
echo "</fieldset>";
echo "</form><div>";
