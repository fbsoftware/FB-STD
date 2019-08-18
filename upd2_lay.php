<?php  session_start();    ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.0    
   * copyright	Copyright (C) 2012 - 2013 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * Layout del sito
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

include('post_lay.php');
$azione=$_POST['submit'];
   
// mostra stringa bottoni
switch ($azione)
{    
case 'ritorno':
     $loc = "location:admin.php?".$_SESSION['location']."";
     header($loc); 
     break;     
      
case 'nuovo': 
	$param = array('nuovo','ritorno');
	$btx   = new bottoni_str_par('Layout sito','nav','write_lay.php',$param);     
     $btx->btn();
      echo  "<fieldset class='col-md-6'>";  
     $xdb = new DB_ins('lay','lprog');
     $f1 = new input(array($xdb->insert(),'lprog',3,'Progressivo','Per ordinamento','i'));
          $f1->field();         
     $ts = new DB_tip_i('stato','lstat','','Stato record','Attivo/sospeso'); 
          $ts->select();
      $t = new getTmp('','ltmp','Template','Scelta del template');
          $t->getTemplate(); 
     $f3 = new input(array($ltipo,'ltipo',30,'Tipo','Tipo modulo per comporre la pagina','r')); 
          $f3->field(); 
// scelta del file in base al tipo di modulo =============================================		
switch ($ltipo) {
case 'artslide':
               $arg = new DB_sel_l('asl','dprog','','dcod','lcod','dstat','dcod','Codice','Articolo in slide');
          		$arg->select_label(); 
               $f4 = new input(array('artslide.php','linclude',50,'Programma','Programma da includere','r')); 
          		$f4->field();    
			break;
case 'arttab':
               $arg = new DB_sel_l('asl','dprog','','dcod','lcod','dstat','dcod','Codice','Articolo in tab');
          		$arg->select_label();       
               $f4 = new input(array('arttab.php','linclude',50,'Programma','Programma da includere','r'));    
          		$f4->field();    
			break;
case 'artacc':
               $arg = new DB_sel_l('asl','dprog','','dcod','lcod','dstat','dcod','Codice','Articolo in accordion');
          		$arg->select_label();       
               $f4 = new input(array('artacc.php','linclude',50,'Programma','Programma da includere','r'));   
          		$f4->field();    
			break;
case 'artsingle':
case 'article':
               $arg = new DB_sel_l('asl','dprog','','dcod','lcod','dstat','dcod','Codice','Articolo semplice');
          		$arg->select_label();       
               $f4 = new input(array('artsingle.php','linclude',50,'Programma','Programma da includere','r'));           
          		$f4->field();    
			break;
case 'artimg':
               $arg = new DB_sel_l('aim','iprog','','icod','lcod','istat','icod','Codice','Articolo con immagine');
          		$arg->select_label();       
               $f4 = new input(array('artimg.php','linclude',50,'Programma','Programma da includere','r'));           
          		$f4->field();    
			break;
case 'glyph':
               $arg = new DB_sel_l('gly','gprog','','gcod','lcod','gstat','gcod','Codice','Modulo con glifi');
          		$arg->select_label();       
               $f4 = new input(array('glyph.php','linclude',50,'Programma','Programma da includere','r'));           
          		$f4->field();    
			break;
case 'promo':
               $arg = new DB_sel_l('prm','oprog','','ocod','lcod','ostat','ocod','Codice','Modulo promo');
          		$arg->select_label();       
               $f4 = new input(array('promo.php','linclude',50,'Programma','Programma da includere','r'));           
          		$f4->field();    
			break;
case 'portfolio':
               $arg = new DB_sel_l('por','pprog','','pcod','lcod','pstat','pcod','Codice','Modulo portfolio');
          		$arg->select_label();       
               $f4 = new input(array('portfolio.php','linclude',50,'Programma','Programma da includere','r'));           
          		$f4->field();    
			break;
case 'slide':
               $arg = new DB_sel_l('sld','slprog','','slcod','lcod','slstat','slcod','Codice','Modulo slide di immagini');
          		$arg->select_label();       
               $f4 = new input(array('slide.php','linclude',50,'Programma','Programma da includere','r'));           
          		$f4->field();    
			break;
case 'header':
     		$f1 = new input(array('','lcod',30,'Codice','Header con navigatore','i'));
          		$f1->field();         
               $f4 = new input(array('header.php','linclude',50,'Programma','Programma da includere','r'));           
          		$f4->field();    
               break;
case 'footer':
               $arg = new DB_sel_l('foo','fprog','','fcod','lcod','fstat','fcod','Codice','Modulo footer');
          		$arg->select_label();       
               $f4 = new input(array('footer.php','linclude',50,'Programma','Programma da includere','r'));           
          		$f4->field();    
               break;
case 'contatti':
 //    		$f1 = new input(array('','lcod',30,'Codice','Contatti','i'));
  //        		$f1->field(); 
               $arg = new DB_sel_l('ctt','eprog','','ecod','lcod','estat','ecod','Codice','Modulo contatti');
          		$arg->select_label();       
				
               $f4 = new input(array('contatti.php','linclude',50,'Programma','Programma da includere','r'));           
          		$f4->field();    
               break;
default:
	          echo	"Tipo modulo errato=".$ltipo;
	break;
}          
// =======================================================================================
     $f4 = new input(array('','ldesc',50,'Descrizione','Descrizione modulo','i'));           
          $f4->field(); 
	echo  "</fieldset>";
	echo  "</form>";
	}
	?>