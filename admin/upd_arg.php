<?php session_start();     ob_start();   
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * -------------------------------------------
   * gestione tabella argomenti  
	* 1.0.0	nuova head
============================================================================= */
require_once('init_admin.php');
require_once("editor.php");			// scelta editor
require_once('post_arg.php');
$azione   = $_POST['submit'];  
$rtext    = $QUI_TEXT;
// test scelta effettuata sul pgm chiamante
if (($azione == 'modifica' ||$azione == 'cancella') && $rid < 1) 
     {
	  $_SESSION['esito'] = 4;
      header('location:admin.php?'.$_SESSION['location'].'');
     }
echo "<body class='admin' data-theme='".TMP::$tcolor."'>";
// mostra toolbar e form
switch ($azione)
{ 
    case 'nuovo':       // inserimento 
     $bti = new bottoni_str_par($ARGS.' - '.$INS,'arg','write_arg.php',array($SAV.'|nuovo',$RET.'|ritorno'));     
          $bti->btn(); 
		echo  "<fieldset class='f-flex fd-column'>"; 
      $arg = new DB_ins('arg','rprog');                       
          $nr =  $arg->insert();
      $f1 = new input(array($nr,'rprog',3,$PROG,'Per ordinamento','i'));                   
          $f1->field();
      $ts = new DB_tip_i('stato','rstat','',$STREC,'Attivo-sospeso');          
          $ts->select();
      $f2 = new input(array('','rcod',10,$COD,'Codice dell&#39;argomento','ia'));                     
          $f2->field();
      $f3 = new input(array('','rdesc',50,$DESC,'','i'));                   
          $f3->field();
      $sn = new input(array('','rmostra',1,$MOSTRAT,'Mostra testo si-no','sn'));                   
          $sn->field();
      $sn = new input(array('Inserire un testo','rtext',1,'Descrizione dell&#39;argomento','Inserire un testo','tx'));                   
          $sn->field();  
		echo "<script type='text/javascript'>CKEDITOR.replace('rtext');	</script>";
		echo  "</fieldset>";     
		echo  "</form>";
      break;

// modifica     
    case 'modifica':
     $btm = new bottoni_str_par($ARG.' - '.$MOD,'arg','write_arg.php',array($SAV.'|modifica',$RET.'|ritorno'));     
          $btm->btn();
	$sql = "SELECT *
			FROM `".DB::$pref."arg`
			WHERE `rid` = $rid " ;
// transazione    
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction(); 
     foreach($PDO->query($sql) as $row)
     {
      require 'fields_arg.php'; 
		echo  "<fieldset class='f-flex fd-column'>"; 
      $f0 = new input(array($rid,'rid',1,'ID record','','h'));              
          $f0->field();    
      $f1 = new input(array($rprog,'rprog',3,$PROG,'Per ordinamento','i'));        
          $f1->field();
      $ts = new DB_tip_i('stato','rstat',$rstat,$STREC,'Attivo-sospeso');  
          $ts->select();
      $f2 = new input(array(htmlspecialchars($rcod, ENT_QUOTES),'rcod',10,$COD,'Codice dell&#39;argomento','ia'));    
          $f2->field();
      $f3 = new input(array(htmlspecialchars($rdesc, ENT_QUOTES),'rdesc',50,$DESC,'Descrizione dell&#39;argomento','i'));       
          $f3->field();
      $f4 = new input(array($rmostra,'rmostra',1,$MOSTRAT,'SI-NO per mostrare il titolo dell argomento','sn'));        
          $f4->field();
      $f4 = new input(array($rtext,'rtext',30,'Testo','Testo dell\'argomento','tx'));        
          $f4->field();	
		echo "<script type='text/javascript'>CKEDITOR.replace('rtext');	</script>";
		echo  "</fieldset>";     
      echo  "</form>";
      }
break;
 
// cancellazione    
    case 'cancella' :
// toolbar
	$param  = array($DEL.'|cancella',$RET.'|ritorno');    
	$btx    = new bottoni_str_par($ARG.' - '.$DELCONF,'arg','write_arg.php',$param);  
		$btx->btn();
		
    $sql = "SELECT * 
            FROM `".DB::$pref."arg`
            WHERE `rid` = $rid  "; 
// transazione    
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction(); 
     foreach($PDO->query($sql) as $row)
	{
     require('fields_arg.php');
		echo  "<fieldset class='f-flex fd-column'>"; 
		$f0 = new field($rid,'rid',1,'ID record');            
			$f0->field_h();    
		$f1 = new field($rprog,'rprog',3,$PROG);      
			$f1->field_r();
		$ts = new field($rstat,'rstat',1,$STREC);     
			$ts->field_r();
		$f2 = new field(htmlspecialchars($rcod, ENT_QUOTES),'rcod',10,$COD);  
			$f2->field_r();
		$f3 = new field(htmlspecialchars($rdesc, ENT_QUOTES),'rdesc',50,$DESC);     
			$f3->field_r();
		$f4 = new field($rmostra,'rmostra',1,$MOSTRAT);   
			$f4->field_r(); 
		$f4 = new input(array($rtext,'rtext',30,'Testo','Testo dell\'argomento','r'));        
			$f4->field();         
		echo  "</fieldset>";     
		echo    "</form>";

	} 
      break;   
 
    case 'chiudi' :
    {
    header('location:admin.php?urla=widget.php&pag=');
        break;
    } 
   
    default:
  echo $OP_INVAL;    
     }
echo "</body>";
ob_end_flush();
?></html>
