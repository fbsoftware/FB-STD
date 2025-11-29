<?php session_start();      ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------
   * gestione componente articoli slide-tab-normali-singoli
	25.03.21	aggiunto si-no titolo sezione
  15/03/2022	aggiunta copia, nuove include in "write"
============================================================================= */
require_once('init_admin.php');
require_once("post_".$_SESSION['tab'].".php");
$azione  =$_POST['submit'];    // print_r($_POST);//debug

// test scelta effettuata sul pgm chiamante
$scelta = new testSiScelta($did,$azione);
  $scelta->alert_s();

echo "<body class='admin' data-theme='".TMP::$tcolor."'>";
echo "<section id='upd' class='container-fluid'>";

switch ($azione)
{
// inserimento
    case 'nuovo':

     $btx      = new bottoni_str_par('Articoli normali,slide,tab - nuovo','asl','write_asl.php',array('nuovo','ritorno'));
     $btx->btn();
    echo	"<fieldset class='f-flex fd-column'>";
      $xdb = new DB_ins('asl','dprog');
           $nr=$xdb->insert();
      $f1 = new input(array($xdb->insert(),'dprog',3,'Progressivo','Per ordinamento','i'));
           $f1->field();
      $ts = new DB_tip_i('stato','dstat','','Stato record','Attivo-sospeso');
          $ts->select();
          //------------------------------------------------------
      $t = new getTmp('','dtmp','Template','Scelta del template');
          $t->getTemplate();
          //------------------------------------------------------
      $f1 = new input(array('','dcod',20,'Codice','Codice modulo','ia'));
           $f1->field();
      $f1 = new input(array('','ddes',50,'Descrizione','Descrizione modulo','i'));
           $f1->field();
// 25.03.21
     $f3 = new input(array('','dtit_sn',1,'Mostra Titolo','Mostrare il titolo accordion s/n','sn'));
          $f3->field();
     $f3 = new input(array('','dtit',50,'Titolo','Titolo accordion','i'));
          $f3->field();
     $f3 = new input(array('','dtext',50,'Testo','Testo accordion','tx'));
          $f3->field();
//---------------------
      $ts = new DB_tip_i('tipo','dtipo','','Tipo modulo','Tipo modulo: slide o tab');
          $ts->select();
      $f4 =    new DB_sel_lt('cap','cprog','','ccod','dcap','cstat','cdesc','Capitolo','Capitolo di cui usare gli articoli.');
          $f4->select_lt();

      $f4 = new DB_sel_lt('art','aprog','','atit','dart','astat','atit','Articolo','Articolo da mostrare.');
          $f4->select_lt();
	echo	"</fieldset>";
     echo  "</form>";
      break;

// modifica
    case 'modifica':
     $btx = new bottoni_str_par('Articoli normali,slide,tab - modifica','asl','write_asl.php',array('modifica','ritorno'));
          $btx->btn();
echo	"<fieldset class='f-flex fd-column'>";
    $sql = "SELECT * FROM `".DB::$pref."asl`
    			WHERE `did` = $did ";
     // transazione
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction();
     foreach($PDO->query($sql) as $row)
     {
     require('fields_asl.php');
 //   print_r($row);//debug
      $f4 = new input(array($did,'did',5,'','','h'));
          $f4->field();
      $f1 = new input(array($dprog,'dprog',3,'Progressivo','Per ordinamento','i'));
           $f1->field();
      $ts = new DB_tip_i('stato','dstat',$dstat,'Stato record','Attivo-sospeso');
          $ts->select();
      $t = new getTmp($dtmp,'dtmp','Template','Scelta del template');
          $t->getTemplate();
      $f1 = new input(array($dcod,'dcod',20,'Codice','Codice modulo','ia'));
           $f1->field();
      $f1 = new input(array($ddes,'ddes',50,'Descrizione','Descrizione modulo','i'));
           $f1->field();
// 25.03.21
     $f3 = new input(array($dtit_sn,'dtit_sn',1,'Mostra Titolo','Mostrare il titolo accordion s/n','sn'));
          $f3->field();
     $f3 = new input(array($dtit,'dtit',50,'Titolo','Titolo accordion','i'));
          $f3->field();
     $f3 = new input(array($dtext,'dtext',50,'Testo','Testo accordion','tx'));
          $f3->field();
//---------------------
		   $ts = new DB_tip_i('tipo','dtipo',$dtipo,'Tipo modulo','Tipo modulo: slide o tab');
          $ts->select();
      $f4 =    new DB_sel_lt('cap','cprog',$dcap,'ccod','dcap','cstat','cdesc','Capitolo','Capitolo di cui usare gli articoli.');
          $f4->select_lt();

      $f4 = new DB_sel_lt('art','aprog',$dart,'atit','dart','astat','atit','Articolo','Articolo da mostrare.');
          $f4->select_lt();
	echo	"</fieldset>";
echo    "</form>";
     }
break;

// copia
    case 'copia':
     $btx = new bottoni_str_par('Articoli normali,slide,tab - copia','asl','write_asl.php',array('copia','ritorno'));
          $btx->btn();
echo	"<fieldset class='f-flex fd-column'>";
    $sql = "SELECT * FROM `".DB::$pref."asl`
    			WHERE `did` = $did ";
     // transazione
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction();
     foreach($PDO->query($sql) as $row)
     {
     require('fields_asl.php');
 //   print_r($row);//debug
      $f4 = new input(array($did,'did',5,'','','h'));
          $f4->field();
          $xdb = new DB_ins('asl','dprog');
               $nr=$xdb->insert();
          $f1 = new input(array($xdb->insert(),'dprog',3,'Progressivo','Per ordinamento','i'));
               $f1->field();
      $ts = new DB_tip_i('stato','dstat',$dstat,'Stato record','Attivo-sospeso');
          $ts->select();
      $t = new getTmp($dtmp,'dtmp','Template','Scelta del template');
          $t->getTemplate();
      $f1 = new input(array($dcod,'dcod',20,'Codice','Codice modulo','ia'));
           $f1->field();
      $f1 = new input(array($ddes,'ddes',50,'Descrizione','Descrizione modulo','i'));
           $f1->field();
// 25.03.21
     $f3 = new input(array($dtit_sn,'dtit_sn',1,'Mostra Titolo','Mostrare il titolo accordion s/n','sn'));
          $f3->field();
     $f3 = new input(array($dtit,'dtit',50,'Titolo','Titolo accordion','i'));
          $f3->field();
     $f3 = new input(array($dtext,'dtext',50,'Testo','Testo accordion','tx'));
          $f3->field();
//---------------------
		   $ts = new DB_tip_i('tipo','dtipo',$dtipo,'Tipo modulo','Tipo modulo: slide o tab');
          $ts->select();
      $f4 =    new DB_sel_lt('cap','cprog',$dcap,'ccod','dcap','cstat','cdesc','Capitolo','Capitolo di cui usare gli articoli.');
          $f4->select_lt();

      $f4 = new DB_sel_lt('art','aprog',$dart,'atit','dart','astat','atit','Articolo','Articolo da mostrare.');
          $f4->select_lt();
	echo	"</fieldset>";
echo    "</form>";
     }
break;

// cancellazione
    case 'cancella' :
     $btx      = new bottoni_str_par('Articoli normali,slide,tab - conferma cancellazione','asl','write_asl.php',array('cancella','ritorno'));
     $btx->btn();
echo	"<fieldset class='f-flex fd-column'>";
      $sql = "SELECT * FROM `".DB::$pref."asl`
                           WHERE `did` = $did  ";
     // transazione
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction();
     foreach($PDO->query($sql) as $row)
	require('fields_asl.php');
     {
      $f0 = new input(array($did,'did',0,'','','h'));
	 	$f0->field();
      $f1 = new input(array($dprog,'dprog',3,'Progressivo','','r'));
	 	$f1->field();
      $ts = new input(array($dstat,'dstat',1,'Stato record','','r'));
	 	$ts->field();
      $f2 = new input(array($dtipo,'dtipo',5,'Tipo modulo','','r'));
	 	$f2->field();
      $f3 = new input(array($dcod,'dcod',20,'Codice','','r'));
	 	$f3->field();
      $f4 = new input(array(htmlspecialchars($ddes, ENT_QUOTES),'ddes',30,'Descrizione','','r'));
      	$f4->field();
     }
     echo	"</fieldset>";
     echo    "</form>";
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
