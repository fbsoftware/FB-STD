<?php  session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * Caricamento/cancellazione immagini - esecuzione     
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
//----------------------------------------------
//print_r($_POST);//debug
echo " ";
$azione  = $_POST['submit'];
$img_del = $_POST['img_del'];

// mostra stringa bottoni o chiude
switch ($azione)
{   
		  
     case 'chiudi' :
			$_SESSION['esito'] = 2; 
          break; 
    
	 case 'cancella':
          unlink($img_del);
          $_SESSION['esito'] = 56;
     	break;
          
     case 'upload':
          if ($_FILES['file']['error'] > 0)
          {
          echo "ERRORE! Return Code: " . $_FILES['file']['error'] . "<br />";
          $_SESSION['esito'] = 0;
          break;
          }
          else    
          {   
          $temp = "temp/";
          move_uploaded_file($_FILES['file']['tmp_name'],'images/'. $_FILES['file']['name']);
          $_SESSION['esito'] = 57;
          break;
          }
		  
     case 'download':
			echo "<form id='down' method='post' action='download.php'>
			<input type='hidden' name='img_del' id='img_del' value='".$img_del."'/>
			<input type='submit' value='Conferma download' />
			</form>";
			$_SESSION['esito'] = 58;
     	     break;
			   
	default	:
		echo "Azione non prevista=".$azione;
		  break;

}
//         header('location:admin.php?'.$_SESSION['location'].'');
		 
?>