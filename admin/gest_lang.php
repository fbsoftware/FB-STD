<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.2.0
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione descrizionbi in lingua
============================================================================= */


//   bottoni gestione
$btx      = new bottoni_str_par($LANG,'lang','upd_lang.php',array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$CLO.'|chiudi'));     
	$btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
require_once 'msg.php';

//   mostra la tabella filtrata --------------------------------------------------
echo "<section id='cap'>"; 

echo "<div class='table fb-h80'>"; 
   
echo "<div class='th'>"; 
echo "<div class='td'>$SCEL</div>";
echo "<div class='td'>$STR-$COD</div>";
echo "<div class='td'>$STR-$TRANSLATE</div>";
echo "</div>"; 

 // lettura it.ini
$lang = parse_ini_file("language/".TMP::$tlang.".ini");

ksort($lang);
foreach($lang as $chiave => $valore)
     {  $$chiave=$valore;
     echo "<div class='tr'>";
     echo "<div class='td'>"; 
     $f0 = new fieldi($chiave,'chiave',0,''); 
	 $f0->field_ck(); 
	 echo "</div>";
     echo "<div class='td'><strong>".$chiave."</strong></div>";
     echo "<div class='td'>".stripslashes($valore)."</div>";
     echo "</div>";
     }
     unset($chiave);
	echo "</div>";
	echo "</section>";
	echo "</form>";
?> 