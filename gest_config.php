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

?>

  <script>
  $( function() {
    $( document ).tooltip({
      position: {
        my: "center bottom-20",
        at: "center top",
        using: function( position, feedback ) {
          $( this ).css( position );
          $( "<div>" )
            .addClass( "arrow" )
            .addClass( feedback.vertical )
            .addClass( feedback.horizontal )
            .appendTo( this );
        }
      }
    });
  } );
  </script>
  <style>
  .ui-tooltip, .arrow:after {
    background: black;
    border: 2px solid white;
  }
  .ui-tooltip {
    padding: 10px 20px;
    color: white;
    border-radius: 20px;
    font: bold 14px "Helvetica Neue", Sans-Serif;
    text-transform: uppercase;
    box-shadow: 0 0 7px black;
  }
  .arrow {
    width: 70px;
    height: 16px;
    overflow: hidden;
    position: absolute;
    left: 50%;
    margin-left: -35px;
    bottom: -16px;
  }
  .arrow.top {
    top: -16px;
    bottom: auto;
  }
  .arrow.left {
    left: 20%;
  }
  .arrow:after {
    content: "";
    position: absolute;
    left: 20px;
    top: -20px;
    width: 25px;
    height: 25px;
    box-shadow: 6px 5px 9px -9px black;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
  }
  .arrow.top:after {
    bottom: -20px;
    top: auto;
  }
  </style>
<?php
  
$app->closeHead();
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
  
     $f7 = new input(array(DB::$page_title,'page_title',40,'Titolo home page','','ir'));        
          $f7->field();  
     $f8 = new input(array(DB::$root,'root',40,'Root sito','','i'));               
          $f8->field();   
     $f6 = new input(array(DB::$site,'site',20,'Cartella sito','','i'));           
          $f6->field(); 		  
     $f9 = new input(array(DB::$dir_imm,'dir_imm',40,'Cartella immagini','','ir'));         
          $f9->field();   
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
     $ff = new input(array(DB::$lib,'lib',20,'Libreria classi','','ir'));   
          $ff->field();             
     $fg = new input(array(DB::$url,'url',40,'URL del sito (http://...)','','i')); 
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
echo "</div>";       // row

// dati della versione
echo "<div class='col-md-6'>" ;
echo "<fieldset><legend>&nbsp;Versione&nbsp;</legend> ";
     $f1 = new input(array(DB::$livello, 'livello' ,2,'Livello','','ir'));        
          $f1->field();
     $f0 = new input(array(DB::$rilascio,'rilascio',2,'Rilascio','','ir'));       
          $f0->field();
     $f2 = new input(array(DB::$modify,'modify',2,'Modifica','','ir'));       
          $f2->field();  
echo "</fieldset>";
echo "</div>";


echo "</form>";
echo "</div>";       // row
echo "</div>";       // container
?>
