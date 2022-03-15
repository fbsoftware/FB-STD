<?php session_start();      ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------
   * gestione componente articolo con immagine
   15/03/2022	aggiunta copia, nuove include in "write"
============================================================================= */
require_once('init_admin.php');
require_once("post_".$_SESSION['tab'].".php");
$azione  =$_POST['submit'];     //print_r($_POST);//debug

// test scelta effettuata sul pgm chiamante
             $scelta = new testSiScelta($iid,$azione);
               $scelta->alert_s();

echo "<body class='admin' data-theme='".TMP::$tcolor."'>";
echo "<section id='upd'>";

switch ($azione)
{
// inserimento
    case 'nuovo':
     $param    = array('nuovo','ritorno');
     $btx      = new bottoni_str_par('Articoli con immagine - nuovo','aim','write_aim.php',$param);
     $btx->btn();
     echo  "<fieldset>";
      $xdb = new DB_ins('aim','iprog');
      $f1 = new input(array($xdb->insert(),'iprog',3,'Progressivo','Per ordinamento','i'));
           $f1->field();
      $ts = new DB_tip_i('stato','istat','','Stato record','Attivo-sospeso');
          $ts->select();
      $t = new getTmp('','itmp','Template','Scelta del template');
          $t->getTemplate();
      $f3 = new input(array('','icod',20,'Codice','Codice del componente','ia'));
          $f3->field();
      $f4 = new input(array('','ides',30,'Descrizione','Descrizione del componente','i'));
          $f4->field();
      $f  = new DB_tip_i('imgvd','itipo','','Tipo','Tipo immagine:img-video');
          $f->select();
      $f4 = new input(array('','ivideo',11,'ID video','Codice video YouTube','i'));
          $f4->field();
      $f4 =    new DB_sel_lt('art','aprog','','atit','atit','astat','atit','Articolo','Titolo articolo da usare.');
          $f4->select_lt();

      $tw = new select_file('images/','','iimg','Immagine ','Path immagine articolo');
          $tw->image();
      $f4 = new input(array('','iimgtit',20,'Titolo immagine','Titolo della immagine','i'));
          $f4->field();

      $f  = new DB_tip_i('posim','iimgpos','','Posizione immagine','Posizione immagine destra-sinistra');
          $f->select();
echo "</fieldset>";
echo "</form>";
      break;

// modifica
    case 'modifica':
     $param    = array('modifica','ritorno');
     $btx      = new bottoni_str_par('Articoli con immagine - modifica','aim','write_aim.php',$param);
     $btx->btn();

    $sql = "SELECT * FROM `".DB::$pref."aim`
    			WHERE `iid` = $iid ";
// transazione
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();
foreach($PDO->query($sql) as $row)
require('fields_aim.php');

echo  "<fieldset>";
      $f4 = new input(array($iid,'iid',5,'','','h'));
          $f4->field();
      $f1 = new input(array($iprog,'iprog',3,'Progressivo','Progressivo per ordinamento','i'));
          $f1->field();
      $ts = new DB_tip_i('stato','istat',$istat,'Stato record','Attivo-sospeso');
          $ts->select();
      $t  = new getTmp($itmp,'itmp','Template','Scelta del template');
          $t->getTemplate();
      $f3 = new input(array($icod,'icod',20,'Codice','Codice del componente articolo con immagine','ia'));
          $f3->field();
      $f4 = new input(array(htmlspecialchars($ides, ENT_QUOTES),'ides',30,'Descrizione','Descrizione del componente','i'));
          $f4->field();
      $f  = new DB_tip_i('imgvd','itipo',$itipo,'Tipo','Tipo immagine:img-video');
          $f->select();
      $f4 = new input(array($ivideo,'ivideo',11,'ID video','Codice video YouTube','i'));
          $f4->field();
      $f4 =    new DB_sel_lt('art','aprog',$iart,'atit','iart','astat','atit','Articolo','Titolo articolo da usare.');
          $f4->select_lt();

      $tw = new select_file('images/',$iimg,'iimg','Immagine ','Path immagine articolo');
          $tw->image();
      $f4 = new input(array($iimgtit,'iimgtit',20,'Titolo immagine','Titolo della immagine','i'));
          $f4->field();

      $f  = new DB_tip_i('posim','iimgpos',$iimgpos,'Posizione immagine','Posizione immagine destra-sinistra');
          $f->select();

echo "</fieldset>";
echo "</form>";
break;

// copia
    case 'copia':
     $param    = array('copia','ritorno');
     $btx      = new bottoni_str_par('Articoli con immagine - copia','aim','write_aim.php',$param);
     $btx->btn();

    $sql = "SELECT * FROM `".DB::$pref."aim`
    			WHERE `iid` = $iid ";
// transazione
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();
foreach($PDO->query($sql) as $row)
require('fields_aim.php');

echo  "<fieldset>";
      $f4 = new input(array($iid,'iid',5,'','','h'));
          $f4->field();
          $xdb = new DB_ins('aim','iprog');
          $f1 = new input(array($xdb->insert(),'iprog',3,'Progressivo','Per ordinamento','i'));
               $f1->field();
      $ts = new DB_tip_i('stato','istat',$istat,'Stato record','Attivo-sospeso');
          $ts->select();
      $t  = new getTmp($itmp,'itmp','Template','Scelta del template');
          $t->getTemplate();
      $f3 = new input(array($icod,'icod',20,'Codice','Codice del componente articolo con immagine','ia'));
          $f3->field();
      $f4 = new input(array(htmlspecialchars($ides, ENT_QUOTES),'ides',30,'Descrizione','Descrizione del componente','i'));
          $f4->field();
      $f  = new DB_tip_i('imgvd','itipo',$itipo,'Tipo','Tipo immagine:img-video');
          $f->select();
      $f4 = new input(array($ivideo,'ivideo',11,'ID video','Codice video YouTube','i'));
          $f4->field();
      $f4 =    new DB_sel_lt('art','aprog',$iart,'atit','iart','astat','atit','Articolo','Titolo articolo da usare.');
          $f4->select_lt();

      $tw = new select_file('images/',$iimg,'iimg','Immagine ','Path immagine articolo');
          $tw->image();
      $f4 = new input(array($iimgtit,'iimgtit',20,'Titolo immagine','Titolo della immagine','i'));
          $f4->field();

      $f  = new DB_tip_i('posim','iimgpos',$iimgpos,'Posizione immagine','Posizione immagine destra-sinistra');
          $f->select();

echo "</fieldset>";
echo "</form>";
break;

// cancellazione
    case 'cancella' :
     $param    = array('cancella','ritorno');
     $btx      = new bottoni_str_par('Articoli con immagine - conferma cancellazione','aim','write_aim.php',$param);
     $btx->btn();

      $sql = "SELECT * FROM `".DB::$pref."aim`
               WHERE `iid` = $iid  ";
// transazione
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();
foreach($PDO->query($sql) as $row)
	{
	require('fields_aim.php');
echo  "<fieldset>";
      $f0 = new input(array($iid,'iid',0,'','','h'));
	 	$f0->field();
      $f1 = new input(array($iprog,'iprog',3,'Progressivo','','r'));
	 	$f1->field();
      $ts = new input(array($istat,'istat',1,'Stato record','','r'));
	 	$ts->field();
      $f2 = new input(array($itipo,'itipo',5,'Tipo','','r'));
	 	$f2->field();
      $f3 = new input(array($icod,'icod',20,'Codice','','r'));
	 	$f3->field();
      $f4 = new input(array(htmlspecialchars($ides, ENT_QUOTES),'ides',30,'Descrizione','','r'));
      	$f4->field();
     }
echo "</fieldset>";
echo "</form>";
      break;

    case 'ritorno' :
			header('location:admin.php?'.$_SESSION['location'].'');
			break;

	case 'chiudi':
			header('location:admin.php?urla=widget.php&pag=');
			break;

    default:
  echo "Operazione invalida";
     }
     echo "</section>";
	 echo "</body>";
ob_end_flush();
?>
