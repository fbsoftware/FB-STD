<?php session_start();      ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2025 - 2026 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------
   * gestione tabella 'lay'
   15/03/2022	aggiunta copia, nuove include in "write"
============================================================================= */
require_once('init_admin.php');
require_once("post_".$_SESSION['tab'].".php");
$azione  =$_POST['submit'];      
//print_r($_POST);//debug

// test scelta effettuata sul pgm chiamante
             $scelta = new testSiScelta($lid,$azione);
               $scelta->alert_s();

echo "<body class='admin' data-theme='".TMP::$tcolor."'>";
echo "<section id='upd' class='container-fluid'";
echo "<div class='container form-horizontal'>";
echo "<div class='row container'>";
switch ($azione)
{
// inserimento
    case 'nuovo':
    $param	= array('nuovo','ritorno') ;
     $btx = new bottoni_str_par('Layout - nuovo','lay','upd2_lay.php',$param);
          $btx->btn();
      echo  "<fieldset>";
     $ts = new DB_tip_i('tipo','ltipo','','Tipo modulo','Tipo modulo per comporre la pagina');
          $ts->select();
	echo  "</fieldset>";
	echo  "</form>";
      break;

// modifica
    case 'modifica':
$btx      = new bottoni_str_par('Layout - modifica','lay','write_lay.php',array('modifica','ritorno'));
            $btx->btn();
     $sql = "SELECT * FROM `".DB::$pref."lay`
               WHERE `lid` = $lid ";
// transazione
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();
foreach($PDO->query($sql) as $row)
require('fields_lay.php');

echo  "<fieldset>";
     $f1 = new input(array($lid,'lid',3,'','','h'));
          $f1->field();
     $f1 = new input(array($lprog,'lprog',3,'Progressivo','Per ordinamento','i'));
          $f1->field();
     $ts = new DB_tip_i('stato','lstat',$lstat,'Stato record','Attivo/sospeso');
          $ts->select();
     $t2 = new getTmp($ltmp,'ltmp','Tema','Scelta del tema');
          $t2->getTemplate();
     $f1 = new input(array($lpage,'lpage',30,'Pagina','Pagina del sito','i'));
          $f1->field();
// scelta del file in base al codice tipo di modulo =============================================
switch ($ltipo) 
{
case 'artslide':
               $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo in slide');
          		$arg->select_label();
			break;
case 'artacc':
               $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo in accordion');
          		$arg->select_label();
			break;
case 'arttab':
               $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo in tab');
          		$arg->select_label();
			break;
case 'artsingle':
               $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo semplice');
          		$arg->select_label();
			break;
case 'article':
               $arg = new DB_sel_l('art','aprog',$lcod,'atit','lcod','astat','atit','Codice','Articolo semplice');
          		$arg->select_label();
			break;
case 'artimg':
               $arg = new DB_sel_l('aim','icod',$lcod,'icod','lcod','istat','ides','Codice','Articolo con immagine');
          		$arg->select_label();
			break;
case 'artcol':
               $arg = new DB_sel_l('arc','hprog',$lcod,'hcod','lcod','hstat','hcod','Codice','Articolo in colonne');
          		$arg->select_label();
			break;
case 'glyph':
               $arg = new DB_sel_l('gly','gprog',$lcod,'gcod','lcod','gstat','gcod','Codice','Modulo con glifi');
          		$arg->select_label();
			break;
case 'promo':
               $arg = new DB_sel_l('prm','oprog',$lcod,'ocod','lcod','ostat','ocod','Codice','Modulo con glifi');
          		$arg->select_label();
			break;
case 'portfolio':
               $arg = new DB_sel_l('por','pprog',$lcod,'pcod','lcod','pstat','pcod','Codice','Modulo portfolio');
          		$arg->select_label();
			break;
case 'slide':
               $arg = new DB_sel_l('sld','slprog',$lcod,'slcod','lcod','slstat','slcod','Codice','Modulo slide di immagini');
          		$arg->select_label();
			break;
case 'header':
     		$f1 = new input(array($lcod,'lcod',30,'Codice','Header con navigatore','i'));
          		$f1->field();
			break;
case 'footer':
               $arg = new DB_sel_l('foo','fprog',$lcod,'fcod','lcod','fstat','fcod','Codice','Modulo footer');
          		$arg->select_label();
			break;
case 'contatti':
               $arg = new DB_sel_l('ctt','eprog',$lcod,'ecod','lcod','estat','ecod','Codice','Modulo contatti');
          		$arg->select_label();
               break;
case 'pag':
               $arg = new DB_sel_l('pag','jprog',$lcod,'jcod','lcod','jstat','jcod','Codice','Nome pagina');
          		$arg->select_label();
               break;
default:
	          echo	"Tipo modulo errato=".$ltipo;
			break;
}
// =======================================================================================
     $f4 = new input(array($ldesc,'ldesc',50,'Descrizione','Descrizione modulo','i'));
          $f4->field();
     $f1 = new input(array($ltipo,'ltipo',3,'Tipo modulo','Tipo modulo per comporre la pagina','r'));
          $f1->field();
     $f4 = new input(array($linclude,'linclude',50,'Programma','Programma da eseguire','r'));
          $f4->field();

	echo  "</fieldset>";
	echo  "</form>";
     break;

     // copia
         case 'copia':
     $btx      = new bottoni_str_par('Layout - copia','lay','write_lay.php',array('copia','ritorno'));
                 $btx->btn();
          $sql = "SELECT * FROM `".DB::$pref."lay`
                    WHERE `lid` = $lid ";
     // transazione
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction();
     foreach($PDO->query($sql) as $row)
     require('fields_lay.php');

     echo  "<fieldset>";
          $f1 = new input(array($lid,'lid',3,'','','h'));
               $f1->field();
               $xdb = new DB_ins('lay','lprog');
               $f1 = new input(array($xdb->insert(),'lprog',3,'Progressivo','Per ordinamento','i'));
                    $f1->field();
          $ts = new DB_tip_i('stato','lstat',$lstat,'Stato record','Attivo/sospeso');
               $ts->select();
	$arg = new DB_sel_l('tmp','tprog',$ltmp,'tcod','lcod','tstat','tcod','Tema','Tema del sito');
		$arg->select_label();
          $f1 = new input(array($lpage,'lpage',30,'Pagina','Pagina del sito','i'));
               $f1->field();
     // scelta del file in base al codice tipo di modulo =============================================
     switch ($ltipo) {
     case 'artslide':
                    $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo in slide');
               		$arg->select_label();
     			break;
     case 'artacc':
                    $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo in accordion');
               		$arg->select_label();
     			break;
     case 'arttab':
                    $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo in tab');
               		$arg->select_label();
     			break;
     case 'artsingle':
                    $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo semplice');
               		$arg->select_label();
     			break;
     case 'article':
                    $arg = new DB_sel_l('art','aprog',$lcod,'atit','lcod','astat','atit','Codice','Articolo semplice');
               		$arg->select_label();
     			break;
     case 'artimg':
                    $arg = new DB_sel_l('aim','iprog',$lcod,'icod','lcod','istat','icod','Codice','Articolo con immagine');
               		$arg->select_label();
     			break;
     case 'artcol':
                    $arg = new DB_sel_l('arc','hprog',$lcod,'hcod','lcod','hstat','hcod','Codice','Articolo in colonne');
               		$arg->select_label();
     			break;
     case 'glyph':
                    $arg = new DB_sel_l('gly','gprog',$lcod,'gcod','lcod','gstat','gcod','Codice','Modulo con glifi');
               		$arg->select_label();
     			break;
     case 'promo':
                    $arg = new DB_sel_l('prm','oprog',$lcod,'ocod','lcod','ostat','ocod','Codice','Modulo con glifi');
               		$arg->select_label();
     			break;
     case 'portfolio':
                    $arg = new DB_sel_l('por','pprog',$lcod,'pcod','lcod','pstat','pcod','Codice','Modulo portfolio');
               		$arg->select_label();
     			break;
     case 'slide':
                    $arg = new DB_sel_l('sld','slprog',$lcod,'slcod','lcod','slstat','slcod','Codice','Modulo slide di immagini');
               		$arg->select_label();
     			break;
     case 'header':
          		$f1 = new input(array($lcod,'lcod',30,'Codice','Header con navigatore','i'));
               		$f1->field();
     			break;
     case 'footer':
                    $arg = new DB_sel_l('foo','fprog',$lcod,'fcod','lcod','fstat','fcod','Codice','Modulo footer');
               		$arg->select_label();
     			break;
     case 'contatti':
                    $arg = new DB_sel_l('ctt','eprog',$lcod,'ecod','lcod','estat','ecod','Codice','Modulo contatti');
               		$arg->select_label();
                    break;
     default:
     	          echo	"Tipo modulo errato=".$ltipo;
     			break;
     }
     // =======================================================================================
          $f4 = new input(array($ldesc,'ldesc',50,'Descrizione','Descrizione modulo','i'));
               $f4->field();
          $f1 = new input(array($ltipo,'ltipo',3,'Tipo modulo','Tipo modulo per comporre la pagina','r'));
               $f1->field();
          $f4 = new input(array($linclude,'linclude',50,'Programma','Programma da eseguire','r'));
               $f4->field();

     	echo  "</fieldset>";
     	echo  "</form>";
          break;

// cancellazione
    case 'cancella' :
$btx = new bottoni_str_par('Layout - conferma cancellazione','lay','write_lay.php',array('cancella','ritorno'));
     $btx->btn();
      $sql = "SELECT * FROM `".DB::$pref."lay`
               WHERE `lid` = $lid  ";
// transazione
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();
foreach($PDO->query($sql) as $row)
require('fields_lay.php');

echo  "<fieldset>";
      $f0 = new input(array($lid,'lid',0,'','','h'));
	 	$f0->field();
      $f1 = new input(array($lprog,'lprog',3,'Progressivo','','r'));
	 	$f1->field();
      $ts = new input(array($lstat,'lstat',1,'Stato record','','r'));
	 	$ts->field();
      $f2 = new input(array($ltipo,'ltipo',5,'Tipo','','r'));
	 	$f2->field();
      $f3 = new input(array($lcod,'lcod',20,'Codice','','r'));
	 	$f3->field();
      $f4 = new input(array(utf8_decode($ldesc),'ldesc',30,'Descrizione','','r'));
      	$f4->field();
      echo    "</fieldset></form>";
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
          array_push($_SESSION['esito'],'1');

}

     echo "</section>";
	 echo "</body>";
ob_end_flush();
?>
