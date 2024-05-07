<?php   session_start();       ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   *-------------------------------------------------------------------------
   * 05/05/24   tabella 'spz' spaziature
============================================================================= */
require_once('init_admin.php');
//print_r($_POST);//debug
$azione  =$_POST['submit'];
$rid  =$_POST['rid'];

// test scelta effettuata sul pgm chiamante
$scelta = new testSiScelta($rid,$azione);
  $scelta->alert_s();

echo "<body class='admin' data-theme='".TMP::$tcolor."'>";
switch ($azione)
{ // controllo
    case '':
    case 'ritorno' :
		array_push($_SESSION['esito'],'2');
		$loc = "location:admin.php?".$_SESSION['location']."";
		header($loc);
		break;
//default: ???
// inserimento
    case 'nuovo':
    $param = array('nuovo','ritorno');
    $btx   = new bottoni_str_par('Spaziature - nuovo','spz','write_spz.php',$param);
         $btx->btn();

     echo  "<fieldset>";
      $spz = new DB_ins('spz','rprog');
    $f1 = new input(array($spz->insert(),'rprog',3,'Progressivo',' ','i'));
          $f1->field();
    $ts = new DB_tip_i('stato','rstat','','Stato record','');
          $ts->select();
    $t = new getTmp('','rtmp','Template','Scelta del template');
          $t->getTemplate();
    $f3 = new input(array('','rpage',30,'Pagina',' ','i'));
          $f3->field();
    $f3 = new input(array('','rcod',30,'Codice',' ','i'));
          $f3->field();
    $f4 = new input(array('','rdesc',50,'Descrizione',' ','i'));
          $f4->field();
    $f2 = new input(array('','rspa',5,'spaziatura',' ','ia'));
          $f2->field();
     echo  "</fieldset></form>";
      break;
// modifica
    case 'modifica':
     $param = array('modifica','ritorno');
     $btx   = new bottoni_str_par('Tipologie - modifica','spz','write_spz.php',$param);
          $btx->btn();

// transazione
     $sql = "SELECT * FROM `".DB::$pref."spz`
			 WHERE `rid` = $rid ";

     foreach($PDO->query($sql) as $row)
     {
     echo  "<fieldset>";
     require('fields_spz.php');
      $f0 = new input(array($rid,'rid',0,'','','h'));
          $f0->field();
      $f1 = new input(array($rprog,'rprog',3,'Progressivo','','i'));
          $f1->field();
      $ts = new DB_tip_i('stato','rstat',$rstat,'Stato record','');
          $ts->select();
      $f2 = new input(array($rtmp,'rtmp',5,'Template','','ir'));
          $f2->field();
      $f3 = new input(array($rcod,'rcod',20,'Codice','','i'));
          $f3->field();
      $f4 = new input(array($rdesc,'rdesc',30,'Descrizione','','i'));
          $f4->field();
          $f3 = new input(array($rspa,'rspa',20,'Spaziatura','','i'));
          $f3->field();
      $f4 = new input(array($rpage,'rpage',30,'Pagina','','i'));
          $f4->field();
	 }
     echo    "</fieldset></form>";
     break;

// copia
    case 'copia':
    $param = array('copia','ritorno');
    $btx   = new bottoni_str_par('Tipologie - copia','spz','write_spz.php',$param);
         $btx->btn();
// transazione
      $sql = "SELECT * FROM `".DB::$pref."spz`
			 WHERE `rid` = $rid ";

     foreach($PDO->query($sql) as $row)
     {
     echo  "<fieldset>";
     require('fields_spz.php');
       $rdbx = new DB_ins('spz','rprog');
      $f1 = new input(array($rdbx->insert(),'rprog',3,'Progressivo','','i'));
        $f1->field();
  $ts = new DB_tip_i('stato','rstat',$rstat,'Stato record','');
      $ts->select();
  $f2 = new input(array($rtmp,'rtmp',5,'Template','','ir'));
      $f2->field();
  $f3 = new input(array($rcod,'rcod',20,'Codice','','i'));
      $f3->field();
  $f4 = new input(array($rdesc,'rdesc',30,'Descrizione','','i'));
      $f4->field();
  $f3 = new input(array($rspa,'rspa',20,'Spaziatura','','i'));
      $f3->field();
  $f4 = new input(array($rpage,'rpage',30,'Pagina','','i'));
      $f4->field();
	 }
     echo    "</fieldset></form>";
     break;

// cancellazione
    case 'cancella' :
          $param  = array('cancella','ritorno');
          $btx    = new bottoni_str_par('Tipologie - conferma cancellazione','spz','write_spz.php',$param);
               $btx->btn();
      $sql = "SELECT * FROM `".DB::$pref."spz`
              WHERE `rid` = $rid  ";

foreach($PDO->query($sql) as $row)
    {
     require('fields_spz.php');
     echo  "<fieldset>";
      $f0 = new input(array($rid,'rid',0,'','','h'));
          $f0->field();
      $f1 = new input(array($rprog,'rprog',3,'Progressivo','','r'));
          $f1->field();
      $ts = new input(array($rstat,'rstat',1,'Stato record','','r'));
          $ts->field();
      $f3 = new input(array($rcod,'rcod',20,'Codice','','r'));
          $f3->field();
      $f4 = new input(array($rdesc,'rdesc',30,'Descrizione','','r'));
          $f4->field();
      }
     echo    "</fieldset></form>";
      break;

    default:
  echo "Operazione invalida";
}
echo "</body>";
ob_end_flush();
?>
