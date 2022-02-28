<?php session_start();    ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 2.0.1
   * copyright	Copyright (C) 2022 - 2023 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
=============================================================================
   *
============================================================================= */
require_once('init_admin.php');
require_once('post_mnu.php');
$_SESSION['esito'] = array();     // per la gestione dei messaggi

// test scelta effettuata sul pgm chiamante
if (isset($_POST['submit']))   $azione  =$_POST['submit'];
if (($azione == 'modifica' || $azione == 'cancella' ) && $bid == '')
	{
	array_push($_SESSION['esito'],'4');
	header('location:admin.php?'.$_SESSION['location'].'');
	}
echo "<body class='admin' data-theme='".TMP::$tcolor."'>";

// toolbar
switch ($azione)
{	case '':
    case 'chiudi' :
	header('location:admin.php?urla=widget.php&pag=');
	break;
//==================================================================================
    case 'nuovo':
	 //   toolbar
	$param  = array('nuovo','ritorno');
	$btx    = new bottoni_str_par('Menù - inserimento','mnu','write_mnu.php',$param);
		$btx->btn();
      $mnu = new DB_ins('mnu','bprog');
      $xxx = $mnu->insert();
echo  "<fieldset>";
$f2 = new input(array($xxx,'bprog',03,'Progressivo','','i'));
     $f2->field();
      $ts = new DB_tip_i('stato','bstat','','Stato','');
		$ts->select();
      $f4 = new field('','bmenu',20,'Nome');
		$f4->field_i();
      $tmnu = new DB_tip_i('menu','btipo','','Aspetto','');
		$tmnu->select();
      $f5 = new field('','btesto',25,'Titolo');
		$f5->field_i();
	$f2 = new input(array(0,'bselect',1,'Selezionato','','sn'));
		$f2->field();
echo  "</fieldset>";
echo  "</form>";
      break;
//==================================================================================
    case 'modifica':  // toolbar modifica
		$param  = array('modifica','ritorno');
	$btx    = new bottoni_str_par('Menù - modifica','mnu','write_mnu.php',$param);
		$btx->btn();

	echo  "<fieldset>";
      $sql = "SELECT * FROM `".DB::$pref."mnu`
			   WHERE `bid` = ".$bid."  ";
     foreach($PDO->query($sql) as $row)
	 {
      require('fields_mnu.php');
     $f1 = new input(array($bid,'bid',1,'','','h'));
		$f1->field();
     $ts = new DB_tip_i('stato','bstat',$bstat,'Stato record','');
		$ts->select();
     $f3 = new field($bprog,'bprog',3,'Progressivo');
		$f3->field_i();
     $f4 = new field($bmenu,'bmenu',20,'Nome');
		$f4->field_i();
     $tt = new DB_tip_i('menu','btipo',$btipo,'Tipo menu','');
		$tt->select();
     $f6 = new field($btesto,'btesto',50,'Titolo');
		$f6->field_i();
	$f2 = new input(array($bselect,'bselect',1,'Selezionato','','sn'));
		$f2->field();
	 }
      echo "</fieldset>";
	  echo "</form>";

      break;
//==================================================================================

    case 'cancella' :
	// toolbar
	$param  = array('cancella','ritorno');
	$btx    = new bottoni_str_par('Menù - conferma cancellazione','mnu','write_mnu.php',$param);
		$btx->btn();

      $sql = "SELECT * FROM `".DB::$pref."mnu`
				WHERE `bid` = $bid  ";
	foreach($PDO->query($sql) as $row)
	{
	require('fields_mnu.php');
	echo  "<fieldset>";
     $f1 = new field($bid,'bid',1,'');
		$f1->field_h();
     $ts = new field($bstat,'bstat',1,'Stato record');
		$ts->field_r();
     $f3 = new field($bprog,'bprog',3,'Progressivo');
		$f3->field_r();
     $f4 = new field($bmenu,'bmenu',20,'Nome');
		$f4->field_r();
     $tt = new field($btipo,'btipo',20,'Stato record');
		$tt->field_r();
     $f6 = new field($btesto,'btesto',50,'Titolo');
		$f6->field_r();
     $f7 = new field($bselect,'bselect',1,'Selezionato');
		$f7->field_r();
	}
echo  "</fieldset></form>";
      break;
//==================================================================================

      default:
              echo "upd_mnu.php - Operazione invalida: azione=".$azione;
}
echo "</body>";
ob_end_flush();
?>
