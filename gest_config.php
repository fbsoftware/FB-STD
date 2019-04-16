<?php
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.0   
   * copyright	Copyright (C) 2012 - 2013 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
==============================================================================
   * Gestione "config.ini"
   * Uso di DB_PDO e bootstrap
=============================================================================  */
require_once('loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once('lingua.php');
require_once('connectDB.php');

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];

     echo     "<div class='container well'>";
     echo     "<div class='row space-before space-after'>"; 
     echo     "<div class='col-md-12'>"; 
 //   bottoni gestione
$param  = array('modifica','chiudi');  
$btx    = new bottoni_str_par('Configurazione','config','write_config.php',$param);     
     $btx->btn();
echo "</div>";
echo "</div>";

// dati di configurazione
     echo     "<div class='row  space-before space-after'>";
     echo "<div class='col-md-6'>" ;
     echo "<fieldset><legend>&nbsp;Generali&nbsp;</legend>";
     $f6 = new input(array(DB::$site,'site',20,'Cartella sito','','i'));           
          $f6->field();   
     $f7 = new input(array(DB::$page_title,'page_title',30,'Titolo home page','','ir'));        
          $f7->field();  
     $f8 = new input(array(DB::$root,'root',40,'Root sito','','i'));               
          $f8->field();   
     $f9 = new input(array(DB::$dir_imm,'dir_imm',30,'Path immagini','','ir'));         
          $f9->field();   
     $f0 = new input(array(DB::$author,'author',30,'Autore','','i'));        
          $f0->field();  
     $fb = new input(array(DB::$keywords,'keywords',30,'Keywords','','i'));             
          $fb->field();              
     $fc = new input(array(DB::$sep,'sep',10,'Separatore dei path','','ir'));       
          $fc->field();           
     $fd = new input(array(DB::$incr,'incr',10,'Incremento record DB','','ir'));    
          $fd->field();              
     $fe = new input(array(DB::$e_mail,'e_mail',30,'E-mail del sito','','ir'));         
          $fe->field();              
     $ff = new input(array(DB::$lib,'lib',20,'Libreria classi','','ir'));   
          $ff->field();             
     $fg = new input(array(DB::$url,'url',30,'URL del sito (http://...)','','i')); 
          $fg->field();             
echo "</fieldset>";
echo "</div>";    

// dati del database
echo "<div class='col-md-6'>" ;
echo "<fieldset><legend>&nbsp;Database&nbsp;</legend> ";
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
echo "</div>";
echo "</div>";       // row

echo     "<div class='row  space-before space-after'>";
// dati della versione
echo "<div class='col-md-6'>" ;
echo "<fieldset><legend>&nbsp;Versione&nbsp;</legend> ";
     $f1 = new input(array(DB::$livello, 'livello' ,2,'Livello','','ir'));        
          $f1->field();
     $f0 = new input(array(DB::$rilascio,'rilascio',2,'Rilascio','','ir'));       
          $f0->field();
     $f2 = new input(array(DB::$modifica,'modifica',2,'Modifica','','ir'));       
          $f2->field();  
echo "</fieldset>";
echo "</div>";


echo "</form>";
echo "</div>";       // row
echo "</div>";       // container
?>
