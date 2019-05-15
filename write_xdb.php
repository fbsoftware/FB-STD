<?php   session_start();       ob_start();
/** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * aggiornamento tabella 'xdb'      
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
      
include 'post_xdb.php';
$azione  =$_POST['submit'];    //print_r($_POST); //debug
include_once("connectDB.php");

switch ($azione)
{
case 'nuovo':
          $sql = "INSERT INTO `".DB::$pref."xdb` 
                      (xid,xprog,xstat,xtipo,xcod,xdes) 
                      VALUES (NULL,'$xprog','$xtat','$xtipo','$xcod','$xdes')";
          $PDO->exec($sql);    
          $PDO->commit();
          $_SESSION['esito'] = 54;
          break;

case 'modifica':
          $sql = "UPDATE `".DB::$pref."xdb` SET xprog='$xprog',xstat='$xstat',
                         xcod='$xcod',xdes='$xdes',xtipo='$xtipo'  
                    WHERE xid= '$xid' ";
          $PDO->exec($sql);    
          $PDO->commit();
          $_SESSION['esito'] = 55;
          break;
  
case 'cancella':
          $sql = "DELETE from `".DB::$pref."xdb` 
                    WHERE xid= '$xid' ";
		$PDO->exec($sql);    
          $PDO->commit();
          $_SESSION['esito'] = 53;
          break;
  
case 'ritorno':
          $_SESSION['esito'] = 2;
         break;

  echo "Operazione invalida";
}
$loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
?> 
