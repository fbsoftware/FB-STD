<?php 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.2    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= 
   * visualizza widgets applicazione
============================================================================= */
require_once("../loadLibraries.php");
require_once("loadTemplateAdmin.php");
require_once($_SERVER['DOCUMENT_ROOT'].DB::$root."lingua.php");
require_once($_SERVER['DOCUMENT_ROOT'].DB::$root."connectDB.php");
echo "<img src='images/logo/logo.png' alt='LOGO' title='logo'style='margin-left:200px;margin-top:150px;'>";
// resetto tutti gli errori
     unset($_SESSION['esito']);
     unset($_SESSION['errore']);
     unset($_SESSION['errore0']);
     unset($_SESSION['errore1']);
     unset($_SESSION['errore2']);
     unset($_SESSION['errore3']);
     unset($_SESSION['errore4']);
     unset($_SESSION['errore5']);
?>