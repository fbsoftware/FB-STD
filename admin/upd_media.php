<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * -------------------------------------------------------------------------
   * Caricamento media   
   *==========================================================================*/
require_once('../loadLibraries.php');
require_once('loadTemplateAdmin.php');
require_once('../lingua.php');

$azione  = $_POST['submit'];
$img_del = $_POST['img_del'];
print_r($_POST);//debug
   
// mappe di gestione
switch ($azione)
{      
     case 'upload':             // scelta img da caricare
	  //   bottoni gestione
		$param = array('upload','chiudi','enctype');		  
        $btc = new bottoni_str_par('Immagini soci','img','write_media.php',$param);
			$btc->btn();
	   echo "<div class='tabella'><fieldset>";
	   echo "<input type='file' name='file' id='file' size='300000'>";
	   echo "</fieldset></div></form>";
          break; 
 
 case 'cancella'   :            // conferma cancellazione
			$param = array('cancella','ritorno');
          $btc = new bottoni_str_par('Immagini - conferma cancellazione','img','write_media.php',$param); 
         $btc->btn();
          echo "<div class='tabella'><fieldset>";
          $path=DB::$dir_imm.$img_del;
          $d = new imgdim($path,400,600);
          $d->maxdim();
          if (($d->height <= 400) && ($d->width <= 600) )
               echo "<img src='$path' width='".$d->width."' alt='x' border='1' />";
          elseif (isset($d->width) && $d->width > 0)   
               echo "<img src='$path' width='".$d->width."' alt='x' border='1' />";
          elseif (isset($d->height) && $d->height > 0)  
               echo "<img src='$path' height='".$d->height."' alt='x' border='1' />";
			   	echo "<br />".$img_del;
          echo "<input type='hidden' name='img_del' value='$img_del' />";          
          echo "</fieldset></form></div>";
          break;
          
     case 'download':
		  $param = array('download','ritorno');
          $btx = new bottoni_str_par('Download Immagini','img','write_media.php',$param);    
          $btx->btn();
                // passa solo i parametri
          echo "<div class='tabella'><fieldset>";
          $path= DB::$dir_imm.$img_del;
          $d = new imgdim($path,400,600);
          $d->maxdim();
          if (($d->height <= 400) && ($d->width <= 600) )
               echo "<img src='$path' width='$d->width' alt='x' border='1' />";
          elseif (isset($d->width) && $d->width > 0)   
               echo "<img src='$path' width='$d->width' alt='x' border='1' />";  
          elseif (isset($d->height) && $d->height > 0)  
               echo "<img src='$path' height='$d->height' alt='x' border='1' />"; 
				echo "<br />".$img_del;
          echo "<input type='hidden' name='img_del' value='$img_del' />"; 
          echo "</fieldset></form></div>";
          break; 
		  
     case 'chiudi' :
	 case 'ritorno' : 
	  header('location:admin.php?urla=widget.php&pag=');
          break; 
		
     default:     
          header('location:admin.php?'.$_SESSION['location'].'');
     	break;

}
?>