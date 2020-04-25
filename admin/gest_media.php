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
$param = array('upload','chiudi');
$btx   = new bottoni_str_par('Gestione dei media','img','upd_media.php',$param);     
     $btx->btn();
	 
// zona messaggi
include_once 'msg.php';

// emette tebella con immagini
?>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
<?php
     $im = new imgUpdTable('images/',120,50,11,'upd_media');
     $im->putUpdTable();
