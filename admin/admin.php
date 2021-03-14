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
	19/5/20	percorso assoluto DB::$ROOT
============================================================================= */
require_once('../loadLibraries.php');
require_once('loadTemplateAdmin.php');	
require_once(DB::$ROOT."connectDB.php");
$app = new Head('Gestione menu');
$app->openHead();
require_once(DB::$ROOT."jquery_link.php");
//require_once(DB::$ROOT."bootstrap_link.php");
require_once(DB::$ROOT."include_head.php");
require_once(DB::$ROOT."lingua.php"); 
$app->closeHead(); 

echo "<body class='admin'>";

// test se richiesto login ============================
     if(!isset($_COOKIE['admin']))
          {header('location:login.php');}

// parametri dall'url ================================
require_once(DB::$ROOT."request.php");

// setta navigatore iniziale =======================
require_once('set_nav_a.php');
	
// H E A D E R  =====================================
require_once('moduli/header_a.php');       

//  N A V I G A T O R E   ===========================
echo    "<nav>"; 
require_once('moduli/nav2a.php'); 	
echo    "</nav>";   
 
    //  C O R P O   =====================================             
echo "<section id='corpo' class='f-flex fd-column'   style='height:450px'>"; 
if ($urla){
          require_once $urla;
          } 
if ($dati){
          require_once('component/content.php');    // componenti
          }  

//  footer ============================================= 
//require_once('moduli/footer.php');
//echo "</section>" ;      //  FINE CORPO
  
echo "</body>"; 
echo "</html>";   
ob_end_flush();    
?>
