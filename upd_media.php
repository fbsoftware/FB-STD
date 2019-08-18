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
//----------------------------------------------
$azione  = $_POST['submit'];
$img_del = $_POST['img_del'];
//print_r($_POST);//debug
  
switch ($azione)
{     
     case 'upload':             // scelta img da caricare
			$param = array('enctype','Upload|upload',$CLO.'|chiudi');
				$btc = new bottoni_str_par('Media - Upload Immagini','img','write_media.php',$param);
			$btc->btn();
			echo "<div'><fieldset>";
			echo "<input type='file' name='file' id='file' size='300000'>";
			echo "</fieldset>";
			echo "</div>";
			echo "</form>";
          break;

      case 'chiudi' :
          break; 
	 
     case 'cancella'   :            // conferma cancellazione
          echo "<div>";
			$param = array('cancella',$CLO.'|chiudi');
			$btc = new bottoni_str_par('Media - conferma cancellazione','img','write_media.php',$param);
				$btc->btn();		  
		  echo "<fieldset>";
		  // visualizza immagine
          $path=$img_del;
          $d = new imgdim($img_del,400,600);
          $d->maxdim();
          if (($d->height <= 400) && ($d->width <= 600) )
               echo "<img src='$path' width='".$d->width."' alt='x' border='1' />";
          elseif (isset($d->width) && $d->width > 0)   
               echo "<img src='$path' width='".$d->width."' alt='x' border='1' />";
          elseif (isset($d->height) && $d->height > 0)  
               echo "<img src='$path' height='".$d->height."' alt='x' border='1' />";
			// -------------------
          echo "<input type='hidden' name='img_del' value='$img_del' />";          
          echo "</fieldset>";
		  echo "</form>";
		  echo "</div>";
          break;
          
     case 'download':
		  // toolbar
		$param  = array('enctype','download',$CLO.'|chiudi');    
		$btx    = new bottoni_str_par('Download media','img','download.php',$param);  
			$btx->btn();
		  echo "<fieldset>";
          $path= $img_del;
          $d = new imgdim($img_del,400,600);
          $d->maxdim();
          if (($d->height <= 400) && ($d->width <= 600) )
               echo "<img src='$path' width='$d->width' alt='x' border='1' />";
          elseif (isset($d->width) && $d->width > 0)   
               echo "<img src='$path' width='$d->width' alt='x' border='1' />";  
          elseif (isset($d->height) && $d->height > 0)  
				echo "<img src='$path' height='$d->height' alt='x' border='1' />";
			// -----------------	
			echo "<input type='hidden' name='img_del' value='$img_del' />"; 
			echo "</fieldset>";
			echo "</form>";
          break; 
     default;     
}

?>