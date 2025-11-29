<?php
/*** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
   * package		FB open template
   * versione 1.2
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
=============================================================================
   * visualizza widgets applicazione
============================================================================= */
require_once('init_admin.php');

echo "<div class=''>";
echo "<img src='images/logo/logo.png' alt='LOGO' title='logo'
		style='display:block; margin-left: auto; margin-right: auto; margin-top:10em;'>";
echo "</div>";
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
