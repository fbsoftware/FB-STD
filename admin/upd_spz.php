<?php   session_start();       ob_start();
/**
    Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
    Package		FB open template
    versione 1.3
    copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
    license		GNU/GPL
    Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
    all'uso anche improprio di FB open template.
   -------------------------------------------------------------------------
    05/05/24   tabella 'spz' spaziature
============================================================================= */
require_once('init_admin.php');
//print_r($_POST);//debug
$azione  =$_POST['submit'];
$qid  =$_POST['qid'];

// test scelta effettuata sul pgm chiamante
$scelta = new testSiScelta($qid,$azione);
  $scelta->alert_s();

echo "<body class='admin' data-theme='".TMP::$tcolor."'>";
switch ($azione)
{ // controllo
    case '':
    case 'qitorno' :
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
      $spz = new DB_ins('spz','qprog');
    $f1 = new input(array($spz->insert(),'qprog',3,'Progressivo',' ','i'));
          $f1->field();
    $ts = new DB_tip_i('stato','qstat','','Stato record','');
          $ts->select();
    $t = new getTmp('','qtmp','Template','Scelta del template');
          $t->getTemplate();
    $f3 = new input(array('','qpage',30,'Pagina',' ','i'));
          $f3->field();
    $f3 = new input(array('','qcod',30,'Codice',' ','i'));
          $f3->field();
    $f4 = new input(array('','qdesc',50,'Descrizione',' ','i'));
          $f4->field();
    $f2 = new input(array('','qspa',5,'spaziatura',' ','ia'));
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
			 WHERE `qid` = $qid ";

     foreach($PDO->query($sql) as $row)
     {
     echo  "<fieldset>";
     require('fields_spz.php');
      $f0 = new input(array($qid,'qid',0,'','','h'));
          $f0->field();
      $f1 = new input(array($qprog,'qprog',3,'Progressivo','','i'));
          $f1->field();
      $ts = new DB_tip_i('stato','qstat',$qstat,'Stato record','');
          $ts->select();
      $f2 = new input(array($qtmp,'qtmp',5,'Template','','ir'));
          $f2->field();
      $f3 = new input(array($qcod,'qcod',20,'Codice','','i'));
          $f3->field();
      $f4 = new input(array($qdesc,'qdesc',30,'Descrizione','','i'));
          $f4->field();
          $f3 = new input(array($qspa,'qspa',20,'Spaziatura','','i'));
          $f3->field();
      $f4 = new input(array($qpage,'qpage',30,'Pagina','','i'));
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
			 WHERE `qid` = $qid ";

     foreach($PDO->query($sql) as $row)
     {
     echo  "<fieldset>";
     require('fields_spz.php');
       $qdbx = new DB_ins('spz','qprog');
      $f1 = new input(array($qdbx->insert(),'qprog',3,'Progressivo','','i'));
        $f1->field();
  $ts = new DB_tip_i('stato','qstat',$qstat,'Stato record','');
      $ts->select();
  $f2 = new input(array($qtmp,'qtmp',5,'Template','','ir'));
      $f2->field();
  $f3 = new input(array($qcod,'qcod',20,'Codice','','i'));
      $f3->field();
  $f4 = new input(array($qdesc,'qdesc',30,'Descrizione','','i'));
      $f4->field();
  $f3 = new input(array($qspa,'qspa',20,'Spaziatura','','i'));
      $f3->field();
  $f4 = new input(array($qpage,'qpage',30,'Pagina','','i'));
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
              WHERE `qid` = $qid  ";

foreach($PDO->query($sql) as $row)
    {
     require('fields_spz.php');
     echo  "<fieldset>";
      $f0 = new input(array($qid,'qid',0,'','','h'));
          $f0->field();
      $f1 = new input(array($qprog,'qprog',3,'Progressivo','','r'));
          $f1->field();
      $ts = new input(array($qstat,'qstat',1,'Stato record','','r'));
          $ts->field();
      $f3 = new input(array($qcod,'qcod',20,'Codice','','r'));
          $f3->field();
      $f4 = new input(array($qdesc,'qdesc',30,'Descrizione','','r'));
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
