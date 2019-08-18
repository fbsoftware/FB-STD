<?php  session_start(); 
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1       
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * Scrittura sul DB tabella templates
	*	1.0.0 nuova head
	17/8/19  aggiunto campo "teditor"
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

include_once 'post_tmp.php';
$azione   =$_POST['submit'];

echo "<br />";   
print_r($_POST);//debug

// test validità codice  
if (($tmenu <= "") && ($azione != 'cancella') && ($azione != 'ritorno'))
          {
          $_SESSION['errore'] = 1;
          $_SESSION['errore0'] = 1;
          }

     // transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 


switch ($azione)
{
case 'nuovo':
 echo          $sql = "INSERT INTO `".DB::$pref."tmp` (tprog,tstat,tcod,tsel,tfolder,
                       tdesc,tmenu,tlang,tslidebutt,tslidetime,tportitle,tcolor,
                       tgliforma,tgliftitle,tgliftext,tglireverse,ttipo,
						tpromotitle,tpromotit,tpromotext,tgliftit,tportit,tportext,
						tcttitle,tcttit,tcttext,taccotitle,taccotit,taccotext,
						ttabtitle,ttabtit,ttabtext,tsldtitle,tsldtit,tsldtext,teditor)  
                       VALUES ('$tprog','$tstat','$tcod','$tsel','$tfolder','$tdesc',
                              '$tmenu','$tlang','$tslidebutt','$tslidetime',
                              '$tportitle','$tcolor','$tgliforma','$tgliftitle',
                              '$tgliftext','$tglireverse','$ttipo',
						 '$tpromotitle','$tpromotit','$tpromotext','$tgliftit',
						 '$tportit','$tportext',
						 '$tcttitle','$tcttit','$tcttext','$taccotitle','$taccotit','$taccotext',
						  '$ttabtitle','$ttaabtit','$ttabtext',
						  '$tsldtitle','$tsldtit','$tsldtext','$teditor')";
                        $PDO->exec($sql);    
                        $PDO->commit();
                        $_SESSION['esito'] = 54;
                        break;
case 'modifica':
 echo          $sql = "UPDATE `".DB::$pref."tmp` 
                   SET tprog='$tprog',tstat='$tstat',tcod='$tcod',tsel='$tsel',
						tfolder='$tfolder',tdesc='$tdesc',
						tmenu='$tmenu',tlang='$tlang',tslidebutt='$tslidebutt',
						tslidetime='$tslidetime',
						tcolor='$tcolor',tgliforma='$tgliforma',
						tgliftitle='$tgliftitle',tgliftext='$tgliftext',
						tglireverse='$tglireverse',ttipo='$ttipo',
						tpromotitle='$tpromotitle',
						tpromotit='$tpromotit', 
						tpromotext='$tpromotext', 
						tgliftit='$tgliftit',
						tportitle=$tportitle,
						tportit='$tportit',
						tportext='$tportext',
						tcttitle=$tcttitle,
						tcttit='$tcttit',
						tcttext='$tcttext',
						taccotitle=$taccotitle,
						taccotit='$taccotit',
						taccotext='$taccotext',
						ttabtitle=$ttabtitle,
						ttabtit='$ttabtit',
						ttabtext='$ttabtext',
						tsldtitle=$tsldtitle,
						tsldtit='$tsldtit',
						tsldtext='$tsldtext',
						teditor='$teditor'
				   
                   WHERE `tid`='$tid' ";
                   $PDO->exec($sql);    
                   $PDO->commit();
                   $_SESSION['esito'] = 55;
                   break;
case 'cancella':
           $sql = "DELETE from `".DB::$pref."tmp` where tid= '$tid' ";
                  $PDO->exec($sql);    
                  $PDO->commit();
                  $_SESSION['esito'] = 53;
                  break;
case 'ritorno':
          $_SESSION['esito'] = 2;
          header('location:gest_tmp.php');
          break;
}
header('location:admin.php?'.$_SESSION['location'].'');
ob_end_flush();

?> 