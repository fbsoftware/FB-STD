<?php   session_start();
/*** Fausto Bresciani   fbsoftware.bresciani@gmail.com  www.fbsoftware.altervista.org
   * package		Gestione Associazione
   * versione 1.3
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
=============================================================================
   *  Scelta della tabella 
=============================================================================  */
if (!function_exists('getBootHead')) 
{
require_once('loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once('lingua.php');
$head = new getBootHead('gestione iscritti');
     $head->getBootHead(); 
echo "</head>"; 
}  

//   bottoni gestione
$param  = array('mostra','chiudi');    
$btx    = new bottoni_str_par('Struttura del database','config','vid_db.php',$param);  
     $btx->btn();
  
//  filtro la tabella da visualizzare
echo "<div><fieldset class='input'><div>";
$tb = new DB_sel_table(DB::$pref);
	$tb->select_table() ;
echo "</fieldset>";
echo "</form><div>";
