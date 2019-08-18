<?php session_start();      ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		Gestionale
   * versione 1.0    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= 
   * 1.0.0	tolto codice inserito in: set_nav.php
			tolto bottone di exit inserito in moduli/nav2.php
============================================================================= */
// prima voce menù
$nav	= new setNav(TMP::$ambiente);
	$nav->setNav(); 
//require_once("set_nav.php"); 
echo	"<body>";
//-- CONTENUTO DELLA PAGINA ...
echo	"<div class='container-fluid well'>";
include 'layout.php';  
include 'goBack.php';  
echo	"</div>";
echo	"</body>";
echo	"</html>";
?>