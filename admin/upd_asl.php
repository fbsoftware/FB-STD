<?php session_start();      ob_start();  
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------
   * gestione componente articoli slide-tab-normali-singoli     
============================================================================= */
require_once('../loadLibraries.php');
require_once('loadTemplateAdmin.php');
$app = new Head('Gestione menu');
$app->openHead();
require_once("../jquery_link.php");
//require_once("../bootstrap_link.php");
require_once("../include_head.php");
require_once('../lingua.php'); 
$app->closeHead();
//----------------------------------------------require_once('post_asl.php');
require_once('post_asl.php');
$azione  =$_POST['submit'];    // print_r($_POST);//debug

// test scelta effettuata sul pgm chiamante
if (($azione == 'modifica' ||  $azione == 'cancella') && $did < 1) 
     {
     $_SESSION['esito'] = 4;
          header('location:admin.php?'.$_SESSION['location'].'');
     }
 
echo "<section id='upd' class='container-fluid'>";

switch ($azione)    
{ 
// inserimento 
    case 'nuovo':

     $btx      = new bottoni_str_par('Articoli normali-slide-tab','asl','write_asl.php',array('salva|nuovo','ritorno'));     
     $btx->btn();
    echo	"<fieldset class='f-flex fd-column'>";
      $xdb = new DB_ins('asl','dprog');                      
           $nr=$xdb->insert();
      $f1 = new input(array($xdb->insert(),'dprog',3,'Progressivo','Per ordinamento','i'));         
           $f1->field();     
      $ts = new DB_tip_i('stato','dstat','','Stato record','Attivo-sospeso'); 
          $ts->select();
      $t = new getTmp('','dtmp','Template','Scelta del template');
          $t->getTemplate(); 
      $f1 = new input(array('','dcod',20,'Codice','Codice modulo','ia'));         
           $f1->field();     
      $f1 = new input(array('','ddes',50,'Descrizione','Descrizione modulo','i'));         
           $f1->field();     
      $ts = new DB_tip_i('tipo','dtipo','','Tipo modulo','Tipo modulo: slide o tab'); 
          $ts->select();
      $f4 =    new DB_sel_lt('cap','cprog','','ccod','dcap','cstat','cdesc','Capitolo','Capitolo di cui usare gli articoli.');
          $f4->select_lt();    
      $ts = new DB_tip_i('col','dcol','','Colonna','Ampiezza della colonna'); 
          $ts->select();
      $f4 = new DB_sel_lt('art','aprog','','atit','dart','astat','atit','Articolo','Articolo da mostrare.');
          $f4->select_lt();
	echo	"</fieldset>";    
     echo  "</form>";
      break;

// modifica     
    case 'modifica':
     $btx = new bottoni_str_par('Articoli normali-slide-tab','asl','write_asl.php',array('salva|modifica','ritorno'));     
          $btx->btn();
echo	"<fieldset class='f-flex fd-column'>"; 
    $sql = "SELECT * FROM `".DB::$pref."asl` 
    			WHERE `did` = $did ";
     // transazione    
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction(); 
     foreach($PDO->query($sql) as $row)
     { 
     require('fields_asl.php');
 //   print_r($row);//debug
      $f4 = new input(array($did,'did',5,'','','h'));
          $f4->field(); 
      $f1 = new input(array($dprog,'dprog',3,'Progressivo','Per ordinamento','i'));         
           $f1->field();     
      $ts = new DB_tip_i('stato','dstat',$dstat,'Stato record','Attivo-sospeso'); 
          $ts->select();
      $t = new getTmp($dtmp,'dtmp','Template','Scelta del template');
          $t->getTemplate(); 
      $f1 = new input(array($dcod,'dcod',20,'Codice','Codice modulo','ia'));         
           $f1->field();     
      $f1 = new input(array($ddes,'ddes',50,'Descrizione','Descrizione modulo','i'));         
           $f1->field();     
      $ts = new DB_tip_i('tipo','dtipo',$dtipo,'Tipo modulo','Tipo modulo: slide o tab'); 
          $ts->select();
      $f4 =    new DB_sel_lt('cap','cprog',$dcap,'ccod','dcap','cstat','cdesc','Capitolo','Capitolo di cui usare gli articoli.');
          $f4->select_lt();    
      $ts = new DB_tip_i('col','dcol',$dcol,'Colonna','Ampiezza della colonna'); 
          $ts->select();
      $f4 = new DB_sel_lt('art','aprog',$dart,'atit','dart','astat','atit','Articolo','Articolo da mostrare.');
          $f4->select_lt();
	echo	"</fieldset>";   
echo    "</form>";
     }
break;
 
// cancellazione    
    case 'cancella' :
     $btx      = new bottoni_str_par('Articoli normali-slide-tab','asl','write_asl.php',array('salva|cancella','ritorno'));     
     $btx->btn();
echo	"<fieldset class='f-flex fd-column'>"; 
      $sql = "SELECT * FROM `".DB::$pref."asl` 
                           WHERE `did` = $did  ";    
     // transazione    
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction(); 
     foreach($PDO->query($sql) as $row)
	require('fields_asl.php');
     {
      $f0 = new input(array($did,'did',0,'','','h'));                        
	 	$f0->field(); 
      $f1 = new input(array($dprog,'dprog',3,'Progressivo','','r'));         
	 	$f1->field();       
      $ts = new input(array($dstat,'dstat',1,'Stato record','','r'));        
	 	$ts->field();
      $f2 = new input(array($dtipo,'dtipo',5,'Tipo modulo','','r'));                
	 	$f2->field(); 
      $f3 = new input(array($dcod,'dcod',20,'Codice','','r'));               
	 	$f3->field();  
      $f4 = new input(array(htmlspecialchars($ddes, ENT_QUOTES),'ddes',30,'Descrizione','','r'));          
      	$f4->field();
     } 
     echo	"</fieldset>";
     echo    "</form>";
      break;  
      
    case 'ritorno' :
          header('location:admin.php?'.$_SESSION['location'].'');  
    break; 
         
     case 'chiudi':
          header('location:admin.php?urla=widget.php&pag=');                        
     break;
 
    default:
  echo "Operazione invalida";    
     }
     echo "</section>";
ob_end_flush();  
?>

