<?php session_start();      ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
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
require_once('init_admin.php');
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
echo    "<nav class='f-flex fd-row jc-start ai-center fw'>"; 
require_once('moduli/nav2a.php'); 	
echo    "</nav>";   
 
    //  C O R P O   =====================================             
echo "<section id='corpo'  style='height:450px'>"; 

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
