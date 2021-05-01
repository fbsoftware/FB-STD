<?php   session_start();       ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   *-------------------------------------------------------------------------
   * 28/5/2019	aggiunta copia
============================================================================= */
require_once('init_admin.php');
require_once('post_xdb.php');
$azione  =$_POST['submit'];  

// test scelta effettuata sul pgm chiamante
if (($azione == 'modifica' || $azione == 'cancella' || $azione == 'copia') && $xid == '') 
     {
     $_SESSION['esito'] = 4;
     $loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
     }
echo "<body class='admin' data-theme='".TMP::$tcolor."'>";
switch ($azione)
{ // controllo
    case '':
    case 'ritorno' :
		$_SESSION['esito'] = 2;
		$loc = "location:admin.php?".$_SESSION['location']."";
		header($loc);
		break;
//default: ???
// inserimento 
    case 'nuovo':
    $param = array($SAV.'|nuovo',$RET.'|ritorno');
    $btx   = new bottoni_str_par($TIP.' - '.$INS,'xdb','write_xdb.php',$param);     
         $btx->btn();
         
     echo  "<fieldset>";  
      $xdb = new DB_ins('xdb','xprog');                      
      $f1 = new input(array($xdb->insert(),'xprog',3,'Progressivo',' ','i'));     
          $f1->field();
      $ts = new DB_tip_i('stato','xstat','','Stato record',''); 
          $ts->select();
      $f2 = new input(array('','xtipo',5,'Tipo',' ','ia'));                  
          $f2->field(); 
      $f3 = new input(array('','xcod',20,'Codice',' ','i'));                
          $f3->field(); 
      $f4 = new input(array('','xdes',30,'Descrizione',' ','i'));           
          $f4->field();  
     echo  "</fieldset></form>";
      break;
// modifica     
    case 'modifica':
     $param = array($SAV.'|modifica',$RET.'|ritorno');
     $btx   = new bottoni_str_par($TIP.' - '.$MOD,'xdb','write_xdb.php',$param);     
          $btx->btn();

// transazione 
     $sql = "SELECT * FROM `".DB::$pref."xdb` 
			 WHERE `xid` = $xid ";   

     foreach($PDO->query($sql) as $row)
     {
     echo  "<fieldset>";
     require('fields_xdb.php');
      $f0 = new input(array($xid,'xid',0,'','','h'));                        
          $f0->field(); 
      $f1 = new input(array($xprog,'xprog',3,'Progressivo','','i'));         
          $f1->field();       
      $ts = new DB_tip_i('stato','xstat',$xstat,'Stato record',''); 
          $ts->select();
      $f2 = new input(array($xtipo,'xtipo',5,'Tipo','','ir'));                
          $f2->field(); 
      $f3 = new input(array($xcod,'xcod',20,'Codice','','i'));               
          $f3->field();  
      $f4 = new input(array($xdes,'xdes',30,'Descrizione','','i'));          
          $f4->field(); 
	 }
     echo    "</fieldset></form>";     
     break;

// copia	 
    case 'copia':
    $param = array($SAV.'|nuovo',$RET.'|ritorno');
    $btx   = new bottoni_str_par($TIP.' - '.$COPY,'xdb','write_xdb.php',$param);     
         $btx->btn();
// transazione 
     $sql = "SELECT * FROM `".DB::$pref."xdb` 
			 WHERE `xid` = $xid ";   

     foreach($PDO->query($sql) as $row)
     {
     echo  "<fieldset>";
     require('fields_xdb.php');
      $xdb = new DB_ins('xdb','xprog');                      
      $f1 = new input(array($xdb->insert(),'xprog',3,'Progressivo',' ','i'));     
          $f1->field(); 
      $ts = new DB_tip_i('stato','xstat',$xstat,'Stato record',''); 
          $ts->select();
      $f2 = new input(array($xtipo,'xtipo',5,'Tipo','','ir'));                
          $f2->field(); 
      $f3 = new input(array($xcod,'xcod',20,'Codice','','i'));               
          $f3->field();  
      $f4 = new input(array($xdes,'xdes',30,'Descrizione','','i'));          
          $f4->field(); 
	 }
     echo    "</fieldset></form>";              
     break;
	 
// cancellazione    
    case 'cancella' :
          $param  = array($SAV.'|cancella',$RET.'|ritorno');    
          $btx    = new bottoni_str_par($TIP.' - '.$DELCONF,'xdb','write_xdb.php',$param);  
               $btx->btn(); 
      $sql = "SELECT * FROM `".DB::$pref."xdb` 
              WHERE `xid` = $xid  ";    

foreach($PDO->query($sql) as $row)
    {
     require('fields_xdb.php');
     echo  "<fieldset>";
      $f0 = new input(array($xid,'xid',0,'','','h'));                        
          $f0->field(); 
      $f1 = new input(array($xprog,'xprog',3,'Progressivo','','r'));         
          $f1->field();       
      $ts = new input(array($xstat,'xstat',1,'Stato record','','r'));        
          $ts->field();
      $f2 = new input(array($xtipo,'xtipo',5,'Tipo','','r'));                
          $f2->field(); 
      $f3 = new input(array($xcod,'xcod',20,'Codice','','r'));               
          $f3->field();  
      $f4 = new input(array($xdes,'xdes',30,'Descrizione','','r'));          
          $f4->field(); 
      }      
     echo    "</fieldset></form>";
      break;   
 
    default:
  echo "Operazione invalida";    
}
echo "</body>";
ob_end_flush();
?>
