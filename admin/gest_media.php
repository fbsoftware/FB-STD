<?php  session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= */
require_once('../loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once('../lingua.php');
	 
// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING']; 

 //   bottoni gestione
$param = array('salva','chiudi');
$btx   = new bottoni_str_par('Gestione dei media - tipo','img','gest_media2.php',$param);     
     $btx->btn();
	 
// zona messaggi
require_once 'msg.php';

// emette tebella con immagini
?>

<?php
        $f = new DB_tip_i('pathi','pcol','','Path immagini','Path immagini da gestire');
                $f->select();

