<?php  session_start();   ob_start();
/** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
   * package		FB open template
   * versione 1.4
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
==============================================================================
   * manutenzione config.ini
==============================================================================*/
require_once('init_admin.php');

$azione  =$_POST['submit'];
//print_r($_POST);//debug

 switch ($azione)
{
case 'chiudi':
          header('location:admin.php?urla=widget.php&pag=');          break;

default:
// acquisizione e creazione config.ini
$options=array('autoSave'=>true, 'readOnly'=>false);
$file=new FileIni("../config.ini", $options);

$file->setValue('versione', 'livello'  ,  $_POST['livello']);
$file->setValue('versione', 'rilascio' ,  $_POST['rilascio']);
$file->setValue('versione', 'modify' ,  $_POST['modify']);

$file->setValue('DB', 'host', $_POST['host']);
$file->setValue('DB', 'user', $_POST['user']);
$file->setValue('DB', 'pw'  , $_POST['pw']);
$file->setValue('DB', 'db'  , $_POST['db']);
$file->setValue('DB', 'pref', $_POST['pref']);

$file->setValue('config', 'root', 	   $_POST['root']);
$file->setValue('config', 'site'     , $_POST['site']);
$file->setValue('config', 'page_title',$_POST['page_title']);
$file->setValue('config', 'author' ,   $_POST['author']);
$file->setValue('config', 'keywords' , $_POST['keywords']);
$file->setValue('config', 'dir_imm' ,  $_POST['dir_imm']);
$file->setValue('config', 'incr',      $_POST['incr']);
$file->setValue('config', 'sep',       $_POST['sep']);
$file->setValue('config', 'lib',       $_POST['lib']);
$file->setValue('config', 'e_mail',    $_POST['e_mail']);
$file->setValue('config', 'url',       $_POST['url']);

header('location:admin.php?'.$_SESSION['location'].'');
 break;
}
ob_end_flush();
?>
