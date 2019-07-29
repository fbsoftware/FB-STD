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

require_once('loadTemplateAdmin.php');  

echo "<body>";
// test se richiesto login ============================
     if(!isset($_COOKIE['admin']))
          {header('location:login.php');}
//     else
//          {setcookie('admin','admin',time()-1,'','','');}

// parametri dall'url ================================
include_once('request.php');

// setta navigatore iniziale =======================
require_once('set_nav.php');
	
// H E A D E R  =====================================
require_once('moduli/header_a.php');       

//  N A V I G A T O R E   ===========================
echo    "<nav>"; 
if  (TMP::$tmenu == 'admin') {	include('moduli/nav2.php'); }	
echo    "</nav>";   
 
    //  C O R P O   =====================================             
echo "<section id='corpo'>"; 
//$pos = $tmp->col2;  
if ($urla){
          require_once $urla;
          } 
if ($dati){
          require_once('component/content.php');    // componenti
          }       
echo "</section>" ;      //  FINE CORPO
  
//  footer + navigatore   ============================================= 
require_once('moduli/footer.php'); 
                               
ob_end_flush();
echo "</body></html>";        
?>
