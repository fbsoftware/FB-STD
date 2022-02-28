<?php   session_start();       ob_start();
/** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.1
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
============================================================================= */
require_once('init_admin.php');
require_once('post_ute.php');
$azione=$_POST['submit'];
//print_r($_POST);//debug
$_SESSION['esito'] = array();

// cripto la password
$pwmd5=md5($upassword);

switch ($azione)
{
case 'nuovo':
               $sql = "INSERT INTO `".DB::$pref."ute`
                         (uid,ustat,uprog,username,upassword,uaccesso,uiscritto)
                      VALUES ('$uid','$ustat','$uprog','$username','$pwmd5','$uaccesso','$uiscritto')" ;
                    $PDO->exec($sql);
                    $PDO->commit();
                    array_push($_SESSION['esito'],'54');
                    break;

case 'modifica':
          $sql = "UPDATE `".DB::$pref."ute`
                      SET `ustat`='$ustat',`uprog`='$uprog',
                          `username`='$username',`upassword`='$pwmd5' ,`uaccesso`='$uaccesso' ,
                          `uiscritto`='$uiscritto'
                      WHERE `uid`= '$uid' ";
                      $PDO->exec($sql);
                      $PDO->commit();
                      array_push($_SESSION['esito'],'55');
                        break;

case 'cancella':
          $sql = "DELETE from `".DB::$pref."ute`
                      WHERE `uid`= '$uid' ";
                      $PDO->exec($sql);
                      $PDO->commit();
                      array_push($_SESSION['esito'],'53');
                        break;


case 'ritorno':
          array_push($_SESSION['esito'],'2');
          $loc = "location:admin.php?".$_SESSION['location']."";
          header($loc);
}
     $loc = "location:admin.php?".$_SESSION['location']."";
          header($loc);
ob_end_flush();
?>
