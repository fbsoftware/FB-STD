<?php session_start();      ob_start();
/*** ========================================================================
	*   	TEMPLATE PER APP UPD_XXX.PHP
	*========================================================================
   * Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------
	18/8/19	uso dei tabs
  20/02/22  ignorato 'ecat'
============================================================================= */
 
require_once('init_admin.php');
require_once("editor.php");				// scelta editor
?>
 <!-- tabs -->
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>
<?php
require_once('post_ctt.php');			// nome tabella
$azione  =$_POST['submit'];

// test scelta effettuata sul pgm chiamante
     $_SESSION['esito'] = array();
if (($azione == 'modifica' ||$azione == 'cancella') && $eid < 1)
     {
     array_push($_SESSION['esito'],'4');
     header('location:admin.php?'.$_SESSION['location'].'');
     }
echo "<body class='admin' data-theme='".TMP::$tcolor."'>";
echo "<section id='upd_ctt'>";

switch ($azione)
{
 //==================================================================================

// inserimento
    case 'nuovo':
     $btx = new bottoni_str_par('Contatti-nuovo','ctt','write_ctt.php',array('nuovo','ritorno'));
          $btx->btn();
// testate di TABS
?>
	<div id="tabs">
  <ul>
	<li><a href="#tabs-0">Generale</a></li>
    <li><a href="#tabs-1">Contatti</a></li>
    <li><a href="#tabs-2">Note</a></li>
  </ul>
 <?php

	echo "<div id='tabs-0'>";
	echo "<fieldset>";
     $ins = new DB_ins('ctt','eprog');
     $f1 = new input(array($ins->insert(),'eprog',3,'Progressivo','Per ordinamento','i'));
          $f1->field();
     $ts = new DB_tip_i('stato','estat','','Stato','Attivo/sospeso');
          $ts->select();
	//-----------------------------------------------------------------
     $f3 = new input(array('','ecod',20,'Codice','','ia'));
          $f3->field();
     $f4 = new input(array('','edes',20,'Descrizione','','i'));
          $f4->field();
     $t2 = new getTmp('','etmp','Template','Scelta del template');
          $t2->getTemplate();
	//$f2 = new input(array('','ecat',20,'Categoria','','i'));
		//$f2->field();
	 $co = new DB_tip_i('tictt','etipo','','Tipo','');
		$co->select();
$tw = new select_file('images/','','eimg','Immagine','');
	$tw->image();
echo "</fieldset>";
echo "</div>";

	echo "<div id='tabs-1'>";
	$f2 = new input(array('','email',50,'Email','','i'));
		$f2->field();
	$f2 = new input(array('','epec',50,'PEC','','i'));
		$f2->field();
	$f2 = new input(array('','esito',50,'Sito','','i'));
		$f2->field();
	$f2 = new input(array('','etel',20,'Telefono','','i'));
		$f2->field();
	$f2 = new input(array('','efax',20,'Fax','','i'));
		$f2->field();
	$f2 = new input(array('','ecel',20,'Cellulare','','i'));
		$f2->field();
	$f2 = new input(array('','esede',50,'Sede','','i'));
		$f2->field();
echo "</div>";

	// per textarea
	echo "<div id='tabs-2'>";
	echo "<fieldset>";
     $f4 = new input(array('','enote',50,'Note','','tx'));
          $f4->field();
		echo "<script type='text/javascript'>CKEDITOR.replace('enote');	</script>";

echo "</fieldset>";
echo "</div>";

echo "</div>";	// tabs
echo  "</form>";
      break;
 //==================================================================================

// modifica
    case 'modifica':
     $btx = new bottoni_str_par('Contatti-modifica','ctt','write_ctt.php',array('modifica','ritorno'));
     $btx->btn();
     $sql = "SELECT * FROM `".DB::$pref."ctt`
               WHERE `eid` = $eid ";
// testate di TABS
?>
	<div id="tabs">
  <ul>
	<li><a href="#tabs-0">Generale</a></li>
    <li><a href="#tabs-1">Contatti</a></li>
    <li><a href="#tabs-2">Note</a></li>
  </ul>
 <?php
// tabs-0 generale ------------------------------------------------------------------
	echo "<div id='tabs-0' class='row'>";
	echo "<fieldset>";
    foreach($PDO->query($sql) as $row)
	require('fields_ctt.php');
     $f1 = new input(array($eid,'eid',0,'','','h'));
          $f1->field();
     $f1 = new input(array($eprog,'eprog',3,'Progressivo','Per ordinamento','i'));
          $f1->field();
     $ts = new DB_tip_i('stato','estat',$estat,'Stato','Attivo/sospeso');
          $ts->select();
     $f3 = new input(array($ecod,'ecod',20,'Codice','','ia'));
          $f3->field();
     $f4 = new input(array($edes,'edes',20,'Descrizione','','i'));
          $f4->field();
     $t2 = new getTmp($etmp,'etmp','Template','Scelta del template');
          $t2->getTemplate();
	//$f2 = new input(array($ecat,'ecat',20,'Categoria','','i'));
		//$f2->field();
	 $co = new DB_tip_i('tictt','etipo',$etipo,'Tipo','');
		$co->select();
	echo "<div>";	//--------------------
	$tw = new select_file('images/',$eimg,'eimg','Immagine','');
	$tw->image();
	echo "<img src='".$eimg."' alt='' border='0' align='left' width='100' height='' />";
	echo "</div>";	//--------------------
	echo "</fieldset>";
	echo "</div>";
// tabs-1 contatti -----------------------------------------------------------------
	echo "<div id='tabs-1' class='row'>";
	echo "<fieldset>";
	$f2 = new input(array($email,'email',50,'Email','','i'));
		$f2->field();
	$f2 = new input(array($epec,'epec',50,'PEC','','i'));
		$f2->field();
	$f2 = new input(array($esito,'esito',50,'Sito','','i'));
		$f2->field();
	$f2 = new input(array($etel,'etel',20,'Telefono','','i'));
		$f2->field();
	$f2 = new input(array($efax,'efax',20,'Fax','','i'));
		$f2->field();
	$f2 = new input(array($ecel,'ecel',20,'Cellulare','','i'));
		$f2->field();
	$f2 = new input(array($esede,'esede',50,'Sede','','i'));
		$f2->field();
	echo "</fieldset>";
	echo "</div>";
// tabs-2 note --------------------------------------------------------------------
	echo "<div id='tabs-2' class='row'>";
	echo "<fieldset>";
     $f4 = new input(array($enote,'enote',50,'Note','','tx'));
          $f4->field();
	echo "<script type='text/javascript'>CKEDITOR.replace('enote');	</script>";
	echo "</fieldset>";
	echo "</div>";
echo "</div>";		// tabs
 echo    "</form>";
     break;
 //==================================================================================

// cancellazione
    case 'cancella' :
$btg = new bottoni_str_par('Contatti-cancella','ctt','write_ctt.php',array('cancella','ritorno'));
     $btg->btn();
      $sql = "SELECT * FROM `".DB::$pref."ctt`
               WHERE `eid` = $eid  ";
	echo	"<fieldset>";
     foreach($PDO->query($sql) as $row)
	require('fields_ctt.php');
      $f0 = new input(array($eid,'eid',0,'','','h'));
	 	$f0->field();
      $f1 = new input(array($eprog,'eprog',3,'Progressivo','','r'));
	 	$f1->field();
      $ts = new input(array($estat,'estat',1,'Stato','','r'));
	 	$ts->field();
	//-----------------------------------------------------------------
     $f3 = new input(array($ecod,'',20,'Codice','','r'));
          $f3->field();
     $f4 = new input(array($edes,'',20,'Descrizione','','r'));
          $f4->field();
     $f3 = new input(array($etmp,'',20,'Template','','r'));
          $f3->field();
	 echo "</fieldset>";
	// per textarea
	echo	"<fieldset>";
     $f3 = new input(array($enote,'',50,'Note','','r'));
          $f3->field();
	echo "</fieldset>";

      echo    "</form>";
      break;

    case 'ritorno' :
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
