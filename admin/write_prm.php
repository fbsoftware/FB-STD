<?php session_start();
/** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3    
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * aggiornamento tabella 'prm'      
============================================================================= */ 
require_once('init_admin.php');
require_once('post_prm.php');
           
$azione   =    $_POST['submit'];          print_r($_POST);//debug

// test validità codice  
if (($ocod <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          {
          $_SESSION['errore'] = 1;
          $_SESSION['errore0'] = 1;
          }
// test validità descrizione   
if (($odes <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          {
          $_SESSION['errore'] = 1;
          $_SESSION['errore4'] = 1;
          } 

switch ($azione)
{
case 'nuovo':
echo           $sql = "INSERT INTO `".DB::$pref."prm` 
                      (oid,oprog,ostat,otmp,ocod,odes,otit_sn,otit,otext,
				  oimg1,otit1,otext1,olink1,
				  oimg2,otit2,otext2,olink2,
				  oimg3,otit3,otext3,olink3,
				  oimg4,otit4,otext4,olink4,
				  osino1,osino2,osino3,osino4) 
               	VALUES (NULL,$oprog,'$ostat','$otmp','$ocod','$odes','$otit_sn','$otit','$otext',
                                   '$oimg1','$otit1','$otext1','$olink1',
							'$oimg2','$otit2','$otext2','$olink2',
							'$oimg3','$otit3','$otext3','$olink3',
							'$oimg4','$otit4','$otext4','$olink4',
							$osino1,$osino2,$osino3,$osino4)";
                      $PDO->exec($sql);    
                      $PDO->commit();
                      $_SESSION['esito'] = 54;                      
                      break;

case 'modifica':
           $sql = "UPDATE `".DB::$pref."prm` 
                   SET oprog=$oprog,ostat='$ostat',ocod='$ocod',odes='$odes',
                         otmp='$otmp',otit_sn='$otit_sn',otit='$otit',otext='$otext',
					oimg1='$oimg1',oimg2='$oimg2',oimg3='$oimg3',oimg4='$oimg4',
					otit1='$otit1',otit2='$otit2',otit3='$otit3',otit4='$otit4',
                         otext1='$otext1',otext2='$otext2',otext3='$otext3',otext4='$otext4',
					olink1='$olink1',olink2='$olink2',olink3='$olink3',olink4='$olink4',
					osino1=$osino1,osino2=$osino2,osino3=$osino3,osino4=$osino4  
                   WHERE oid= $oid ";
                  $PDO->exec($sql);    
                  $PDO->commit();
                  $_SESSION['esito'] = 55;
                  break;
  
case 'cancella':
            $sql = "DELETE from `".DB::$pref."prm` 
                    WHERE oid= '$oid' ";
                    $PDO->exec($sql);    
                    $PDO->commit();
                    $_SESSION['esito'] = 53;
                    break;
  
case 'ritorno':
               $_SESSION['esito'] = 2;              
               break;
   
default:
  echo "Operazione invalida";
  break;
}
$loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
?> 