<?php session_start();      ob_start();   
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.2.0
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   *-------------------------------------------------------------------------
   * gestione descrizionbi in lingua
============================================================================= */
require_once('loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once("connectDB.php");
// DOCTYPE & head
$app = new Head('Gestione menu');
$app->openHead();
require_once("include_head.php");
require_once("jquery_link.php");
require_once("bootstrap_link.php");
require_once('lingua.php'); 
$app->closeHead();

include_once 'post_lang.php';           
//print_r($_POST);//debug
 
     // contenitore
     echo     "<div class='container form-horizontal'>"; 
     echo     "<div class='row container'>";

switch ($azione)
{
//==================================================================================     

    case 'nuovo':    // inserimento

          $param    = array('salva|nuovo','ritorno');     
          $bti      = new bottoni_str_par($LANG." - ".$INS,'lang','write_lang.php',$param);
               $bti->btn();  
          echo  "<fieldset class='col-md-7'>"; 
          $f4 = new input(array('','voce',30,'Descrizione','Descrizione da tradurre','ia'));          
          $f4->field();
// lettura directory language
          $n=0;
          $dir = "language/*.*";
foreach (glob($dir) as $key => $gx)
     {
          $array_file[$key] = $gx;
          $lin = explode('/',$gx);
          $naz = array_pop($lin);
          $sect = substr($naz,0,2);
          $fx = new input(array('',$sect,30,"Traduzione per:  <strong>".$sect." </strong>",'Traduzione il lingua','i'));
          $fx->field();
          $n++ ;
     }
     echo  "</form>";  
     echo  "</fieldset>";      
     break;

//==================================================================================     

case 'modifica':        // modifica

          $param    = array('salva|modifica','ritorno');     
          $bti      = new bottoni_str_par($LANG." - ".$MOD,'lang','write_lang.php',$param);
          $bti->btn();  

if ($chiave == '')
     {
     $_SESSION['esito'] = 4;
     $loc = "location:index.php?".$_SESSION['location']."";
     header($loc);
     }
     $options=array('autoSave'=>true, 'readOnly'=>false);
     echo  "<fieldset class='col-md-7'>"; 
      $f4 = new input(array($_POST['chiave'],'voce',30,'Descrizione','Descrizione da tradurre','ia'));       
          $f4->field();
          
// lettura directory language
          $n=0;
foreach (glob('language/*.*') as $key => $gx)
     {

     $array_file[$key] = $gx;
     $lin = explode('/',$gx);
     $naz = array_pop($lin);
     $sect = substr($naz,0,2);
     $arr = parse_ini_file ( "language/".$naz , true ); // apro il file
     $file = new FileIni("language/".$naz, $options);
     $value = $file->getValue($sect,$_POST['chiave']);    // leggo il valore
     $fx = new input(array($value,$sect,30,"Traduzione per:  <strong>".$sect." </strong>",'Traduzione in '.$sect.'','i'));
          $fx->field();
     $n++ ;
     }
     echo  "</form>";  
     echo  "</fieldset>";     
     break;
//==================================================================================     
         
// cancellazione    
    case 'cancella' :
          $param    = array('salva|cancella','ritorno');     
          $bti      = new bottoni_str_par($LANG." - ".$MOD,'lang','write_lang.php',$param);
          $bti->btn();  

if ($chiave == '')
     {
     $_SESSION['esito'] = 4;
     $loc = "location:index.php?".$_SESSION['location']."";
     header($loc);
     }
     $options=array('autoSave'=>true, 'readOnly'=>false);
      echo  "<fieldset class='col-md-7'>"; 
      $f4 = new input(array($_POST['chiave'],'voce',30,'Descrizione','Descrizione da tradurre','ia'));
          $f4->field();
// lettura directory language
          $n=0;
foreach (glob('language/*.*') as $key => $gx)
     {
     $array_file[$key] = $gx;
     $lin = explode('/',$gx);
     $naz = array_pop($lin);
     $sect = substr($naz,0,2);
     $arr = parse_ini_file ( "language/".$naz , true ); // apro il file
     $file = new FileIni("language/".$naz, $options);
     $value = $file->getValue($sect,$_POST['chiave']);    // leggo il valore
     $fx = new input(array($value,$sect,30,"Traduzione per:  <strong> ".$sect." </strong>",'Traduzione in '.$sect.'','i'));
          $fx->field();
     $n++ ;
     }
     echo  "</form>";  
     echo  "</fieldset>"; 
     break;
 
    case 'chiudi' :
     header('location:index.php?urla=widget.php&pag=');                        
     break;
 
    default:

}
     echo "</div>";
     echo "</div>";
ob_end_flush();
?>