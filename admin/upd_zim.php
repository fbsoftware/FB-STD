<?php   session_start();       ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   *-------------------------------------------------------------------------
   * 28/5/2019	aggiunta copia
============================================================================= */
require_once('init_admin.php');
require_once('post_zim.php');
$azione  =$_POST['submit'];

// test scelta effettuata sul pgm chiamante
if (($azione == 'modifica' || $azione == 'cancella' || $azione == 'copia') && $zid == '')
     {
     $_SESSION['esito'] = 4;
     $loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
     }
echo "<body class='admin' data-theme='".TMP::$tcolor."'>";
switch ($azione)
{ // controllo
    case '':
    case 'ritorno' :
		$_SESSION['esito'] = 2;
		$loc = "location:admin.php?".$_SESSION['location']."";
		header($loc);
		break;
//default: ???
// inserimento
    case 'nuovo':
    $param = array('nuovo','ritorno');
    $btx   = new bottoni_str_par('Immagine zoomabile - nuovo','zim','write_zim.php',$param);
         $btx->btn();

     echo  "<fieldset>";
      $zim = new DB_ins('zim','zprog');
      $f1 = new input(array($zim->insert(),'zprog',3,'Progressivo',' ','i'));
          $f1->field();
      $ts = new DB_tip_i('stato','zstat','','Stato record','');
          $ts->select();
        $t = new getTmp('','ztmp','Template','Scelta del template');
          $t->getTemplate();
      $f4 = new input(array('','zpage',50,'Pagina',' ','i'));
          $f4->field();          
            $f3 = new input(array('','zcod',20,'Codice',' ','i'));
          $f3->field();

          $tw = new select_file('images/','','zimg','Immagine ','Path immagine articolo');
            $tw->image();
     //echo  "<div class='td'><img src=".$image." alt='img' width='100' /></div>";
     echo  "</fieldset></form>";
      break;
// modifica
    case 'modifica':
     $param = array('modifica','ritorno');
     $btx   = new bottoni_str_par('Immagine zoomabile - modifica','zim','write_zim.php',$param);
          $btx->btn();

// transazione
     $sql = "SELECT * FROM `".DB::$pref."zim`
			 WHERE `zid` = $zid ";

     foreach($PDO->query($sql) as $row)
     {
     echo  "<fieldset>";
     require('fields_zim.php');
      $f0 = new input(array($zid,'zid',0,'','','h'));
          $f0->field();
      $f1 = new input(array($zprog,'zprog',3,'Progressivo','','i'));
          $f1->field();
      $ts = new DB_tip_i('stato','zstat',$zstat,'Stato record','');
          $ts->select();
      $f3 = new input(array($zcod,'zcod',20,'Codice','','i'));
          $f3->field();
          $t = new getTmp($ztmp,'ztmp','Template','Scelta del template');
          $t->getTemplate();
          $f4 = new input(array($zpage,'zpage',50,'Pagina',' ','i'));
          $f4->field();
          $tw = new select_file('images/',$zimg,'zimg','Immagine ','Path immagine articolo');
          $tw->image();
	 }
     echo  "<div class='td'><img src=".$zimg." alt='img' width='100' /></div>";
     echo    "</fieldset></form>";
     break;

// copia
    case 'copia':
    $param = array('nuovo','ritorno');
    $btx   = new bottoni_str_par('TImmagine zoomabile - copia','zim','write_zim.php',$param);
         $btx->btn();
// transazione
     $sql = "SELECT * FROM `".DB::$pref."zim`
			 WHERE `zid` = $zid ";

     foreach($PDO->query($sql) as $row)
     {
     echo  "<fieldset>";
     require('fields_zim.php');
      $zim = new DB_ins('zim','zprog');
      $f1 = new input(array($zim->insert(),'zprog',3,'Progressivo',' ','i'));
          $f1->field();
      $ts = new DB_tip_i('stato','zstat',$zstat,'Stato record','');
          $ts->select();
      $f3 = new input(array($zcod,'zcod',20,'Codice','','i'));
          $f3->field();
          $t = new getTmp($ztmp,'ztmp','Template','Scelta del template');
          $t->getTemplate();
          $f4 = new input(array($zpage,'zpage',50,'Pagina',' ','i'));
          $f4->field();
          $tw = new select_file('images/',$zimg,'zimg','Immagine ','Path immagine articolo');
          $tw->image();
	 }
     echo  "<div class='td'><img src=".$zimg." alt='img' width='100' /></div>";
     echo    "</fieldset></form>";
     break;

// cancellazione
    case 'cancella' :
          $param  = array('cancella','ritorno');    
          $btx    = new bottoni_str_par('Immagine zoomabile - conferma cancellazione','zim','write_zim.php',$param);
               $btx->btn();
      $sql = "SELECT * FROM `".DB::$pref."zim`
              WHERE `zid` = $zid  ";

foreach($PDO->query($sql) as $row)
    {
     require('fields_zim.php');
     echo  "<fieldset>";
      $f0 = new input(array($zid,'zid',0,'','','h'));
          $f0->field();
      $f1 = new input(array($zprog,'zprog',3,'Progressivo','','r'));
          $f1->field();
      $ts = new input(array($zstat,'zstat',1,'Stato record','','r'));
          $ts->field();
      $f3 = new input(array($ztmp,'zctmp',50,'Template','','r'));
          $f3->field();
          $f3 = new input(array($zpage,'zpage',50,'Pagina','','r'));
          $f3->field();
          $f3 = new input(array($zcod,'zcod',20,'Codice','','r'));
          $f3->field();      
      $f4 = new input(array($zimg,'zimg',30,'Immagine','','r'));
          $f4->field();
      }
      echo  "<div class='td'><img src=".$zimg." alt='img' width='100' /></div>";
     echo    "</fieldset></form>";
      break;

    default:
  echo "Operazione invalida";
}
echo "</body>";
ob_end_flush();
?>
