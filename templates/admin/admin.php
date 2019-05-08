<?php
// richiesta login ============================
     if(!isset($_COOKIE['admin']))
          {		header('location:login.php');	}

// setta navigatore iniziale =======================
	require_once('set_nav.php');
	
// H E A D E R  =====================================
	require_once('moduli/header_a.php');       

//  N A V I G A T O R E   ===========================

	echo    "<nav>"; 
	require_once('moduli/nav2.php');  
	echo    "</nav>";   
 
    //  C O R P O   =====================================             
	echo "<section id='corpo'>"; 
if ($urla){
          require_once $urla;
          } 
if ($dati){
          require_once('component/content.php');    // componenti
          }       
	echo "</section>" ;      //  FINE CORPO                               
?>