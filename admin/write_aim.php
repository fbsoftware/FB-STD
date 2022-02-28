<?php session_start();
/** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * aggiornamento tabella 'aim' articolo con immagine.
============================================================================= */
require_once('init_admin.php');
require_once('post_aim.php');
// transazione
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();

$azione = $_POST['submit'];    print_r($_POST);//debug

// test validità codice
$_SESSION['esito'] = array();
if (($icod <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          {
          array_push($_SESSION['esito'],'151');
          }
// test validità descrizione
if (($ides <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          {
          array_push($_SESSION['esito'],'154');
          }

switch ($azione)
{
case 'nuovo':
           $sql = "INSERT INTO `".DB::$pref."aim`
                      (iid,iprog,istat,itmp,icod,ides,iart,iartcol,iimg,iimgtit,iimgcol,
                         iimgpos,itipo,ivideo,iimgalt)
                      VALUES (NULL,'$iprog','$istat','$itmp','$icod','$ides','$iart','$iartcol',
                      '$iimg','$iimgtit','$iimgcol','$iimgpos','$itipo','$ivideo','$iimgalt')";
                      $PDO->exec($sql);
                      $PDO->commit();
                      array_push($_SESSION['esito'],'54');
                      break;

case 'modifica':
echo           $sql = "UPDATE `".DB::$pref."aim`
                   SET iprog='$iprog',istat='$istat',itmp='$itmp',icod='$icod',ides='$ides',iart='$iart',
                        iartcol='$iartcol',iimg='$iimg',iimgtit='$iimgtit',iimgcol='$iimgcol' ,
                        iimgpos='$iimgpos',itipo='$itipo',ivideo='$ivideo',iimgalt='$iimgalt'
                   WHERE iid= '$iid' ";
                  $PDO->exec($sql);
                  $PDO->commit();
                  array_push($_SESSION['esito'],'55');
                  break;

case 'cancella':
            $sql = "DELETE from `".DB::$pref."aim`
                    WHERE iid= '$iid' ";
                    $PDO->exec($sql);
                    $PDO->commit();
                    array_push($_SESSION['esito'],'53');
                    break;

case 'ritorno':
               array_push($_SESSION['esito'],'2');
               $loc = "location:admin.php?".$_SESSION['location']."";
                    header($loc);
               break;

default:
  echo "Operazione invalida";
  break;
}
$loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);

?>
