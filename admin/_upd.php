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
$app = new Head('Gestione £titolo');
$app->openHead();
require_once("jquery_link.php");
//require_once("bootstrap_link.php");
require_once("include_head.php");
require_once('lingua.php'); 
$app->closeHead();

require('tinys.php'); 					// se textarea
require_once('post_£tab.php');			// nome tabella

     $azione  =$_POST['submit'];     

if (($azione == 'modifica' ||$azione == 'cancella') && $£id < 1) 
     {
     $_SESSION['esito'] = 4;
     header('location:gest_£tab.php');
     }
     
echo "<section id='upd_£tab' class='container-fluid'>";
    
switch ($azione)    
{ 
 //==================================================================================     
 
// inserimento 
    case 'nuovo':
     $btx = new bottoni_str_par('£titolo','£tab','write_£tab.php',array($SAV.'|nuovo',$RET.'|ritorno'));     
          $btx->btn();
echo	"<fieldset>";          
     $ins = new DB_ins('£tab','£prog');
     $f1 = new input(array($ins->insert(),'£prog',3,$PROG,'Per ordinamento','i'));
          $f1->field();         
     $ts = new DB_tip_i('stato','£stat','',$ST,'Attivo/sospeso'); 
          $ts->select();
	//-----------------------------------------------------------------
     $f3 = new input(array('','ecod',20,'$COD','£tooltip','ia')); 
          $f3->field(); 
     $f4 = new input(array('','edes',20,'$DESC','£tooltip','i'));           
          $f4->field();  
     $f3 = new input(array('','etmp',20,'$TEMP','£tooltip','i')); 
          $f3->field(); 
echo "</fieldset>";
	// per textarea
echo	"<fieldset>";
     $f4 = new input(array('','£text',50,'£label','£tooltip','tx')); 
          $f4->field(); 
echo "</fieldset>";
echo  "</form>";
      break;
 //==================================================================================     
 
// modifica     
    case 'modifica':
     $btx = new bottoni_str_par('£titolo','£tab','write_£tab.php',array($SAV.'|modifica',$RET.'|ritorno'));     
     $btx->btn();
     $sql = "SELECT * FROM `".DB::$pref."£tab` 
               WHERE `£id` = $£id ";
	echo	"<fieldset>"; 
     foreach($PDO->query($sql) as $row)
	require('fields_£tab.php');

     $f1 = new input(array($£id,'£id',0,'','','h'));
          $f1->field();
     $f1 = new input(array($£prog,'£prog',3,$PROG,'Per ordinamento','i'));
          $f1->field();         
     $ts = new DB_tip_i('stato','£stat',$£stat,$ST,'Attivo/sospeso'); 
          $ts->select();
	//-----------------------------------------------------------------
     $f3 = new input(array($£campo,'ecod',20,'£label','£tooltip','ia')); 
          $f3->field(); 
     $f4 = new input(array($£campo,'ecod',20,'£label','£tooltip','i'));           
          $f4->field();  
     $f3 = new input(array($£campo,'ecod',20,'£label','£tooltip','i')); 
          $f3->field(); 		  
	echo "</fieldset>";
	// per textarea
	echo	"<fieldset>"; 
     $f3 = new input(array($£text,'£text',50,'£label','£tooltip','tx')); 
          $f3->field(); 
	echo "</fieldset>";
     echo    "</form>";
     break;
 //==================================================================================     
 
// cancellazione    
    case 'cancella' :
$btg = new bottoni_str_par('£titolo','£tab','write_£tab.php',array($SAV.'|cancella',$RET.'|ritorno'));     
     $btg->btn();
      $sql = "SELECT * FROM `".DB::$pref."£tab` 
               WHERE `£id` = $£id  "; 
	echo	"<fieldset>";  
     foreach($PDO->query($sql) as $row)
	require('fields_£tab.php');
      $f0 = new input(array($£id,'£id',0,'','','h'));                        
	 	$f0->field(); 
      $f1 = new input(array($£prog,'£prog',3,$PROG,'','r'));         
	 	$f1->field();       
      $ts = new input(array($£stat,'£stat',1,$ST,'','r'));        
	 	$ts->field();
	//-----------------------------------------------------------------
     $f3 = new input(array($£campo,'ecod',20,'£label','£tooltip','r')); 
          $f3->field(); 
     $f4 = new input(array($£campo,'ecod',20,'£label','£tooltip','r'));           
          $f4->field();  
     $f3 = new input(array($£campo,'ecod',20,'£label','£tooltip','r')); 
          $f3->field(); 
	 echo "</fieldset>"; 
	// per textarea
	echo	"<fieldset>"; 
     $f3 = new input(array($£text,'£text',50,'£label','£tooltip','tx')); 
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