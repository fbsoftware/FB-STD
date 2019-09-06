<?php  session_start();   ob_start();
/** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.0    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= 
   * Aggiunto "nhead" per gestire header per ogni voce menu (Max.9).
   * Gestito livello di accesso    
=============================================================================*/
require_once('../loadLibraries.php');
require_once('loadTemplateAdmin.php');

//----------------------------------------------
require_once('post_nav.php');
$azione=$_POST['submit'];
//print_r($_POST);//debug
switch ($azione)
{ 
case 'nuovo':
               $sql = "INSERT INTO `".DB::$pref."nav` 
                      (nid,nprog,nstat,nmenu,nli,ntesto,
                       ndesc,nselect,ntarget,ntipo,npag,nsotvo,nhead,ntitle,naccesso,
					   nmetakey) 
                      VALUES (NULL,'$nprog','$nstat', '$nmenu','$nli','$ntesto', 
                        '$ndesc', '$nselect', '$ntarget', '$ntipo', '$npag',
                         '$nsotvo','$nhead','$ntitle','$naccesso','$nmetakey')";
				$PDO->exec($sql);    
				$PDO->commit(); 
				$_SESSION['esito'] = 54;
				 break;
   
case 'modifica':
     $sql = "UPDATE `".DB::$pref."nav` 
                  SET nprog='$nprog',nstat='$nstat',nmenu='$nmenu',
                      nli='$nli',ntesto='$ntesto' ,ntarget='$ntarget',ndesc='$ndesc' ,
                      nselect='$nselect',npag='$npag',ntipo='$ntipo',nsotvo='$nsotvo',
                      nhead='$nhead',ntitle='$ntitle',naccesso='$naccesso',
					  nmetakey='$nmetakey'
                  WHERE nid='$nid'";
				$PDO->exec($sql);    
				$PDO->commit();
				$_SESSION['esito'] = 55;
                  break;
  
case 'cancella':
     $sql = "DELETE from `".DB::$pref."nav` 
                  WHERE nid='$nid'";
		$PDO->exec($sql);    
		$PDO->commit();
		$_SESSION['esito'] = 53;
		  break;

case 'ritorno':
		$_SESSION['esito'] = 2;
		   break;
			   
default :      $_SESSION['esito'] = 1;
}
	header('location:admin.php?'.$_SESSION['location'].'');
ob_end_flush();
?> 
