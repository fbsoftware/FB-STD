<?php   session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.0   
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
=============================================================================  
   07/03/21		scelta del menù per mostrare le relative voci
=============================================================================  */

  //   toolbar
$param  = array('mostra','chiudi');  
$btx   = new bottoni_str_par('Scelta menù ','nav','gest_nav2.php',$param);     
     $btx->btn();
      
// memorizza location iniziale
	$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
require_once 'msg.php';
  
$menu = new DB_nav();
$scelta = $menu->menu();
echo "</form>";
?> 