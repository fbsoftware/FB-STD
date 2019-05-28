<?php session_start();      ob_start();  
/*** ========================================================================
	*   	TEMPLATE PER APP UPD_XXX.PHP
	*========================================================================
   * Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------
   * control di tabella 
   * £tab
   * £titolo
   * £id
   * £prog
   * £stat
   * £cod
   * £des
   * £tmp
============================================================================= */
require_once('loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once("connectDB.php");
// DOCTYPE & head
$app = new Head('Gestione contatti');
$app->openHead();
require_once("jquery_link.php");
require_once("bootstrap_link.php");
require_once("include_head.php");
require_once('lingua.php'); 
$app->closeHead();

include('tinys.php'); 					// se textarea
include_once('post_ctt.php');			// nome tabella

     $azione  =$_POST['submit'];     

if (($azione == 'modifica' ||$azione == 'cancella') && $eid < 1) 
     {
     $_SESSION['esito'] = 4;
     header('location:gest_ctt.php');
     }
     
echo "<section id='upd_ctt' class='container-fluid'>";
    
switch ($azione)    
{ 
 //==================================================================================     
 
// inserimento 
    case 'nuovo':
     $btx = new bottoni_str_par('Contatti','ctt','write_ctt.php',array($SAV.'|nuovo',$RET.'|ritorno'));     
          $btx->btn();
echo "<div class='row'>";
echo	"<fieldset class='col-md-6'>";          
     $ins = new DB_ins('ctt','eprog');
     $f1 = new input(array($ins->insert(),'eprog',3,$PROG,'Per ordinamento','i'));
          $f1->field();         
     $ts = new DB_tip_i('stato','estat','',$ST,'Attivo/sospeso'); 
          $ts->select();
	//-----------------------------------------------------------------
     $f3 = new input(array('','ecod',20,$COD,'','ia')); 
          $f3->field(); 
     $f4 = new input(array('','edes',20,$DESC,'','i'));           
          $f4->field();  
     $t2 = new getTmp('','etmp','Template','Scelta del template');
          $t2->getTemplate(); 
	$f2 = new input(array('','ecat',20,$CAT,'','i'));     
		$f2->field();  
	 $co = new DB_tip_i('tictt','etipo','',$TIPO,'');
		$co->select(); 
$tw = new select_file('images/','','eimg',$IMG,'');
	$tw->image();
	$f2 = new input(array('','email',50,$EMAIL,'','i'));     
		$f2->field();
	$f2 = new input(array('','epec',50,$PEC,'','i'));     
		$f2->field();
	$f2 = new input(array('','esito',50,$SITE,'','i'));     
		$f2->field();
	$f2 = new input(array('','etel',20,$TEL,'','i'));     
		$f2->field();
	$f2 = new input(array('','efax',20,$FAX,'','i'));     
		$f2->field();
	$f2 = new input(array('','ecel',20,$CELL,'','i'));     
		$f2->field();
	$f2 = new input(array('','esede',50,$SEDE,'','i'));     
		$f2->field();
echo "</fieldset>";
	// per textarea
echo	"<fieldset class='col-md-6'>";
     $f4 = new input(array('','enote',50,$NOTE,'','tx')); 
          $f4->field(); 
echo "</fieldset>";
echo "</div>";
echo  "</form>";
      break;
 //==================================================================================     
 
// modifica     
    case 'modifica':
     $btx = new bottoni_str_par('Contatti','ctt','write_ctt.php',array($SAV.'|modifica',$RET.'|ritorno'));     
     $btx->btn();
     $sql = "SELECT * FROM `".DB::$pref."ctt` 
               WHERE `eid` = $eid ";
			   
	echo "<div class='row'>";
	echo "<fieldset class='col-md-7'>"; 
    foreach($PDO->query($sql) as $row)
	include('fields_ctt.php');

     $f1 = new input(array($eid,'eid',0,'','','h'));
          $f1->field();
     $f1 = new input(array($eprog,'eprog',3,$PROG,'Per ordinamento','i'));
          $f1->field();         
     $ts = new DB_tip_i('stato','estat',$estat,$ST,'Attivo/sospeso'); 
          $ts->select();
	//-----------------------------------------------------------------
     $f3 = new input(array($ecod,'ecod',20,$COD,'','ia')); 
          $f3->field(); 
     $f4 = new input(array($edes,'edes',20,$DESC,'','i'));           
          $f4->field();  
     $t2 = new getTmp($etmp,'etmp','Template','Scelta del template');
          $t2->getTemplate(); 
	$f2 = new input(array($ecat,'ecat',20,$CAT,'','i'));     
		$f2->field();  
	 $co = new DB_tip_i('tictt','etipo',$etipo,$TIPO,'');
		$co->select(); 
$tw = new select_file('images/',$eimg,'eimg',$IMG,'');
	$tw->image();
echo "<img src='".$eimg."' alt='' border='0' align='left' width='100' height=''' />";	
	$f2 = new input(array($email,'email',50,$EMAIL,'','i'));     
		$f2->field();
	$f2 = new input(array($epec,'epec',50,$PEC,'','i'));     
		$f2->field();
	$f2 = new input(array($esito,'esito',50,$SITE,'','i'));     
		$f2->field();
	$f2 = new input(array($etel,'etel',20,$TEL,'','i'));     
		$f2->field();
	$f2 = new input(array($efax,'efax',20,$FAX,'','i'));     
		$f2->field();
	$f2 = new input(array($ecel,'ecel',20,$CELL,'','i'));     
		$f2->field();
	$f2 = new input(array($esede,'esede',50,$SEDE,'','i'));     
		$f2->field();
echo "</fieldset>";
	// per textarea
echo	"<fieldset class='col-md-6'>";
     $f4 = new input(array($enote,'enote',50,$NOTE,'','tx')); 
          $f4->field(); 
echo "</fieldset>";
echo "</div>";
     echo    "</form>";
     break;
 //==================================================================================     
 
// cancellazione    
    case 'cancella' :
$btg = new bottoni_str_par('Contatti','ctt','write_ctt.php',array($SAV.'|cancella',$RET.'|ritorno'));     
     $btg->btn();
      $sql = "SELECT * FROM `".DB::$pref."ctt` 
               WHERE `eid` = $eid  "; 
	echo	"<fieldset class='col-md-7'>";  
     foreach($PDO->query($sql) as $row)
	include('fields_ctt.php');
      $f0 = new input(array($eid,'eid',0,'','','h'));                        
	 	$f0->field(); 
      $f1 = new input(array($eprog,'eprog',3,$PROG,'','r'));         
	 	$f1->field();       
      $ts = new input(array($estat,'estat',1,$ST,'','r'));        
	 	$ts->field();
	//-----------------------------------------------------------------
     $f3 = new input(array($ecod,'',20,$COD,'','r')); 
          $f3->field(); 
     $f4 = new input(array($edes,'',20,$DESC,'','r'));           
          $f4->field();  
     $f3 = new input(array($etmp,'',20,$TEMP,'','r')); 
          $f3->field(); 
	 echo "</fieldset>"; 
	// per textarea
	echo	"<fieldset class='col-md-7'>"; 
     $f3 = new input(array($enote,'',50,$NOTE,'','txr')); 
          $f3->field(); 
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