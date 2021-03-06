<?php session_start();
ob_start();
/**
 * ** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
 * package		FB open template
 * versione 2.0    
 * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
 * license		GNU/GPL
 * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
 * all'uso anche improprio di FB open template.
 * ------------------------------------------------------------- 
 * Aggiornamento tabella 'por' per portfolio
 * =============================================================================  */
require_once('../loadLibraries.php');
require_once('loadTemplateAdmin.php');
$app = new Head('Gestione menu');
$app->openHead();
require_once("../jquery_link.php");
//require_once("../bootstrap_link.php");
require_once("../include_head.php");
require_once('../lingua.php'); 
$app->closeHead();
//----------------------------------------------
require_once('post_por.php');

$azione = $_POST['submit'];
print_r($_POST); //debug

switch ($azione)
 {
case 'nuovo':
     $sql = "INSERT INTO `" . DB :: $pref . "por` 
                (pid,pstat,pprog,pcod,pdes,ptmp,
                    pimg,palt,pcapt,pcol,pmheader,pmlink,pmtext) 
                VALUES (NULL,'$pstat',$pprog, '$pcod','$pdes','$ptmp',
                    '$pimg','$palt','$pcapt','$pcol','$pmheader','$pmlink','$pmtext')";
// transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction(); 
     $PDO -> exec($sql);
     $PDO -> commit();
     $_SESSION['esito'] = 54;
     break;

case 'modifica':
     $sql = "UPDATE `" . DB :: $pref . "por` 
                  SET pprog=$pprog,pstat='$pstat',pcod='$pcod',pdes='$pdes',ptmp='$ptmp',
                         pimg='$pimg',palt='$palt', pmtext='$pmtext',
                         pcapt='$pcapt',pcol='$pcol',pmheader='$pmheader',pmlink='$pmlink'
                  WHERE pid=$pid";
// transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();
     $PDO -> exec($sql);
     $PDO -> commit();
     $_SESSION['esito'] = 55;
     break;

case 'cancella':
     $sql = "DELETE from `" . DB :: $pref . "por` 
                  WHERE pid='$pid'";
// transazione    
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();
     $PDO -> exec($sql);
     $PDO -> commit();
     $_SESSION['esito'] = 53;
     break;

case 'ritorno':
     $_SESSION['esito'] = 2;
     $loc = "location:admin.php?".$_SESSION['location']."";
          header($loc);
     break;
default:
     $_SESSION['esito'] = 0;
     break;
    } 

$loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
ob_end_flush();
?> 