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
	* 1.0.0 nuova head
	* 30/5/20	tolto tsld... perchè non utilizzato (Rimangono i campi sul database)
	* 07/02/21	gestito editor di testi e colori
	
============================================================================= */ 
require_once('init_admin.php');
require_once 'post_tmp.php';
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
						tgliftit,tportit,tportext,
						tcttitle,tcttit,tcttext,
						ttabtitle,ttabtit,ttabtext,teditor,
						tpri_color,		
						tx_pri_color,   
						tsec_color,     
						tx_sec_color,   
						tbg_color,      
						tx_color,       
						tbutton_color , 
						tx_button_color,
						tpromotitle,tpromotit,tpromotext)  
						
                       VALUES ('$tprog','$tstat','$tcod','$tsel','$tfolder','$tdesc',
                              '$tmenu','$tlang','$tslidebutt','$tslidetime',
                              '$tportitle','$tcolor','$tgliforma','$tgliftitle',
                              '$tgliftext','$tglireverse','$ttipo',
						 '$tgliftit',
						 '$tportit','$tportext',
						 '$tcttitle','$tcttit','$tcttext',
						  '$ttabtitle','$ttaabtit','$ttabtext','$teditor',
						  '$tpri_color',		
						  '$tx_pri_color',   
						  '$tsec_color',     
						  '$tx_sec_color',   
						  '$tbg_color',      
						  '$tx_color',       
						  '$tbutton_color',  
						  '$tx_button_color',
						  '$tpromotitle','$tpromotit','$tpromotext')";
                        $PDO->exec($sql);    
                        $PDO->commit();
                        $_SESSION['esito'] = 54;
                        break;
case 'modifica':
           $sql = "UPDATE `".DB::$pref."tmp` 
                   SET tprog='$tprog',tstat='$tstat',tcod='$tcod',tsel='$tsel',
						tfolder='$tfolder',tdesc='$tdesc',
						tmenu='$tmenu',tlang='$tlang',tslidebutt='$tslidebutt',
						tslidetime='$tslidetime',
						tcolor='$tcolor',tgliforma='$tgliforma',
						tgliftitle='$tgliftitle',tgliftext='$tgliftext',
						tglireverse='$tglireverse',ttipo='$ttipo',
						tgliftit='$tgliftit',
						tportitle=$tportitle,
						tportit='$tportit',
						tportext='$tportext',
						tcttitle=$tcttitle,
						tcttit='$tcttit',
						tcttext='$tcttext',
						ttabtitle=$ttabtitle,
						ttabtit='$ttabtit',
						ttabtext='$ttabtext',
						teditor='$teditor',
						tpri_color	   ='$tpri_color',	   
						tx_pri_color   ='$tx_pri_color',   
						tsec_color     ='$tsec_color',     
						tx_sec_color   ='$tx_sec_color',   
						tbg_color      ='$tbg_color',      
						tx_color       ='$tx_color',       
						tbutton_color  ='$tbutton_color',  
						tx_button_color='$tx_button_color',
						tpromotitle=$tpromotitle,
						tpromotit='$tpromotit',
						tpromotext='$tpromotext'
						
				   
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