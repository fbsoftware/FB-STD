<?php session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.2.0
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione descrizionbi in lingua
============================================================================= */ 
include_once 'include_gest.php';
// DOCTYPE & head
$head = new getBootHead('Lingue',$_SESSION['ambito']);
     $head->getBootHead();

include_once 'post_lang.php';      //print_r($_POST);//debug
switch ($azione)
{
case 'nuovo':
          $options=array('autoSave'=>true, 'readOnly'=>false);
          $file=new FileIni("language/it.ini", $options);
          $file->setValue('it',$voce,$it);
          $file=new FileIni("language/fr.ini", $options);
          $file->setValue('fr',$voce,$fr);
          $file=new FileIni("language/en.ini", $options);
          $file->setValue('en',$voce,$en);
          $loc = "location:admin.php?".$_SESSION['location']."";
          header($loc);
          $_SESSION['esito'] = 54;
     break;

case 'modifica':
          $options=array('autoSave'=>true, 'readOnly'=>false);
          $file=new FileIni("language/it.ini", $options);
          $file->setValue('it',$voce,$it);
          $file=new FileIni("language/fr.ini", $options);
          $file->setValue('fr',$voce,$fr);
          $file=new FileIni("language/en.ini", $options);
          $file->setValue('en',$voce,$en);
          $loc = "location:admin.php?".$_SESSION['location']."";
          header($loc);
          $_SESSION['esito'] = 55;
     break;

case 'cancella':
          $options=array('autoSave'=>true, 'readOnly'=>false);
          $file=new FileIni("language/it.ini", $options);
          $file->deleteKey('it',$voce);
          $file=new FileIni("language/fr.ini", $options);
          $file->deleteKey('fr',$voce);
          $file=new FileIni("language/en.ini", $options);
  $bool = $file->deleteKey('en',$voce);
       if ($bool) {  echo "record cancellato";  }
       $loc = "location:admin.php?".$_SESSION['location']."";
          header($loc);
          $_SESSION['esito'] = 53;
     break;

case 'ritorno':
          $_SESSION['esito'] = 2;
          $loc = "location:admin.php?".$_SESSION['location']."";
          header($loc);         
     break;
default:
          $_SESSION['esito'] = 0;
          $loc = "location:admin.php?".$_SESSION['location']."";
          header($loc);         

}
     $loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
?> 