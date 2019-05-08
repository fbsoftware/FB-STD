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

include('post_tmp.php');
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
          $bti = new bottoni_str_par($INS ,'tmp','write_tmp.php',array('salva|nuovo','ritorno'));     
          	$bti->btn();
          
     echo "<div class='row'>";
// lato sinistro ===========================================================================
     echo "<div class='col-md-6'>";
     echo  "<fieldset>"; 
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
echo "</fieldset>"; 
     
// promo     
     echo  "<fieldset><legend> Moduli promo </legend>";
     $tz = new DB_tip_i('s-n','tpromotitle',0,'Titolo si-no','Visualizza o meno il titolo del modulo promo');        
          $tz->select(); 
     $input    = new input(array('','tpromotit',50,'Titolo promo','Titolo della sezione dei promo','i'));
          $input->field();
     $input    = new input(array('','tpromotext',50,'Testo promo','Testo della sezione dei promo','tx'));
          $input->field();
     echo "</fieldset>";
     echo  "</div>";
     
// lato destro ===========================================================================
// colore
     echo  "<fieldset><legend> Colore di base </legend>";
      $tz = new DB_tip_i('color','tcolor','','Colore base','Colore di base di pulsanti,glifi,barre ecc.');        
          $tz->select(); 
	echo "</fieldset>";
     
// slide     
     echo  "<fieldset><legend> Slide </legend>";
     $tz = new DB_tip_i('s-n','tslidebutt',0,'Bottoni si-no','Visualizza o meno i bottoni di navigazione');        
          $tz->select(); 
     $input = new input(array(0,'tslidetime',5,'Durata','Durata della slide in millisec','i'));
          $input->field();
     echo "</fieldset>";
     
// portfolio     
     echo  "<fieldset><legend> Portfolio </legend>";
     $tz = new DB_tip_i('s-n','tportitle',0,'Titolo si-no','Visualizza o meno il titolo');        
          $tz->select(); 
     echo "</fieldset>";
     
// glifi     
     echo  "<fieldset><legend> Glyph </legend>";
     $input    = new input(array('','tgliftitle',50,'Titolo sezione','Titolo sezione dei glifi','i'));
          $input->field();
     $input    = new input(array('','tgliftext',50,'Testo sezione','Testo sezione dei glifi','tx'));
          $input->field();
      $tz = new DB_tip_i('forma','tglyforma','','Forma glifo','Forma tonda o quadrata');        
          $tz->select(); 
     $tz = new DB_tip_i('s-n','tglyreverse',0,'In reverse si-no','Mostra il glifo in reverse');        
          $tz->select(); 
     echo "</fieldset>";
     echo  "</div>";
     echo  "</div>";    // row
     echo  "</form>";
        break;
 //==================================================================================     

 case 'modifica':
          $btm = new bottoni_str_par($TEMPLATES.' - '.$MOD ,'tmp','write_tmp.php',array('salva|modifica','ritorno'));     
               $btm->btn();

     echo "<div class='row'>";
     echo  "<fieldset class='col-md-6'>";      
    $sql = "SELECT * FROM `".DB::$pref."tmp` where `tid` = $tid ";
     foreach($PDO->query($sql) as $row)
     {    
     include_once('fields_tmp.php');
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
echo "</fieldset>"; 
// promo     
     echo  "<fieldset><legend> Moduli promo </legend>";
     $tz = new DB_tip_i('s-n','tpromotitle',$tpromotitle,'Titolo si-no','Visualizza o meno il titolo del modulo promo');        
          $tz->select(); 
     $input    = new input(array($tpromotit,'tpromotit',50,'Titolo promo','Titolo della sezione dei promo','i'));
          $input->field();
     $input    = new input(array($tpromotext,'tpromotext',50,'Testo promo','Testo della sezione dei promo','tx'));
          $input->field();
     echo "</fieldset>";
 //==================================================================================     
   
     echo "<div class='col-md-6'>";     
// colore   
     echo  "<fieldset><legend> Colore di base </legend>";
      $tz = new DB_tip_i('color','tcolor',$tcolor,'Colore base','Colore di base di pulsanti,glifi,barre ecc.');        
          $tz->select(); 
     echo  "</fieldset>";     
     

// slide     
     echo  "<fieldset><legend> Slide </legend>";
     $tz = new DB_tip_i('s-n','tslidebutt',$tslidebutt,'Bottoni si-no','Visualizza o meno i bottoni di navigazione');        
          $tz->select(); 
     $param    =array($tslidetime,'tslidetime',5,'Durata','Durata della slide in millisec','i');
     $input    = new input($param);
          $input->field();
     echo  "</fieldset>";
// portfolio     
     echo  "<fieldset><legend> Portfolio </legend>";
     $tz = new DB_tip_i('s-n','tportitle',$tportitle,'Titolo si-no','Visualizza o meno il titolo');        
          $tz->select(); 
     echo  "</fieldset>";
     
// glifi     
     echo  "<fieldset><legend> Glyph </legend>";
     $input    = new input(array($tgliftitle,'tgliftitle',50,'Titolo sezione','Titolo sezione dei glifi','i'));
          $input->field();
     $input    = new input(array($tgliftext,'tgliftext',50,'Testo sezione','Testo sezione dei glifi','tx'));
          $input->field();
     $tz = new DB_tip_i('forma','tglyforma',$tglyforma,'Forma glifo','Forma tonda o quadrata');        
          $tz->select(); 
     $tz = new DB_tip_i('s-n','tglyreverse',$tglyreverse,'In reverse si-no','Mostra il glifo in reverse');        
          $tz->select(); 
     echo  "</fieldset>";
     echo  "</div>";    // col
     echo  "</div>";    // row
     echo  "</form>";
          }
break;
    
    case 'cancella' :
          $param    = array('salva|cancella','ritorno');
          $btc = new bottoni_str_par($TEMPLATES.' - '.$DEL ,'tmp','write_tmp.php',$param); 
          $btc->btn();

     $sql = "SELECT * FROM `".DB::$pref."tmp` where `tid` = $tid ";
          foreach($PDO->query($sql) as $row)
          {    
          include_once('fields_tmp.php');
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
