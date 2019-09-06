<?php   session_start();      ob_start();   
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.1    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   -------------------------------------------------------------------------
   28/04/2019	tabellato accesso
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

require_once('post_ute.php') ;          
//print_r($_POST);//debug
$azione    =$_POST['submit'];          

// mostra stringa bottoni o chiude
if (!isset($uid) && ($azione != 'nuovo'))
     {  
     $_SESSION['esito'] = 4;
     $loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
     }

switch ($azione)          
{
 //==================================================================================     
 
	case 'nuovo':
      $param = array($SAV.'|nuovo',$RET.'|ritorno');
      $btx   = new bottoni_str_par($UTES.' - '.$INS,'ute','write_ute.php',$param);     
           $btx->btn();
      $db_ute = new DB_ins('ute','uprog');                       
      $nmax = $db_ute->insert();

     echo "<div class='col-md-7'>";        
     echo  "<fieldset>"; 
      $f3 = new input(array($nmax,'uprog',03,'Progressivo','','i'));           
          $f3->field();        
      $ts = new DB_tip_i('stato','ustat','','Stato record','');     
          $ts->select();
      $f4 = new input(array('','username',20,'Utente','','ir'));                
          $f4->field();  
      $f5 = new input(array('','upassword',40,'Password','','pw'));             
          $f5->field();
      $f6  = new DB_tip_i('acc','uaccesso','','Accesso','Livello di accesso alle funzioni 0=minimo, 9=massimo');   
		$f6->select();		  
     $f7 = new input(array('','uiscritto',3,'Nr.utente','','i'));           
          $f7->field();   
     echo "</fieldset>";
     echo "</div>";
     echo "</form>";
      break;
 //==================================================================================     
    
case 'modifica':
     $param = array($SAV.'|modifica',$RET.'|ritorno');
     $btx   = new bottoni_str_par($UTES.' - '.$MOD,'ute','write_ute.php',$param);     
          $btx->btn();
     echo "<div class='col-md-7'>";
     echo  "<fieldset>";    
      
// transazione
     $sql = "SELECT * FROM `".DB::$pref."ute` 
               WHERE `uid` = $uid ";
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction(); 
     foreach($PDO->query($sql) as $row)
     {
      include('fields_ute.php') ;
      $f2 = new input(array($uid,'uid',0,'','','h'));                         
          $f2->field();             
      $f3 = new input(array($uprog,'uprog',03,'Progressivo','','i'));         
          $f3->field();   
      $ts = new DB_tip_i('stato','ustat',$ustat,'Stato record','');
          $ts->select();
      $f4 = new input(array($username,'username',20,'Utente','','i'));        
          $f4->field();  
      $f5 = new input(array($upassword,'upassword',40,'Password','','pw'));    
          $f5->field(); 
      $f6  = new DB_tip_i('acc','uaccesso',$uaccesso,'Accesso','Livello di accesso alle funzioni 0=minimo, 9=massimo');   
		$f6->select();		  
      $f7 = new input(array($uiscritto,'uiscritto',3,'Nr.utente','','i'));        
          $f7->field(); 
     }
     echo "</fieldset>";
     echo "</div>";
     echo "</form>";
      break;
 //==================================================================================     
   
case 'cancella':
     $param = array($SAV.'|cancella',$RET.'|ritorno');
     $btx   = new bottoni_str_par($DELCONF,'ute','write_ute.php',$param);     
          $btx->btn();
     echo "<div class='col-md-7'>";
     echo  "<fieldset>";      
// transazione  
     $sql = "SELECT * FROM `".DB::$pref."ute` 
               WHERE `uid` = $uid ";
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction(); 
     foreach($PDO->query($sql) as $row)
     {
      include('fields_ute.php') ;
      $f2 = new input(array($uid,'uid',0,'','','h'));                        
          $f2->field();
      $f2 = new input(array($uprog,'uprog',03,'Progressivo','','r'));        
          $f2->field();   
      $f3 = new input(array($ustat,'ustat',03,'Stato record','','r'));       
          $f3->field();   
      $f4 = new input(array($username,'username',20,'Utente','','r'));       
          $f4->field();   
      $f5 = new input(array($upassword,'upassword',40,'Password','','pwr'));   
          $f5->field();
      $f6 = new input(array($uaccesso,'uaccesso',1,'Accesso','','r'));       
          $f6->field();
      $f7 = new input(array($uiscritto,'uiscritto',3,'Nr.utente','','r')); 
          $f7->field(); 
     }
     echo "</fieldset>";
     echo "</div>";
     echo "</form>";     
      break;

case 'chiudi' :
     $loc = "location:admin.php?urla=widget.php&pag=";
     header($loc);                           
          break;      

default:  echo "azione errata";
 
}

ob_end_flush();
?> 
