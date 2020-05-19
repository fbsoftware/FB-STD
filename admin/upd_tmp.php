<?php session_start();      ob_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * --------------------------------------------
   * gestione tabella template      
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

require('post_tmp.php');
$azione   =$_POST['submit']; 
 
// test scelta effettuata sul pgm chiamante
if (($azione == 'modifica' || $azione == 'cancella') && ($tid < 1)) 
     {
     $_SESSION['esito'] = 4;
$loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
     }

     echo     "<div class='container'>"; 
     echo     "<div class='row col-md-12 container>";      
     echo     "<div class='form-horizontal'>";               

     // transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 


switch ($azione)
{
case 'nuovo':
// toolbar
          $bti = new bottoni_str_par($INS ,'tmp','write_tmp.php',array($SAV.'|nuovo',$RET.'|ritorno'));     
          	$bti->btn();
          
// lato sinistro ===========================================================================
     echo  "<fieldset class='col-md-6'><legend> Dati base </legend>"; 
     $tmp = new DB_ins('tmp','tprog');               
     $a   = new input(array(NULL,'tid',5,'','','h'));
          $a->field();
     $b = new input(array($tmp->insert(),'tprog',5,'Progressivo','Progressivo per ordinamento','i'));
          $b->field();
     $ts = new DB_tip_i('stato','tstat','','Stato record','A = sospeso');  
          $ts->select();
     $c = new input(array('','tcod',20,'Codice','Codice del template','i'));
          $c->field();
     $c = new input(array('','tsel',1,'Selezionato','* = selezionato','i'));
          $c->field();
     $ts = new DB_tip_i('ttmp','ttipo','','Tipo template','');  
          $ts->select();
     $e = new input(array('','tfolder',50,'Cartella template','Percorso cartella template','i'));
          $e->field();
     $f = new input(array(htmlspecialchars('', ENT_QUOTES),'tdesc',50,'Descrizione','','i'));
          $f->field();
      $arg = new DB_sel_l('mnu','bprog','','bmenu','tmenu','bstat','bmenu','Menu principale','');
          $arg->select_label();
     $tz = new DB_tip_i('lin','tlang','','Lingua','Lingua per traduzione label');        
          $tz->select(); 
      $tz = new DB_tip_i('color','tcolor','','Colore base','Colore di base di pulsanti,glifi,barre ecc.');        
          $tz->select(); 
echo "</fieldset>"; 
// lato destro ===========================================================================
     
// slide     
     echo  "<fieldset><legend> Slide </legend>";
     $tz = new DB_tip_i('s-n','tslidebutt',0,'Bottoni si-no','Visualizza o meno i bottoni di navigazione');        
          $tz->select(); 
     $input = new input(array(0,'tslidetime',5,'Durata','Durata in millisec','i'));
          $input->field();
     echo "</fieldset>";	 
// promo     
     echo  "<fieldset><legend> Moduli promo </legend>";
     $tz = new DB_tip_i('s-n','tpromotitle',0,'Mostra titolo','Visualizza o meno il titolo del modulo promo');        
          $tz->select(); 
     $input    = new input(array('','tpromotit',50,'Titolo','Titolo della sezione dei promo','i'));
          $input->field();
     $input    = new input(array('','tpromotext',50,'Testo','Testo della sezione dei promo','tx'));
          $input->field();
     echo "</fieldset>";

     
// accordion
     echo  "<fieldset><legend> Accordion </legend>";
     $tz = new DB_tip_i('s-n','taccotitle',0,'Mostra titolo','Visualizza o meno il titolo del modulo promo');        
          $tz->select(); 
     $input    = new input(array('','taccotit',50,'Titolo','Titolo della sezione dei promo','i'));
          $input->field();
     $input    = new input(array('','taccotext',50,'Testo','Testo della sezione dei promo','tx'));
          $input->field();
	echo "</fieldset>";

// portfolio     
     echo  "<fieldset><legend> Portfolio </legend>";
     $tz = new DB_tip_i('s-n','tportitle',0,'Mostra titolo','Visualizza o meno il titolo');        
          $tz->select(); 
     $input    = new input(array('','tportit',50,'Titolo','Titolo della sezione portfolio','i'));
          $input->field();
     $input    = new input(array('','tportext',50,'Testo','Testo della sezione portfolio','tx'));
          $input->field();     
     echo "</fieldset>";
// contatti     
     echo  "<fieldset><legend> Contatti </legend>";
     $tz = new DB_tip_i('s-n','tcttitle',0,'Mostra titolo','Visualizza o meno il titolo');        
          $tz->select(); 
     $input    = new input(array('','tcttit',50,'Titolo','Titolo della sezione contatti','i'));
          $input->field();
     $input    = new input(array('','tcttext',50,'Testo','Testo della sezione contatti','tx'));
          $input->field();     
     echo "</fieldset>";  
// articoli in tab     
     echo  "<fieldset><legend> Articoli in tab </legend>";
     $tz = new DB_tip_i('s-n','ttabtitle',0,'Mostra titolo','Visualizza o meno il titolo');        
          $tz->select(); 
     $input    = new input(array('','ttabtit',50,'Titolo','Titolo della sezione slide','i'));
          $input->field();
     $input    = new input(array('','ttabtext',50,'Testo','Testo della sezione slide','tx'));
          $input->field();     
     echo "</fieldset>";  	
// articoli in slide    
     echo  "<fieldset><legend> Articoli in slide </legend>";
     $tz = new DB_tip_i('s-n','tsldtitle',0,'Mostra titolo','Visualizza o meno il titolo');        
          $tz->select(); 
     $input    = new input(array('','tsldtit',50,'Titolo','Titolo della sezione contatti','i'));
          $input->field();
     $input    = new input(array('','tsldtext',50,'Testo','Testo della sezione contatti','tx'));
          $input->field();     
     echo "</fieldset>"; 	 
// glifi     
     echo  "<fieldset><legend> Glyph </legend>";
    
     $tz = new DB_tip_i('s-n','tgliftitle',0,'Mostra titolo','Visualizza o meno il titolo');        
          $tz->select(); 
	$input = new input(array('','tgliftit',50,'Titolo','Titolo sezione dei glifi','i'));     
     $input->field();   
     $input    = new input(array('','tgliftext',50,'Testo','Testo sezione dei glifi','tx'));
          $input->field();
      $tz = new DB_tip_i('forma','tgliforma','','Forma glifo','Forma tonda o quadrata');        
          $tz->select(); 
     $tz = new DB_tip_i('s-n','tglireverse',0,'In reverse si-no','Mostra il glifo in reverse');        
          $tz->select(); 
     echo "</fieldset>";
     echo  "</div>";
     echo  "</form>";
        break;
 //==================================================================================     

 case 'modifica':
          $btm = new bottoni_str_par($TEMPLATES.' - '.$MOD ,'tmp','write_tmp.php',array($SAV.'|modifica',$RET.'|ritorno'));     
               $btm->btn();

     echo  "<fieldset class='col-md-6'><legend> Dati base </legend>";      
    $sql = "SELECT * FROM `".DB::$pref."tmp` where `tid` = $tid ";
     foreach($PDO->query($sql) as $row)
     {    
     require_once('fields_tmp.php');
     $a    = new input(array($tid,'tid',5,'','','h'));
          $a->field();
     $b    = new input(array($tprog,'tprog',5,'Progressivo','Progressivo per ordinamento','i'));
          $b->field();
     $ts = new DB_tip_i('stato','tstat',$tstat,'Stato record','A = sospeso');  
          $ts->select();
     $c = new input(array($tcod,'tcod',20,'Codice','Codice del template','i'));
          $c->field();
     $c    = new input(array($tsel,'tsel',1,'Selezionato','* = selezionato','i'));
          $c->field();
     $ts = new DB_tip_i('ttmp','ttipo',$ttipo,'Tipo template','');  
          $ts->select();
     $a    = new input(array($tfolder,'tfolder',50,'Cartella template','Percorso cartella template','i'));
          $a->field();
     $a    = new input(array(htmlspecialchars($tdesc, ENT_QUOTES),'tdesc',50,'Descrizione','Descrizione del template','i'));
          $a->field();
      $arg = new DB_sel_l('mnu','bprog',$tmenu,'bmenu','tmenu','bstat','bmenu','Menu principale','Nome del menu principale');
          $arg->select_label();
     $tz = new DB_tip_i('lin','tlang',$tlang,'Lingua','Lingua per traduzione label');        
          $tz->select(); 
      $tz = new DB_tip_i('color','tcolor',$tcolor,'Colore base','Colore di base del template');        
          $tz->select(); 
	echo "</fieldset>"; 
	echo  "</div>";    // col

 //=== lato destro =====================================================================     
     echo "<div class='col-md-6'>";     
     
// slide     
     echo  "<fieldset><legend> Slide </legend>";
     $tz = new DB_tip_i('s-n','tslidebutt',$tslidebutt,'Bottoni si-no','Visualizza o meno i bottoni di navigazione');        
          $tz->select(); 
     $param    =array($tslidetime,'tslidetime',5,'Durata','Durata in millisec','i');
     $input    = new input($param);
          $input->field();
     echo  "</fieldset>";
// promo     
     echo  "<fieldset><legend> Moduli promo </legend>";
     $tz = new DB_tip_i('s-n','tpromotitle',$tpromotitle,'Mostra titolo','Visualizza o meno il titolo del modulo promo');        
          $tz->select(); 
     $input    = new input(array($tpromotit,'tpromotit',50,'Titolo','Titolo della sezione dei promo','i'));
          $input->field();
     $input    = new input(array($tpromotext,'tpromotext',50,'Testo','Testo della sezione dei promo','tx'));
          $input->field();
     echo "</fieldset>";
   
// accordion   
     echo  "<fieldset><legend> Accordion </legend>";
     $tz = new DB_tip_i('s-n','taccotitle',$taccotitle,'Mostra titolo','Visualizza o meno il titolo');        
          $tz->select(); 
     $input    = new input(array($taccotit,'taccotit',50,'Titolo','Titolo della sezione accordion','i'));
          $input->field();
     $input    = new input(array($taccotext,'taccotext',50,'Testo','Testo della sezione accordion','tx'));
          $input->field();  	 
     echo  "</fieldset>";     

// portfolio     
     echo  "<fieldset><legend> Portfolio </legend>";
     $tz = new DB_tip_i('s-n','tportitle',$tportitle,'Mostra titolo','Visualizza o meno il titolo');        
          $tz->select(); 
     $input    = new input(array($tportit,'tportit',50,'Titolo','Titolo della sezione portfolio','i'));
          $input->field();
     $input    = new input(array($tportext,'tportext',50,'Testo','Testo della sezione portfolio','tx'));
          $input->field();   		  
		  
     echo  "</fieldset>";
// contatti     
     echo  "<fieldset><legend> Contatti </legend>";
     $tz = new DB_tip_i('s-n','tcttitle',$tcttitle,'Mostra titolo','Visualizza o meno il titolo');        
          $tz->select(); 
     $input    = new input(array($tcttit,'tcttit',50,'Titolo','Titolo della sezione contatti','i'));
          $input->field();
     $input    = new input(array($tcttext,'tcttext',50,'Testo','Testo della sezione contatti','tx'));
          $input->field();     
     echo "</fieldset>";  
// articoli in tab     
     echo  "<fieldset><legend> Articoli in tab </legend>";
     $tz = new DB_tip_i('s-n','ttabtitle',$ttabtitle,'Mostra titolo','Visualizza o meno il titolo');        
          $tz->select(); 
     $input    = new input(array($ttabtit,'ttabtit',50,'Titolo','Titolo della sezione contatti','i'));
          $input->field();
     $input    = new input(array($ttabtext,'ttabtext',50,'Testo','Testo della sezione contatti','tx'));
          $input->field();     
     echo "</fieldset>"; 
// articoli in slide     
     echo  "<fieldset><legend> Articoli in slide </legend>";
     $tz = new DB_tip_i('s-n','tsldtitle',$tsldtitle,'Mostra titolo','Visualizza o meno il titolo');        
          $tz->select(); 
     $input    = new input(array($tsldtit,'tsldtit',50,'Titolo','Titolo della sezione contatti','i'));
          $input->field();
     $input    = new input(array($tsldtext,'tsldtext',50,'Testo','Testo della sezione contatti','tx'));
          $input->field();     
     echo "</fieldset>"; 	 
// glifi     
     echo  "<fieldset><legend> Glyph </legend>";
     $tz = new DB_tip_i('s-n','tgliftitle',$tgliftitle,'Mostra titolo','Visualizza o meno il titolo');        
          $tz->select(); 
	$input = new input(array($tgliftit,'tgliftit',50,'Titolo','Titolo sezione dei glifi','i'));     
		$input->field();     
     $input    = new input(array($tgliftext,'tgliftext',50,'Testo','Testo sezione dei glifi','tx'));
          $input->field();
     $tz = new DB_tip_i('forma','tgliforma',$tgliforma,'Forma glifo','Forma tonda o quadrata');        
          $tz->select(); 
     $tz = new DB_tip_i('s-n','tglireverse',$tglireverse,'In reverse si-no','Mostra il glifo in reverse');        
          $tz->select(); 
     echo  "</fieldset>";
	 
     echo  "</div>";    // col
     echo  "</form>";
          }
break;
    
    case 'cancella' :
          $param    = array($SAV.'|cancella',$RET.'|ritorno');
          $btc = new bottoni_str_par($TEMPLATES.' - '.$DELCONF ,'tmp','write_tmp.php',$param); 
          $btc->btn();

     $sql = "SELECT * FROM `".DB::$pref."tmp` where `tid` = $tid ";
          foreach($PDO->query($sql) as $row)
          {    
          require_once('fields_tmp.php');
     echo "<div class='row'>";
     echo  "<fieldset class='col-md-6'>";  
          $f0 = new input(array($tid,'tid',1,'','','h'));                 
               $f0->field();
          $f1 = new input(array($tprog,'tprog',2,'Progressivo','','r'));       
               $f1->field();  
          $fs = new input(array($tstat,'tstat',1,'Stato record','','r'));       
               $fs->field(); 
          $f2 = new input(array($tcod,'tcod',20,'Codice','','r'));         
               $f2->field();  
          $f2 = new input(array($tsel,'tsel',1,'*=selezionato','','r'));         
               $f2->field();  
          $f4 = new input(array(htmlspecialchars($tmenu, ENT_QUOTES),'tmenu',50,'Menu principale','','r'));                        
               $f4->field();  
          $f5 = new input(array($tfolder,'tfolder',50,'Percorso cartella','','r'));  
               $f5->field();  
          $f6 = new input(array(htmlspecialchars($tdesc, ENT_QUOTES),'tdesc',50,'Descrizione','','r'));      
               $f6->field(); 
          $fk = new input(array($tlang,'tlang',3,'Lingua','','r'));                    
               $fk->field();
          echo  "</fieldset>";
		  echo "</div>";
          echo  "</form>";
          }
    break;
           
case 'ritorno' :            
          $loc = "location:admin.php?".$_SESSION['location']."";
               header($loc);  
          break;    
           
case 'chiudi' :            
          $loc = "location:admin.php?urla=widget.php&pag=";
               header($loc);                          
          break;    
          
}
     echo "</div></div></div>";
ob_end_flush();
?>
