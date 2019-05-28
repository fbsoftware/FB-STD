<?php session_start();      ob_start();  
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------
   * gestione tabella 'lay'   
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
     
include_once('post_lay.php');
$azione  =$_POST['submit'];      //print_r($_POST);//debug
echo "<section id='upd' class='container-fluid'";

if (($azione == 'modifica' ||$azione == 'cancella') && $lid < 0) 
     {
     $_SESSION['esito'] = 4;
$loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
     }
     
    echo     "<div class='container form-horizontal'>"; 
    echo     "<div class='row container'>";
switch ($azione)    
{ 
// inserimento 
    case 'nuovo':
    $param	= array('salva|nuovo','ritorno') ;
     $btx = new bottoni_str_par($LAY." - ".$NEW,'lay','upd2_lay.php',$param);     
          $btx->btn();
      echo  "<fieldset class='col-md-6'>";          
     $ts = new DB_tip_i('tipo','ltipo','','Tipo modulo','Tipo modulo per comporre la pagina'); 
          $ts->select();
	echo  "</fieldset>";
	echo  "</form>";
      break;
          
// modifica     
    case 'modifica':
$btx      = new bottoni_str_par($LAY." - ".$MOD,'lay','write_lay.php',array('salva|modifica','ritorno'),9);     
     $btx->btn();
     $sql = "SELECT * FROM `".DB::$pref."lay` 
               WHERE `lid` = $lid ";
// transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 
foreach($PDO->query($sql) as $row)
include('fields_lay.php');

echo  "<fieldset class='col-md-6'>";
     $f1 = new input(array($lid,'lid',3,'','','h'));
          $f1->field(); 
     $f1 = new input(array($lprog,'lprog',3,'Progressivo','Per ordinamento','i'));
          $f1->field();         
     $ts = new DB_tip_i('stato','lstat',$lstat,'Stato record','Attivo/sospeso'); 
          $ts->select();
     $t2 = new getTmp($ltmp,'ltmp','Template','Scelta del template');
          $t2->getTemplate(); 
     $ts = new DB_tip_i('tipo','ltipo',$ltipo,'Tipo modulo','Tipo modulo per comporre la pagina'); 
          $ts->select();
// scelta del file in base al tipo di modulo =============================================
switch ($ltipo) {
case 'artslide':
               $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo in slide');
          		$arg->select_label();       
			break;
case 'artacc':
               $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo in accordion');
          		$arg->select_label();       
			break;
case 'arttab':
               $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo in tab');
          		$arg->select_label();       
			break;
case 'article':
               $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo semplice');
          		$arg->select_label();       
			break;
case 'artimg':
               $arg = new DB_sel_l('aim','iprog',$lcod,'icod','lcod','istat','icod','Codice','Articolo con immagine');
          		$arg->select_label();       
			break;
case 'glyph':
               $arg = new DB_sel_l('gly','gprog',$lcod,'gcod','lcod','gstat','gdes','Codice','Modulo con glifi');
          		$arg->select_label();       
			break;
case 'promo':
               $arg = new DB_sel_l('prm','oprog',$lcod,'ocod','lcod','ostat','odes','Codice','Modulo con glifi');
          		$arg->select_label();       
			break;
case 'portfolio':
               $arg = new DB_sel_l('por','pprog',$lcod,'pcod','lcod','pstat','pdes','Codice','Modulo portfolio');
          		$arg->select_label();       
			break;
case 'slide':
               $arg = new DB_sel_l('sld','slprog',$lcod,'slcod','lcod','slstat','sldes','Codice','Modulo slide di immagini');
          		$arg->select_label();       
			break;
case 'header':
     		$f1 = new input(array($lcod,'lcod',30,'Codice','Header con navigatore','i'));
          		$f1->field();         
			break;
case 'footer':
     		$f1 = new input(array($lcod,'lcod',30,'Codice','Footer','i'));
          		$f1->field();         
			break;
default:
	          echo	"Tipo modulo errato";
			break;
}          
// =======================================================================================
     $f4 = new input(array($ldesc,'ldesc',50,'Descrizione','Descrizione modulo','i'));           
          $f4->field();
     $f4 = new input(array($linclude,'linclude',20,'Include','Programma da includere','r'));           
          $f4->field();
     echo    "</fieldset></form>";
     break;

// cancellazione    
    case 'cancella' :
$btx = new bottoni_str_par($LAY." - ".$DEL,'lay','write_lay.php',array('salva|cancella','ritorno'));     
     $btx->btn();
      $sql = "SELECT * FROM `".DB::$pref."lay` 
               WHERE `lid` = $lid  ";    
// transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 
foreach($PDO->query($sql) as $row)
include('fields_lay.php');

echo  "<fieldset class='col-md-6'>";
      $f0 = new input(array($lid,'lid',0,'','','h'));                        
	 	$f0->field(); 
      $f1 = new input(array($lprog,'lprog',3,'Progressivo','','r'));         
	 	$f1->field();       
      $ts = new input(array($lstat,'lstat',1,'Stato record','','r'));        
	 	$ts->field();
      $f2 = new input(array($ltipo,'ltipo',5,'Tipo','','r'));                
	 	$f2->field(); 
      $f3 = new input(array($lcod,'lcod',20,'Codice','','r'));               
	 	$f3->field();  
      $f4 = new input(array(htmlspecialchars($ldesc, ENT_QUOTES),'ldesc',30,'Descrizione','','r'));          
      	$f4->field(); 
      echo    "</fieldset></form>";
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