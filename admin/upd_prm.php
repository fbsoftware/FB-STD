<?php session_start();      ob_start();  
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------
   * gestione tabella per 4 moduli promo    
	17/8/19	scelta editor
============================================================================= */
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
require_once("editor.php");			// scelta editor
require_once('post_prm.php'); 

?>
 <!-- tabs -->
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>
<?php  
$azione  =$_POST['submit'];     
// print_r($_POST);//debug

if (($azione == 'modifica' ||$azione == 'cancella') && $oid < 1) 
     {
     $_SESSION['esito'] = 4;
     header('location:gest_prm.php');
     }

echo "<section id='upd' class='container-fluid'>";
     
switch ($azione)    
{ 
 //==================================================================================     
 
// inserimento 
    case 'nuovo':
     $btx = new bottoni_str_par('Modulo promo','prm','write_prm.php',array('salva|nuovo','ritorno'));     
          $btx->btn();

?>
	<div id="tabs">
  <ul>
	<li><a href="#tabs-0">Generale</a></li>
    <li><a href="#tabs-1">Promo-1</a></li>
    <li><a href="#tabs-2">Promo-2</a></li>
    <li><a href="#tabs-3">Promo-3</a></li>
	<li><a href="#tabs-4">Promo-4</a></li>
  </ul>
 <?php
	echo "<div id='tabs-0' class='row'>";
	echo "<fieldset>"; 
     $prm = new DB_ins('prm','oprog');
     $f1 = new input(array($prm->insert(),'oprog',3,'Progressivo','Per ordinamento','i'));
          $f1->field();         
     $ts = new DB_tip_i('stato','ostat','','Stato record','Attivo/sospeso'); 
          $ts->select();
      $t = new getTmp('','otmp','Template','Scelta del template che utilizza il promo');
          $t->getTemplate(); 
     $f3 = new input(array('','ocod',20,'Codice','Codice promo','ia')); 
          $f3->field(); 
     $f4 = new input(array('','odes',30,'Descrizione','Descrizione promo','i'));           
          $f4->field(); 
     $f3 = new input(array('','otit_sn',1,'Mostra Titolo','','sn')); 
          $f3->field(); 
	echo "</fieldset>";
	echo "</div>";
     
// primo promo 
	echo "<div id='tabs-1' class='row' >";

	echo	"<fieldset class='col-md-12'>"; 
     $f3 = new input(array('','osino1',1,'Mostra promo 1','','sn')); 
          $f3->field(); 
      $tw = new select_file('images/','','oimg1','Immagine ','Immagine del promo');
          $tw->image(); 
     $f3 = new input(array('','otit1',50,'Titolo','Titolo promo','i')); 
          $f3->field(); 
     $f5 = new input(array('','olink1',50,'Link','Link per il titolo','i')); 
          $f5->field(); 
     $f4 = new input(array('','otext1',50,'Testo','Testo del promo','tx')); 
          $f4->field(); 
if (TMP::$teditor == 'ckeditor') 
	{  echo "<script type='text/javascript'>CKEDITOR.replace('otext1');</script>"; }
	echo "</fieldset>";
	echo "</div>";	
     
// secondo promo
	echo "<div id='tabs-2' class='row' >";
 
	echo	"<fieldset class='col-md-12'>"; 
     $f3 = new input(array('','osino2',1,'Mostra promo 2','','sn')); 
          $f3->field(); 
      $tw = new select_file('images/','','oimg2','Immagine ','Immagine del promo');
          $tw->image(); 
     $f3 = new input(array('','otit2',50,'Titolo','Titolo promo','i')); 
          $f3->field(); 
     $f5 = new input(array('','olink2',50,'Link','Link per il titolo','i')); 
          $f5->field(); 
     $f4 = new input(array('','otext2',50,'Testo','Testo del promo','tx')); 
          $f4->field(); 
if (TMP::$teditor == 'ckeditor') 
	{  echo "<script type='text/javascript'>CKEDITOR.replace('otext2');</script>"; }
	echo "</fieldset>";
	echo "</div>";	

// terzo promo 
	echo "<div id='tabs-3' class='row' >";
	echo	"<fieldset  class='col-md-12'>"; 
     $f3 = new input(array('','osino3',1,'Mostra promo 3','','sn')); 
          $f3->field(); 
      $tw = new select_file('images/','','oimg3','Immagine ','Immagine del promo');
          $tw->image(); 
     $f3 = new input(array('','otit3',50,'Titolo','Titolo promo','i')); 
          $f3->field(); 
     $f5 = new input(array('','olink3',50,'Link','Link per il titolo','i')); 
          $f5->field(); 
     $f4 = new input(array('','otext3',50,'Testo','Testo del promo','tx')); 
          $f4->field(); 
if (TMP::$teditor == 'ckeditor') 
	{  echo "<script type='text/javascript'>CKEDITOR.replace('otext3');</script>"; }
	echo "</fieldset>";
	echo "</div>";	
     
// quarto promo 
	echo "<div id='tabs-4' class='row' >";
	echo	"<fieldset>"; 
     $f3 = new input(array('','osino4',1,'Mostra promo 4','','sn')); 
          $f3->field(); 
      $tw = new select_file('images/','','oimg4','Immagine ','Immagine del promo');
          $tw->image(); 
     $f3 = new input(array('','otit4',50,'Titolo','Titolo promo','i')); 
          $f3->field(); 
     $f5 = new input(array('','olink4',50,'Link','Link per il titolo','i')); 
          $f5->field(); 
     $f4 = new input(array('','otext4',50,'Testo','Testo del promo','tx')); 
          $f4->field(); 
if (TMP::$teditor == 'ckeditor') 
	{  echo "<script type='text/javascript'>CKEDITOR.replace('otext4');</script>"; }
	echo "</fieldset>";
	echo "</div>";	
echo "</div>";	// tabs
echo  "</form>";
      break;
 //==================================================================================     
 
// modifica     
    case 'modifica':
     $btx = new bottoni_str_par('Modulo promo','prm','write_prm.php',array('salva|modifica','ritorno'));     
     $btx->btn();
     $sql = "SELECT * FROM `".DB::$pref."prm` 
               WHERE `oid` = $oid ";
     foreach($PDO->query($sql) as $row)
	require('fields_prm.php');
?>
	<div id="tabs">
  <ul>
	<li><a href="#tabs-0">Generale</a></li>
    <li><a href="#tabs-1">Promo-1</a></li>
    <li><a href="#tabs-2">Promo-2</a></li>
    <li><a href="#tabs-3">Promo-3</a></li>
	<li><a href="#tabs-4">Promo-4</a></li>
  </ul>
 <?php
// generale
	echo "<div id='tabs-0' class='row' >";
	echo	"<fieldset>"; 
     $f1 = new input(array($oid,'oid',0,'','','h'));
          $f1->field();
     $ts = new DB_tip_i('stato','ostat',$ostat,'Stato record','Attivo/sospeso'); 
          $ts->select();
     $f1 = new input(array($oprog,'oprog',3,'Progressivo','Per ordinamento','i'));
          $f1->field();
      $t = new getTmp($otmp,'otmp','Template','Scelta del template che utilizza il promo');
          $t->getTemplate(); 
     $f3 = new input(array($ocod,'ocod',20,'Codice','Codice promo','ia')); 
          $f3->field(); 
     $f4 = new input(array($odes,'odes',30,'Descrizione','Descrizione promo','i'));           
          $f4->field(); 
     $f3 = new input(array($otit_sn,'otit_sn',1,'Mostra titolo','','sn')); 
          $f3->field(); 
	echo "</fieldset>";
	echo "</div>";	
     
// primo promo 
	echo "<div id='tabs-1' class='row' >";
	echo	"<fieldset>"; 
     $f3 = new input(array($osino1,'osino1',1,'Mostra promo 1','','sn')); 
          $f3->field(); 
      $tw = new select_file('images/',$oimg1,'oimg1','Immagine ','Immagine del promo');
          $tw->image(); 
     $f3 = new input(array($otit1,'otit1',50,'Titolo','Titolo promo','i')); 
          $f3->field(); 
     $f5 = new input(array($olink1,'olink1',50,'Link','Link per il titolo','i')); 
          $f5->field(); 
     $f4 = new input(array($otext1,'otext1',50,'Testo','Testo del promo','tx')); 
          $f4->field(); 
if (TMP::$teditor == 'ckeditor') 
	{  echo "<script type='text/javascript'>CKEDITOR.replace('otext1');</script>"; }
	echo "</fieldset>";
	echo "</div>";	
     
// secondo promo 
	echo "<div id='tabs-2' class='row' >";
	echo	"<fieldset>"; 
     $f3 = new input(array($osino2,'osino2',1,'Mostra promo 2','','sn')); 
          $f3->field(); 
      $tw = new select_file('images/',$oimg2,'oimg2','Immagine ','Immagine del promo');
          $tw->image(); 
     $f3 = new input(array($otit2,'otit2',50,'Titolo','Titolo promo','i')); 
          $f3->field(); 
     $f5 = new input(array($olink2,'olink2',50,'Link','Link per il titolo','i')); 
          $f5->field(); 
     $f4 = new input(array($otext2,'otext2',50,'Testo','Testo del promo','tx')); 
          $f4->field(); 
if (TMP::$teditor == 'ckeditor') 
	{  echo "<script type='text/javascript'>CKEDITOR.replace('otext2');</script>"; }
	echo "</fieldset>";
	echo "</div>";	

// terzo promo
	echo "<div id='tabs-3' class='row' >";
	echo	"<fieldset>"; 
     $f3 = new input(array($osino3,'osino3',1,'Mostra promo 3','','sn')); 
          $f3->field(); 
      $tw = new select_file('images/',$oimg3,'oimg3','Immagine ','Immagine del promo');
          $tw->image(); 
     $f3 = new input(array($otit3,'otit3',50,'Titolo','Titolo promo','i')); 
          $f3->field(); 
     $f5 = new input(array($olink3,'olink3',50,'Link','Link per il titolo','i')); 
          $f5->field(); 
     $f4 = new input(array($otext3,'otext3',50,'Testo','Testo del promo','tx')); 
          $f4->field(); 
if (TMP::$teditor == 'ckeditor') 
	{  echo "<script type='text/javascript'>CKEDITOR.replace('otext3');</script>"; }
	echo "</fieldset>";
	echo "</div>";	
     
// quarto promo 
	echo "<div id='tabs-4' class='row' >";
	echo	"<fieldset>"; 
     $f3 = new input(array($osino4,'osino4',1,'Mostra promo 4','','sn')); 
          $f3->field(); 
      $tw = new select_file('images/',$oimg4,'oimg4','Immagine ','Immagine del promo');
          $tw->image(); 
     $f3 = new input(array($otit4,'otit4',50,'Titolo','Titolo promo','i')); 
          $f3->field(); 
     $f5 = new input(array($olink4,'olink4',50,'Link','Link per il titolo','i')); 
          $f5->field(); 
     $f4 = new input(array($otext4,'otext4',50,'Testo','Testo del promo','tx')); 
          $f4->field(); 
if (TMP::$teditor == 'ckeditor') 
	{  echo "<script type='text/javascript'>CKEDITOR.replace('otext4');</script>"; }
	echo "</fieldset>";
	echo "</div>";	
	echo "</div>";	// tabs
     echo    "</form>";
     break;
 //==================================================================================     
 
// cancellazione    
    case 'cancella' :
$btg = new bottoni_str_par('Modulo promo','prm','write_prm.php',array('salva|cancella','ritorno'));     
     $btg->btn();
      $sql = "SELECT * FROM `".DB::$pref."prm` 
               WHERE `oid` = $oid  "; 
	echo	"<fieldset class='col-md-6'>";  
     foreach($PDO->query($sql) as $row)
	require('fields_prm.php');
      $f0 = new input(array($oid,'oid',0,'','','h'));                        
	 	$f0->field(); 
      $f1 = new input(array($oprog,'oprog',3,'Progressivo','','r'));         
	 	$f1->field();       
      $ts = new input(array($ostat,'ostat',1,'Stato record','','r'));        
	 	$ts->field();
      $f2 = new input(array($otmp,'otmp',20,'Template','','r'));                
	 	$f2->field(); 
      $f3 = new input(array($ocod,'ocod',20,'Codice','','r'));               
	 	$f3->field();  
      $f4 = new input(array(htmlspecialchars($odes, ENT_QUOTES),'odes',30,'Descrizione','','r'));          
      	$f4->field();
	 echo "</fieldset>"; 
      echo    "</form>";
      break;
        
    case 'ritorno' :
          $loc = "location:admin.php?".$_SESSION['location']."";
               header($loc);   
    break;
    
     case 'chiudi':
          $loc = "location:admin.php?urla=widget.php&pag=";
               header($loc);                          
          break;

    default:
          echo "Operazione invalida";    
          
    } 

     echo "</section>";
ob_end_flush();
?>