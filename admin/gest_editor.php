<?php
/*** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
   * package		FB JQUERY
   * versione 3.1
   * copyright	Copyright (C) 2025 - 2026 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * -------------------------------------------------------------------------
   * Gestione di editor, scelta del tema e della pagina da editare
   * 15/03/2022	creato
============================================================================= */
require_once('../loadLibraries.php');
require_once('../loadTemplateSito.php');
// database
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();
// utile in sviluppo per vedere gli errori
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//   toolbar
$btx = new bottoni_str_par('Siti temi pagine','','editor.php',array('nuovo','modifica','copia','cancella','chiudi'));
     $btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// leggi la cartella dei temi (siti) -----------------------------------------------
$parentFolder = '../editor/siti'; // Inserisci il percorso della cartella padre
if (is_dir($parentFolder)) {
    $items = array_diff(scandir($parentFolder), array('.', '..'));
echo "<select>";
    foreach ($items as $item) {
        if (is_dir($parentFolder . '/' . $item)) 
        { // Assicura che sia una cartella
            echo "<div class='tr'>";
            echo "<option><a href='editor.php?tema=" . urlencode($item) . "&page=home'>" . htmlspecialchars($item) . "</a></option>";
            echo "</div>";
        }
     } 
}    
	echo "</section>";
	echo "</form>";
?>
