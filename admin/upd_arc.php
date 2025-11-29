<?php session_start();      ob_start();
/** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------
   * gestione tabella per 1:4 moduli articoli in colonne
	23.03.21	aggiunto titolo e testo da mostrare o meno
  15/03/2022	aggiunta copia, nuove include in "write"
============================================================================= */
require_once('init_admin.php');
require_once("editor.php");			// scelta editor
require_once("post_".$_SESSION['tab'].".php");

$azione  =$_POST['submit'];
// print_r($_POST);//debug

// test scelta effettuata sul pgm chiamante
             $scelta = new testSiScelta($hid,$azione);
               $scelta->alert_s();

echo "<body class='admin' data-theme='".TMP::$tcolor."'>";
echo "<section id='upd'>";

switch ($azione)
{
 //==================================================================================

// inserimento
    case 'nuovo':
     $btx = new bottoni_str_par('Articoli in colonne - nuovo','arc','write_arc.php',array('nuovo','ritorno'));
          $btx->btn();

	echo "<div class='f-flex fd-row'>";
	echo "<fieldset>";
     $arc = new DB_ins('arc','hprog');
     $f1 = new input(array($arc->insert(),'hprog',3,'Progressivo','Per ordinamento','i'));
          $f1->field();
     $ts = new DB_tip_i('stato','hstat','','Stato record','Attivo/sospeso');
          $ts->select();
      $t = new getTmp('','htmp','Template','Scelta del template che utilizza gli articoli in colonna');
          $t->getTemplate();
     $f3 = new input(array('','hcod',20,'Codice','Codice articoli in colonna','ia'));
          $f3->field();
     $f4 = new input(array('','hdes',30,'Descrizione','Descrizione promo','i'));
          $f4->field();
		  //--- 23.03.21
     $f3 = new input(array('','htit_sn',1,'Mostra Titolo','Mostrare un titolo s/n','sn'));
          $f3->field();
     $f3 = new input(array('','htit',50,'Titolo','Titolo da mostrare','i'));
          $f3->field();
     $f3 = new input(array('','htext',50,'Testo','Testo da mostrare','tx'));
          $f3->field();
		  //---
     $f3 = new input(array('','hsino1',1,'Mostra articolo','Articolo da mostrare o no','sn'));
          $f3->field();
      $f4 =    new DB_sel_lt('art','aprog','','atit','htit1','astat','atit','Articolo 1','Titolo articolo da mostrare.');
          $f4->select_lt();
     $f3 = new input(array('','hsino2',1,'Mostra articolo','Articolo da mostrare o no','sn'));
          $f3->field();
      $f4 =    new DB_sel_lt('art','aprog','','atit','htit2','astat','atit','Articolo 2','Titolo articolo da mostrare.');
          $f4->select_lt();
     $f3 = new input(array('','hsino3',1,'Mostra articolo','Articolo da mostrare o no','sn'));
          $f3->field();
      $f4 =    new DB_sel_lt('art','aprog','','atit','htit3','astat','atit','Articolo 3','Titolo articolo da mostrare.');
          $f4->select_lt();
     $f3 = new input(array('','hsino4',1,'Mostra articolo','Articolo da mostrare o no','sn'));
          $f3->field();
      $f4 =    new DB_sel_lt('art','aprog','','atit','htit4','astat','atit','Articolo 4','Titolo articolo da mostrare.');
          $f4->select_lt();
	echo "</fieldset>";
	echo "</div>";


echo "</div>";	// tabs
echo  "</form>";
      break;
 //==================================================================================

// modifica
    case 'modifica':
     $btx = new bottoni_str_par('Articoli in colonne - modifica','arc','write_arc.php',array('modifica','ritorno'));
     $btx->btn();
     $sql = "SELECT * FROM `".DB::$pref."arc`
               WHERE `hid` = $hid ";
     foreach($PDO->query($sql) as $row)
	require('fields_arc.php');

	echo "<div class='row' >";
	echo	"<fieldset>";
     $f1 = new input(array($hid,'hid',0,'','','h'));
          $f1->field();
     $ts = new DB_tip_i('stato','hstat',$hstat,'Stato record','Attivo/sospeso');
          $ts->select();
     $f1 = new input(array($hprog,'hprog',3,'Progressivo','Per ordinamento','i'));
          $f1->field();
      $t = new getTmp($htmp,'htmp','Template','Scelta del template che utilizza gli articoli in colonna');
          $t->getTemplate();
     $f3 = new input(array($hcod,'hcod',20,'Codice','Codice articoli in colonna','ia'));
          $f3->field();
     $f4 = new input(array($hdes,'hdes',30,'Descrizione','Descrizione articoli in colonna','i'));
			$f4->field();
		  //--- 23.03.21
     $f3 = new input(array($htit_sn,'htit_sn',1,'Mostra Titolo','Mostrare un titolo s/n','sn'));
          $f3->field();
     $f3 = new input(array($htit,'htit',50,'Titolo','Titolo da mostrare','i'));
          $f3->field();
     $f3 = new input(array($htext,'htext',50,'Testo','Testo da mostrare','tx'));
          $f3->field();
		  //---
	 $f3 = new input(array($hsino1,'hsino1',1,'Mostra articolo','','sn'));
          $f3->field();
      $f4 =    new DB_sel_lt('art','aprog',$htit1,'atit','htit1','astat','atit','Articolo 1','Titolo articolo da mostrare.');
          $f4->select_lt();
     $f3 = new input(array($hsino2,'hsino2',1,'Mostra articolo','','sn'));
          $f3->field();
      $f4 =    new DB_sel_lt('art','aprog',$htit2,'atit','htit2','astat','atit','Articolo 2','Titolo articolo da mostrare.');
          $f4->select_lt();
     $f3 = new input(array($hsino3,'hsino3',1,'Mostra articolo','','sn'));
          $f3->field();
      $f4 =    new DB_sel_lt('art','aprog',$htit3,'atit','htit3','astat','atit','Articolo 3','Titolo articolo da mostrare.');
          $f4->select_lt();
     $f3 = new input(array($hsino4,'hsino4',1,'Mostra articolo','','sn'));
          $f3->field();
      $f4 =    new DB_sel_lt('art','aprog',$htit4,'atit','htit4','astat','atit','Articolo 4','Titolo articolo da mostrare.');
          $f4->select_lt();
	echo "</fieldset>";
	echo "</div>";

	echo "</div>";	// tabs
     echo    "</form>";
     break;
 //==================================================================================

 // copia
     case 'copia':
      $btx = new bottoni_str_par('Articoli in colonne - copia','arc','write_arc.php',array('copia','ritorno'));
      $btx->btn();
      $sql = "SELECT * FROM `".DB::$pref."arc`
                WHERE `hid` = $hid ";
      foreach($PDO->query($sql) as $row)
 	require('fields_arc.php');

 	echo "<div class='row' >";
 	echo	"<fieldset>";
      $f1 = new input(array($hid,'hid',0,'','','h'));
           $f1->field();
      $ts = new DB_tip_i('stato','hstat',$hstat,'Stato record','Attivo/sospeso');
           $ts->select();
           $arc = new DB_ins('arc','hprog');
           $f1 = new input(array($arc->insert(),'hprog',3,'Progressivo','Per ordinamento','i'));
                $f1->field();
       $t = new getTmp($htmp,'htmp','Template','Scelta del template che utilizza gli articoli in colonna');
           $t->getTemplate();
      $f3 = new input(array($hcod,'hcod',20,'Codice','Codice articoli in colonna','ia'));
           $f3->field();
      $f4 = new input(array($hdes,'hdes',30,'Descrizione','Descrizione articoli in colonna','i'));
 			$f4->field();
 		  //--- 23.03.21
      $f3 = new input(array($htit_sn,'htit_sn',1,'Mostra Titolo','Mostrare un titolo s/n','sn'));
           $f3->field();
      $f3 = new input(array($htit,'htit',50,'Titolo','Titolo da mostrare','i'));
           $f3->field();
      $f3 = new input(array($htext,'htext',50,'Testo','Testo da mostrare','tx'));
           $f3->field();
 		  //---
 	 $f3 = new input(array($hsino1,'hsino1',1,'Mostra articolo','','sn'));
           $f3->field();
       $f4 =    new DB_sel_lt('art','aprog',$htit1,'atit','htit1','astat','atit','Articolo 1','Titolo articolo da mostrare.');
           $f4->select_lt();
      $f3 = new input(array($hsino2,'hsino2',1,'Mostra articolo','','sn'));
           $f3->field();
       $f4 =    new DB_sel_lt('art','aprog',$htit2,'atit','htit2','astat','atit','Articolo 2','Titolo articolo da mostrare.');
           $f4->select_lt();
      $f3 = new input(array($hsino3,'hsino3',1,'Mostra articolo','','sn'));
           $f3->field();
       $f4 =    new DB_sel_lt('art','aprog',$htit3,'atit','htit3','astat','atit','Articolo 3','Titolo articolo da mostrare.');
           $f4->select_lt();
      $f3 = new input(array($hsino4,'hsino4',1,'Mostra articolo','','sn'));
           $f3->field();
       $f4 =    new DB_sel_lt('art','aprog',$htit4,'atit','htit4','astat','atit','Articolo 4','Titolo articolo da mostrare.');
           $f4->select_lt();
 	echo "</fieldset>";
 	echo "</div>";

 	echo "</div>";	// tabs
      echo    "</form>";
      break;
  //==================================================================================
// cancellazione
    case 'cancella' :
$btg = new bottoni_str_par('Modulo articolo in colonne - conferma cancellazione','arc','write_arc.php',array('cancella','ritorno'));
     $btg->btn();
      $sql = "SELECT * FROM `".DB::$pref."arc`
               WHERE `hid` = $hid  ";
	echo	"<fieldset>";
     foreach($PDO->query($sql) as $row)
	require('fields_arc.php');
      $f0 = new input(array($hid,'hid',0,'','','h'));
	 	$f0->field();
      $f1 = new input(array($hprog,'hprog',3,'Progressivo','','r'));
	 	$f1->field();
      $ts = new input(array($hstat,'hstat',1,'Stato record','','r'));
	 	$ts->field();
      $f2 = new input(array($htmp,'htmp',20,'Template','','r'));
	 	$f2->field();
      $f3 = new input(array($hcod,'hcod',20,'Codice','','r'));
	 	$f3->field();
      $f4 = new input(array(htmlspecialchars($hdes, ENT_QUOTES),'hdes',30,'Descrizione','','r'));
      	$f4->field();
	 echo "</fieldset>";
      echo    "</form>";
      break;

    case 'ritorno' :
          array_push($_SESSION['esito'],'2');
          $loc = "location:admin.php?".$_SESSION['location']."";
               header($loc);
    break;

     case 'chiudi':
          $loc = "location:admin.php?urla=widget.php&pag=";
               header($loc);
          break;

    default:
          echo "Operazione invalida";

    }

     echo "</section>";
	 echo "</body>";
ob_end_flush();
?>
