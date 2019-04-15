<?php session_start();    ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.0    
   * copyright	Copyright (C) 2012 - 2013 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
=============================================================================
   *   
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
require_once('post_mnu.php'); 

// test scelta effettuata sul pgm chiamante
if (isset($_POST['submit']))    $azione  =$_POST['submit'];
if (($azione == 'modifica' || $azione == 'cancella' ) && $bid == '') {header('location:gest_mnu.php');}

// mostra toolbar o chiude
switch ($azione)
{    
    case 'cancella' :

		  break;  
    case 'chiudi' :
	header('location:index.php?urla=widget.php&pag=');		
	break;      
}
      
switch ($azione)
{
    case '':
    header('location:index.php?urla=widget.php&pag=');
    break;
//==================================================================================     
    case 'nuovo':
	 //   toolbar
	$param  = array('salva|nuovo','ritorno');    
	$btx    = new bottoni_str_par('Menu - inserimento','mnu','write_mnu.php',$param);  
		$btx->btn();
      $mnu = new DB_ins('mnu','bprog');                             
      $xxx = $mnu->insert();     
echo  "<fieldset class='gest'>";
      $f3 = new field($xxx,'bprog',03,'Progressivo');          
		$f3->field_i();      
      $ts = new DB_tip_i('stato','bstat','','Stato record','');        
		$ts->select();
      $f4 = new field('','bmenu',03,'Nome');                    
		$f4->field_i();       
      $tmnu = new DB_tip_i('menu','btipo','','Aspetto','');            
		$tmnu->select();     
      $f5 = new field('','btesto',25,'Titolo');                 
		$f5->field_i();   
      $f6 = new field('','bselect',1,'Selezionato');                
		$f6->field_i();         
echo  "</fieldset>"; 
echo  "</form>";
      break;
//==================================================================================     
    case 'modifica':  // toolbar modifica 
		$param  = array('salva|modifica','ritorno');    
	$btx    = new bottoni_str_par('Menu - modifica','mnu','write_mnu.php',$param);  
		$btx->btn();

	echo  "<fieldset class='gest'>";  
      $sql = "SELECT * FROM `".DB::$pref."mnu` 
			   WHERE `bid` = ".$bid."  ";    
     foreach($PDO->query($sql) as $row)
	 {
      include('fields_mnu.php');
     $f1 = new field($bid,'bid',1,'');                         
		$f1->field_h();     
     $ts = new DB_tip_i('stato','bstat',$bstat,'Stato record','');
		$ts->select();
     $f3 = new field($bprog,'bprog',3,'Progressivo');          
		$f3->field_i();
     $f4 = new field($bmenu,'bmenu',20,'Nome');                
		$f4->field_i();
     $tt = new DB_tip_i('menu','btipo',$btipo,'Tipo menu','');    
		$tt->select();
     $f6 = new field($btesto,'btesto',50,'Titolo');            
		$f6->field_i();
     $f7 = new field($bselect,'bselect',1,'Selezionato');      
		$f7->field_i(); 
	 }
      echo  "</fieldset></form>";
      break;
//==================================================================================     
     
    case 'cancella' :
	// toolbar
	$param  = array('salva|cancella','ritorno');    
	$btx    = new bottoni_str_par('Menu - conferma cancellazione','mnu','write_mnu.php',$param);  
		$btx->btn();

      $sql = "SELECT * FROM `".DB::$pref."mnu` 
				WHERE `bid` = $bid  ";    
	foreach($PDO->query($sql) as $row)
	{
	include('fields_mnu.php'); 
	echo  "<fieldset class='gest'>";
     $f1 = new field($bid,'bid',1,'');                   
		$f1->field_h();     
     $ts = new field($bstat,'bstat',1,'Stato record');   
		$ts->field_r();
     $f3 = new field($bprog,'bprog',3,'Progressivo');    
		$f3->field_r();
     $f4 = new field($bmenu,'bmenu',20,'Nome');          
		$f4->field_r();
     $tt = new field($btipo,'btipo',20,'Stato record'); 
		$tt->field_r();
     $f6 = new field($btesto,'btesto',50,'Titolo');      
		$f6->field_r();
     $f7 = new field($bselect,'bselect',1,'Selezionato');
		$f7->field_r(); 
	}
echo  "</fieldset></form>";
      break;
//==================================================================================     

      default:
              echo "UPD-Operazione invalida: azione=".$azione;    
}
ob_end_flush();

?>

</body>
</html>
