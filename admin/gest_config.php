<?php
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.0   
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
==============================================================================
   * Gestione "config.ini"
   * Uso di DB_PDO e bootstrap
=============================================================================  */
require_once('../loadLibraries.php');
require_once('loadTemplateAdmin.php');
$app = new Head('Gestione menu');
$app->openHead();
require_once("../jquery_link.php");
require_once("../bootstrap_link.php");
require_once("../include_head.php");
require_once('../lingua.php'); 
$app->closeHead();
//----------------------------------------------
?>

  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>  


<?php
  
// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

?>

<?php 

 //   bottoni gestione
$param  = array('modifica','chiudi');  
$btx    = new bottoni_str_par('Configurazione','config','write_config.php',$param);     
     $btx->btn();

?>
	<div id="tabs">
  <ul>
	<li><a href="#tabs-0">Generale</a></li>
    <li><a href="#tabs-1">Database</a></li>
    <li><a href="#tabs-2">Versione</a></li>
  </ul>
 <?php

// dati di configurazione
     echo "<div id='tabs-0' class='row'>";
     echo "<fieldset>";
     $f8 = new input(array(DB::$root,'root',40,'Root sito','','i'));               
          $f8->field();   
     $f6 = new input(array(DB::$site,'site',20,'Cartella sito','','i'));           
          $f6->field(); 		  
     $f9 = new input(array(DB::$dir_imm,'dir_imm',40,'Cartella immagini','','ir'));         
          $f9->field(); 
     $ff = new input(array(DB::$lib,'lib',20,'Libreria classi','','ir'));   
          $ff->field(); 		  
     $f7 = new input(array(DB::$page_title,'page_title',40,'Titolo home page','','ir'));        
          $f7->field();  		  
     $f0 = new input(array(DB::$author,'author',40,'Autore','','i'));        
          $f0->field();  
     $fb = new input(array(DB::$keywords,'keywords',40,'Keywords','','i'));             
          $fb->field();              
     $fc = new input(array(DB::$sep,'sep',10,'Separatore dei path','','ir'));       
          $fc->field();           
     $fd = new input(array(DB::$incr,'incr',10,'Incremento record DB','Incremento fra i progressivi di caricamento record.','ir'));    
          $fd->field();              
     $fe = new input(array(DB::$e_mail,'e_mail',30,'E-mail del sito','','ir'));         
          $fe->field();              
     $fg = new input(array(DB::$url,'url',40,'URL del sito (http://...)','','i')); 
          $fg->field();             
echo "</fieldset>";
echo "</div>";    

// dati del database
     echo "<div id='tabs-1' class='row'>";
     echo "<fieldset>";
     $f1 = new input(array(DB::$host,'host',30,'Host','','ir'));         
          $f1->field();   
     $f2 = new input(array(DB::$user,'user',20,'Utente','','ir'));        
          $f2->field();  
     $f3 = new input(array(DB::$pw,'pw',20,'Password','','pw'));          
          $f3->field(); 
     $f4 = new input(array(DB::$db,'db',20,'Database','','ir'));          
          $f4->field();  
     $f5 = new input(array(DB::$pref,'pref',10,'Prefisso','','i'));      
          $f5->field();  
echo "</fieldset>";
echo "</div>";       // row

// dati della versione
     echo "<div id='tabs-2' class='row'>";
     echo "<fieldset>";
     $f1 = new input(array(DB::$livello, 'livello' ,2,'Livello','','ir'));        
          $f1->field();
     $f0 = new input(array(DB::$rilascio,'rilascio',2,'Rilascio','','ir'));       
          $f0->field();
     $f2 = new input(array(DB::$modify,'modify',2,'Modifica','','ir'));       
          $f2->field();  
echo "</fieldset>";
echo "</div>";

echo "</div>";       // tabs
echo "</form>";
?>