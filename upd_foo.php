
<?php session_start();      ob_start();  
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------
   * control di tabella 
============================================================================= */
$_SESSION['ambito']='sito';				// altrimenti:'admin'
require_once('loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once("connectDB.php");
// DOCTYPE & head
$app = new Head('Gestione glifi');
$app->openHead();
require_once("jquery_link.php");
require_once("bootstrap_link.php");
require_once("include_head.php");
require_once('lingua.php'); 
$app->closeHead();

include('tinys.php'); 					// se textarea
include_once('post_foo.php');			// nome tabella

     $azione  =$_POST['submit'];     

if (($azione == 'modifica' ||$azione == 'cancella') && $fid < 1) 
     {
     $_SESSION['esito'] = 4;
     header('location:gest_foo.php');
     }
     
echo "<section id='upd' class='container-fluid'>";
    
switch ($azione)    
{ 
 //==================================================================================     

case 'nuovo':    // scelta tipo footer, prosegue su: upd2_foo.php
    { 
	$param  = array('salva|nuovo','ritorno');  
	$btx    = new bottoni_str_par('Scelta tipo footer','foo','upd2_foo.php',$param);     
		$btx->btn($param);
	echo  "<fieldset >";
	$tmod = new DB_tip_i('tifoo','ftipo','','Tipo footer','');     
		$tmod->select();
	echo  "</fieldset></form>";  
	break;
     }

// modifica     
    case 'modifica':
     $btx = new bottoni_str_par('Modifica Footer di pagina','foo','write_foo.php',array('salva|modifica','ritorno'));     
     $btx->btn();
     $sql = "SELECT * FROM `".DB::$pref."foo` 
               WHERE `fid` = $fid ";
	echo	"<fieldset class='col-md-7'>"; 
     foreach($PDO->query($sql) as $row)
	include('fields_foo.php');

     $f1 = new input(array($fid,'fid',0,'','','h'));
          $f1->field();
     $f1 = new input(array($fprog,'fprog',3,'Progressivo','Per ordinamento','i'));
          $f1->field();         
     $ts = new DB_tip_i('stato','fstat',$fstat,'Stato record','Attivo/sospeso'); 
          $ts->select();
	//-----------------------------------------------------------------
     $f3 = new input(array($fcod,'fcod',20,'Codice','£tooltip','ia')); 
          $f3->field(); 
     $f4 = new input(array($fdes,'fdes',20,'Descrizione','£tooltip','i'));           
          $f4->field();  
     $ti = new input(array($ftitolo,'ftitolo',20,'Titolo','£tooltip','i')); 
          $ti->field();		  
	 $te = new getTmp($ftmp,'ftmp','Template','Template che visualizza il footer');
		$te->getTemplate();
	 $co = new DB_tip_i('col','fcol',$fcol,'Colonna','Ampiezza della colonna');
		$co->select();
	 $ca = new DB_tip_i('tifoo','ftipo',$ftipo,'Tipo','Tipo elemento di footer');
		$ca->select(); //==================================================================================     
switch ($ftipo)	
	{
case 'img' :
      $tw = new select_file('images/',$felemento,'felemento','Immagine ','Path immagine');
          $tw->image();
		 break;
case 'cnt' : 
      $f4 =    new DB_sel_lt('ctt','eprog',$felemento,'ecod','felemento','estat','edes','Contatto','Scegliere il contatto da mostrare');
          $f4->select_lt();
		 break;
	}	
//==================================================================================     
  
     $f3 = new input(array($flink,'flink',20,'Link','Link se cliccato','i')); 
          $f3->field(); 		  
	echo "</fieldset>";
	// per textarea
	echo	"<fieldset class='col-md-7'>"; 
     $f3 = new input(array($ftext,'ftext',50,'Testo','£tooltip','tx')); 
          $f3->field(); 
	echo "</fieldset>";
     echo    "</form>";
     break;
 //==================================================================================     
 
// cancellazione    
    case 'cancella' :
$btg = new bottoni_str_par('Cancella Footer di pagina','foo','write_foo.php',array('salva|cancella','ritorno'));     
     $btg->btn();
      $sql = "SELECT * FROM `".DB::$pref."foo` 
               WHERE `fid` = $fid  "; 
	echo	"<fieldset class='col-md-7'>";  
     foreach($PDO->query($sql) as $row)
	include('fields_foo.php');
      $f0 = new input(array($fid,'fid',0,'','','h'));                        
	 	$f0->field(); 
      $f1 = new input(array($fprog,'fprog',3,'Progressivo','','r'));         
	 	$f1->field();       
      $ts = new input(array($fstat,'fstat',1,'Stato record','','r'));        
	 	$ts->field();
	//-----------------------------------------------------------------
     $f3 = new input(array($fcod,'fcod',20,'Codice','£tooltip','r')); 
          $f3->field(); 
     $f4 = new input(array($fdes,'fdes',20,'Descrizione','£tooltip','r'));           
          $f4->field();  
     $f3 = new input(array($ftipo,'ftipo',20,'Tipo','£tooltip','r')); 
          $f3->field(); 
	 echo "</fieldset>"; 
	// per textarea
	echo	"<fieldset class='col-md-7'>"; 
     $f3 = new input(array($ftext,'ftext',50,'Testo','£tooltip','tx')); 
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