<?php session_start();      ob_start();  
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------
   * gestione componente articolo con immagine      
============================================================================= */
require_once('loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once("connectDB.php");
// DOCTYPE & head
$app = new Head('Gestione menu');
$app->openHead();
require_once("jquery_link.php");
require_once("bootstrap_link.php");
require_once("include_head.php");
require_once('lingua.php'); 
$app->closeHead();

include_once('post_aim.php');
$azione  =$_POST['submit'];     //print_r($_POST);//debug

// test scelta effettuata sul pgm chiamante
if (($azione == 'modifica' || $azione == 'cancella') && $iid < 1) 
     {
     $_SESSION['esito'] = 4;
     $loc = "location:index.php?".$_SESSION['location']."";
          header($loc);
     }
 
echo "<section id='upd' class='container-fluid'";

switch ($azione)    
{ 
// inserimento 
    case 'nuovo':
     $param    = array('salva|nuovo','ritorno');
     $btx      = new bottoni_str_par($AIM,'aim','write_aim.php',$param);     
     $btx->btn();

     echo  "<fieldset class='col-md-6'>";  
      $xdb = new DB_ins('aim','iprog');                      
      $f1 = new input(array($xdb->insert(),'iprog',3,'Progressivo','Per ordinamento','i'));         
           $f1->field();     
      $ts = new DB_tip_i('stato','istat','','Stato record','Attivo-sospeso'); 
          $ts->select();
      $t = new getTmp('','itmp','Template','Scelta del template');
          $t->getTemplate(); 
      $f3 = new input(array('','icod',20,'Codice','Codice del componente','ia'));                
          $f3->field(); 
      $f4 = new input(array('','ides',30,'Descrizione','Descrizione del componente','i'));           
          $f4->field(); 
      $f  = new DB_tip_i('imgvd','itipo','','Tipo','Tipo immagine:img-video');
          $f->select();          
      $f4 = new input(array('','ivideo',11,'ID video','Codice video YouTube','i'));
          $f4->field();  
      $f4 =    new DB_sel_lt('art','aprog','','atit','atit','astat','atit','Articolo','Titolo articolo da usare.');
          $f4->select_lt();    
      $f  = new DB_tip_i('col','iartcol','','Colonna testo','Ampiezza della colonna per articolo');
          $f->select();
      $tw = new select_file('images/','','iimg','Immagine ','Path immagine articolo');
          $tw->image(); 
      $f4 = new input(array('','iimgtit',20,'Titolo immagine','Titolo della immagine','i'));
          $f4->field(); 
      $f  = new DB_tip_i('col','iimgcol','','Colonna immagine','Ampiezza della colonna per immagine');
          $f->select();
      $f  = new DB_tip_i('posim','iimgpos','','Posizione immagine','Posizione immagine destra-sinistra');
          $f->select();

echo  "</fieldset></form>";
      break;

// modifica     
    case 'modifica':
     $param    = array('salva|modifica','ritorno');
     $btx      = new bottoni_str_par($AIM,'aim','write_aim.php',$param);     
     $btx->btn();
 
    $sql = "SELECT * FROM `".DB::$pref."aim` 
    			WHERE `iid` = $iid ";
// transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 
foreach($PDO->query($sql) as $row)
include('fields_aim.php');

echo  "<fieldset class='col-md-6'>";
      $f4 = new input(array($iid,'iid',5,'','','h'));
          $f4->field(); 
      $f1 = new input(array($iprog,'iprog',3,'Progressivo','Progressivo per ordinamento','i'));         
          $f1->field();       
      $ts = new DB_tip_i('stato','istat',$istat,'Stato record','Attivo-sospeso'); 
          $ts->select();
      $t  = new getTmp($itmp,'itmp','Template','Scelta del template');
          $t->getTemplate(); 
      $f3 = new input(array($icod,'icod',20,'Codice','Codice del componente articolo con immagine','ia'));               
          $f3->field();  
      $f4 = new input(array(htmlspecialchars($ides, ENT_QUOTES),'ides',30,'Descrizione','Descrizione del componente','i'));          
          $f4->field(); 
      $f  = new DB_tip_i('imgvd','itipo',$itipo,'Tipo','Tipo immagine:img-video');
          $f->select();          
      $f4 = new input(array($ivideo,'ivideo',11,'ID video','Codice video YouTube','i'));
          $f4->field();  
      $f4 =    new DB_sel_lt('art','aprog',$iart,'atit','iart','astat','atit','Articolo','Titolo articolo da usare.');
          $f4->select_lt();    
      $f  = new DB_tip_i('col','iartcol',$iartcol,'Colonna testo','Ampiezza della colonna per articolo');
          $f->select();
      $tw = new select_file('images/',$iimg,'iimg','Immagine ','Path immagine articolo');
          $tw->image(); 
      $f4 = new input(array($iimgtit,'iimgtit',20,'Titolo immagine','Titolo della immagine','i'));
          $f4->field(); 
      $f  = new DB_tip_i('col','iimgcol',$iimgcol,'Colonna immagine','Ampiezza della colonna per immagine');
          $f->select();
      $f  = new DB_tip_i('posim','iimgpos',$iimgpos,'Posizione immagine','Posizione immagine destra-sinistra');
          $f->select();

echo    "</fieldset></form>";
break;
 
// cancellazione    
    case 'cancella' :
     $param    = array('salva|cancella','ritorno');
     $btx      = new bottoni_str_par($AIM,'aim','write_aim.php',$param);     
     $btx->btn();
 
      $sql = "SELECT * FROM `".DB::$pref."aim` 
               WHERE `iid` = $iid  ";    
// transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 
foreach($PDO->query($sql) as $row)
	{
	include('fields_aim.php');
echo  "<fieldset class='col-md-6'>";
      $f0 = new input(array($iid,'iid',0,'','','h'));                        
	 	$f0->field(); 
      $f1 = new input(array($iprog,'iprog',3,'Progressivo','','r'));         
	 	$f1->field();       
      $ts = new input(array($istat,'istat',1,'Stato record','','r'));        
	 	$ts->field();
      $f2 = new input(array($itipo,'itipo',5,'Tipo','','r'));                
	 	$f2->field(); 
      $f3 = new input(array($icod,'icod',20,'Codice','','r'));               
	 	$f3->field();  
      $f4 = new input(array(htmlspecialchars($ides, ENT_QUOTES),'ides',30,'Descrizione','','r'));          
      	$f4->field(); 
     }
echo    "</fieldset></form>";
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