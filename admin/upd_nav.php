<?php  session_start();     ob_start();  
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.0    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================
   * Aggiunto "nhead" per gestire header per ogni voce menu (Max.9).
   * Gestito livello di accesso     
   * 1.0.0	nuova toolbar
============================================================================*/ 
require_once('init_admin.php');
require_once('post_nav.php');
$azione=$_POST['submit'];
      
// test scelta effettuata sul pgm chiamante
if (($azione == 'modifica' || $azione == 'cancella') && $nid == '') 
          {
          $_SESSION['esito'] = 4;
          header('location:admin.php?'.$_SESSION['location'].'');
          }
echo "<body class='admin' data-theme='".TMP::$tcolor."'>";
switch ($azione)
{
//==================================================================================     

case '':
	$_SESSION['esito'] = 4;
	header('location:admin.php?'.$_SESSION['location'].'');
      break;
//==================================================================================    
    case 'ritorno' :
		$_SESSION['esito'] = 2;
		$loc = "location:admin.php?".$_SESSION['location']."";
		header($loc);
		break;
//==================================================================================     

case 'nuovo':    // scelta tipo voce, prosegue su: upd2_nav.php
    { 
	$param  = array($SAV.'|nuovo',$RET.'|ritorno');  
	$btx    = new bottoni_str_par($TIPO_VOCE.' - '.$MENU,'nav','upd2_nav.php',$param);     
		$btx->btn($param);
	echo  "<fieldset >";
	$tmod = new DB_tip_i('voce','ntipo','','Tipo voce','');     
		$tmod->select();
	echo  "</fieldset></form>";  
	break;
     }
//==================================================================================     
     
case 'modifica':
{ 	       
		// toolbar
	$param  = array($SAV.'|modifica',$RET.'|ritorno');    
	$btx    = new bottoni_str_par($VOCI_MENU.' - '.$MOD,'nav','write_nav.php',$param);  
		$btx->btn();
    $sql = "SELECT * 
			 FROM `".DB::$pref."nav` 
			 WHERE `nid` = $nid ";
	foreach($PDO->query($sql) as $row)
	{
      require('fields_nav.php');          
      echo  "<fieldset >";
      $f0  = new input(array($nid,'nid',1,'ID record','','h'));                   
		$f0->field();
		
      $f1  = new input(array($nprog,'nprog',3,'Progressivo','Progressivo di caricamento','i'));           
		$f1->field();
		
		
      $ts  = new DB_tip_i('stato','nstat',$nstat,'Stato record','Record attivo/annullato');   
		$ts->select();
      $mnu = new DB_sel_l('mnu','bprog',$nmenu,'bmenu',
                          'nmenu','bstat','bmenu','Menu','Nome menù');  
		$mnu->select_label();
      $f2 = new input(array($nli,'nli',20,'Voce','Voce di menù','i'));                        
		$f2->field();
      $f4 = new input(array($ndesc,'ndesc',20,'Sottovoce','Sottooce di menù','i'));               
		$f4->field();      
      $f3 = new input(array($ntesto,'ntesto',25,'Descrizione','Descrizione voce di menù','i'));           
		$f3->field();
      $tv = new input(array($ntipo,'ntipo',10,'Tipo voce','Tipo voce di menù','r'));               
		$tv->field();
switch ($ntipo)
{      
case 'arg':
       $t = new DB_sel_l('arg','rdesc',$nsotvo,'rcod','nsotvo','rstat','rdesc','Argomento','Argomento dell\'articolo');
       echo $t->select_label()."<br >"; 
		break;
 
 case 'cap':
       $t = new DB_sel_l('cap','cdesc',$nsotvo,'ccod','nsotvo','cstat','cdesc','Capitolo','Capitolo dell\'articolo');
       echo $t->select_label()."<br >"; 
		break;

case 'art':
       $t = new DB_sel_l('art','atit',$nsotvo,'atit','nsotvo','astat','atit','Articolo','Articolo');
       echo $t->select_label()."<br >"; 
		break;
     
case 'lnk':
       $ty = new input(array($nsotvo,'nsotvo',30,'Link interno','Link interno','i'));    
	   echo $ty->field(); 
		break;
        
case 'ifr':
       $tw = new select_root($nsotvo,'nsotvo','Html/php pers.');
       $tw->select_dir(); 
       echo    "<br />";      
		break;        
       
case 'htm':
       $tx = new input(array($nsotvo,'nsotvo',30,'Pagina HTML custom','Pagina HTML personalizzata','i'));    
	   echo $tx->field(); 
		break;
        
case 'url':
       $tz = new input(array($nsotvo,'nsotvo',30,'Link esterno','Link esterno al programma','i'));    
	   echo $tz->field(); 
		break;
}
      $tg = new DB_tip_i('trg','ntarget',$ntarget,'Target','Target:_blank ...');        
		$tg->select(); 
      $f6 = new input(array($nselect,'nselect',1,'Voce corrente (*)','Voce selezionata','i'));    
		$f6->field(); 
      $f7 = new input(array($ntitle,'ntitle',1,'(1)Titoli, (0)dettaglio','1-Mostra solo i titoli  0-mostra tutto','i'));
		$f7->field();
      $f8 = new input(array($nhead,'nhead',1,'(1)Header specifico','1-esiste un header specifico','i'));      
		$f8->field();
      $fa = new input(array($npag,'npag',1,'Parametro','Parametro opzionale','i'));                  
		$fa->field();
      $tz = new input(array($naccesso,'naccesso',1,'Livello accesso','Livello di accesso utente','i'));    
		$tz->field();
	}

	  $f2 = new input(array($nmetakey,'nmetakey',33,'Meta keywords','Keywords assegnate alla pagina','tx'));     
		$f2->field();     
	echo  "</fieldset>"; 
	echo "</form>";
      break;
}    
//==================================================================================     
       
case 'cancella':
		// toolbar
	$param  = array($SAV.'|cancella',$RET.'|ritorno');    
	$btx    = new bottoni_str_par($VOCI_MENU.' - '.$DELCONF,'nav','write_nav.php',$param);  
		$btx->btn();
    $sql = "SELECT * FROM `".DB::$pref."nav` 
			 WHERE `nid` = $nid ";
    foreach($PDO->query($sql) as $row)
	{
    require('fields_nav.php');  
      echo "<fieldset>";
$f0 = new field($nid,'nid',1,'ID record');                     
	$f0->field_h();
$f1 = new field($nprog,'nprog',3,'Progressivo');               
	$f1->field_r();
$ts = new field($nstat,'nstat',1,'Stato record');              
	$ts->field_r();
$tm = new field($nmenu,'nmenut',20,'Menu');                    
	$tm->field_r();
$f2 = new field($nli,'nli',20,'Voce');                         
	$f2->field_r();
$f4 = new field($ndesc,'ndesc',20,'Sottovoce');                
	$f4->field_r();
$f3 = new field($ntesto,'ntesto',25,'Descrizione');            
	$f3->field_r();
$tv = new field($ntipo,'ntipo',10,'Tipo voce');                
	$tv->field_r();
$f8 = new field($nsotvo,'nsotvo',10,'Comando');                
	$f8->field_r();
$f5 = new field($ntarget,'ntarget',20,'Target');               
	$f5->field_r();
$f6 = new field($nselect,'nselect',1,'Voce corrente (*)');     
	$f6->field_r();
$f7 = new field($ntitle,'ntitle',1,'(1)Titoli, (0)dettaglio'); 
	$f7->field_r();
$f9 = new field($nhead,'nhead',1,'(1)Header specifico');       
	$f9->field_r();
$fk = new field($npag,'npag',1,'Parametro');                   
	$fk->field_r();
$tz = new field($naccesso,'naccesso',1,'Livello accesso');     
	$tz->field_r();
$f2 = new input(array($nmetakey,'nmetakey',33,'Meta keywords','Keywords assegnate alla pagina','txr'));     
	$f2->field();  
      echo  "</fieldset>"; 
	}
      echo  "</form>"; 
      break;
} 
echo "</body>";
ob_end_flush();  
?> 
