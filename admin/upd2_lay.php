<?php  session_start();    ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.0
   * copyright	Copyright (C) 2012 - 2013 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * Layout del sito
============================================================================= */
require_once('init_admin.php');
require_once("post_".$_SESSION['tab'].".php");
$azione=$_POST['submit'];

echo "<body class='admin' data-theme='".TMP::$tcolor."'>";
// toolbar
switch ($azione)
{
case 'ritorno':
     array_push($_SESSION['esito'],'2');
     $loc = "location:admin.php?".$_SESSION['location']."";
     header($loc);
     break;

case 'nuovo':
	$param = array('nuovo','ritorno');
	$btx   = new bottoni_str_par('Layout sito','nav','write_lay.php',$param);
     $btx->btn();
      echo  "<fieldset>";
    $xdb = new DB_ins('lay','lprog');
	$f1 = new input(array($xdb->insert(),'lprog',3,'Progressivo','Per ordinamento','i'));
          $f1->field();
	$ts = new DB_tip_i('stato','lstat','','Stato record','Attivo/sospeso');
          $ts->select();
	$arg = new DB_sel_l('tmp','tprog','','tcod','lcod','tstat','tcod','Tema','Tema del sito');
		$arg->select_label();
	$f1 = new input(array('','lpage',30,'Pagina','Pagina del sito','i'));
          $f1->field();

// scelta del file in base al tipo di modulo =============================================
switch ($ltipo) {
case 'artslide':
               $arg = new DB_sel_l('asl','dprog','','dcod','lcod','dstat','dcod','Codice','Articolo in slide');
          		$arg->select_label();
			break;
case 'arttab':
               $arg = new DB_sel_l('asl','dprog','','dcod','lcod','dstat','dcod','Codice','Articolo in tab');
          		$arg->select_label();
			break;
case 'artacc':
               $arg = new DB_sel_l('asl','dprog','','dcod','lcod','dstat','dcod','Codice','Articolo in accordion');
          		$arg->select_label();
			break;
case 'artsingle':  // da verificare, altrimenti usare -article-
               $arg = new DB_sel_l('art','aprog','','atit','lcod','astat','atit','Codice','Articolo semplice');
          		$arg->select_label();
			break;
case 'article':
               $arg = new DB_sel_l('art','aprog','','atit','lcod','astat','atit','Codice','Articolo semplice');
          		$arg->select_label();
			break;
case 'artimg':
               $arg = new DB_sel_l('aim','iprog','','icod','lcod','istat','icod','Codice','Articolo con immagine');
          		$arg->select_label();
			break;
case 'artcol':
               $arg = new DB_sel_l('arc','hprog','','hcod','lcod','hstat','hcod','Codice','Articolo in colonne');
          		$arg->select_label();
			break;
case 'glyph':
               $arg = new DB_sel_l('gly','gprog','','gcod','lcod','gstat','gcod','Codice','Modulo con glifi');
          		$arg->select_label();
			break;
case 'promo':
               $arg = new DB_sel_l('prm','oprog','','ocod','lcod','ostat','ocod','Codice','Modulo promo');
          		$arg->select_label();
			break;
case 'portfolio':
               $arg = new DB_sel_l('por','pprog','','pcod','lcod','pstat','pcod','Codice','Modulo portfolio');
          		$arg->select_label();
			break;
case 'slide':
               $arg = new DB_sel_l('sld','slprog','','slcod','lcod','slstat','slcod','Codice','Modulo slide di immagini');
          		$arg->select_label();
			break;
case 'header':
     		$f1 = new input(array('','lcod',30,'Codice','Header con navigatore','i'));
          		$f1->field();
               break;
case 'footer':
               $arg = new DB_sel_l('foo','fprog','','fcod','lcod','fstat','fcod','Codice','Modulo footer');
          		$arg->select_label();
               break;
case 'contatti':
               $arg = new DB_sel_l('ctt','eprog','','ecod','lcod','estat','ecod','Codice','Modulo contatti');
          		$arg->select_label();
               break;
case 'izoom':
				$arg = new DB_sel_l('zim','zprog','','zcod','lcod','zstat','zcod','Codice','Immagine zoomabile');
				   $arg->select_label();
				break;
case 'space':
				$arg = new DB_sel_l('spz','rprog','','rcod','lcod','rstat','rcod','Codice','Spaziature');
					$arg->select_label();
				break;
case 'pag':
               $arg = new DB_sel_l('pag','jprog','','jcod','lcod','jstat','jcod','Codice','Nome pagina');
          		$arg->select_label();
               break;
default:
	          echo	"Codice errato=".$ltipo;
	break;
}

			$f4 = new input(array('','ldesc',50,'Descrizione','Descrizione modulo','i'));
				$f4->field();
          	$f3 = new input(array($ltipo,'ltipo',30,'Tipo','Codice per comporre la pagina','r'));
               	$f3->field();
	break;			

case 'modifica':
	$param = array('modifica','ritorno');
	$btx   = new bottoni_str_par('Layout sito','lay','write_lay.php',$param);
     $btx->btn();
      echo  "<fieldset>";
	$f1 = new input(array($lprog,'lprog',3,'Progressivo','Per ordinamento','i'));
          $f1->field();
	$ts = new DB_tip_i('stato','lstat',$lstat,'Stato record','Attivo/sospeso');
          $ts->select();
	$arg = new DB_sel_l('tmp','tprog',$ltmp,'tcod','lcod','tstat','tcod','Tema','Tema del sito');
		$arg->select_label();
	$f1 = new input(array($lpage,'lpage',30,'Pagina','Pagina del sito','i'));
          $f1->field();
 // scelta del programma in base al tipo di modulo =============================================
switch ($ltipo) 
{
case 'artslide':
               $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo in slide');
          		$arg->select_label();
			break;
case 'arttab':
               $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo in tab');
          		$arg->select_label();
			break;
case 'artacc':
               $arg = new DB_sel_l('asl','dprog',$lcod,'dcod','lcod','dstat','dcod','Codice','Articolo in accordion');
          		$arg->select_label();
			break;
case 'artsingle':  // da verificare, altrimenti usare -article-
               $arg = new DB_sel_l('art','aprog',$lcod,'atit','lcod','astat','atit','Codice','Articolo semplice');
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
               $arg = new DB_sel_l('prm','oprog',$lcod,'ocod','lcod','ostat','ocod','Codice','Modulo promo');
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
case 'izoom':
				$arg = new DB_sel_l('zim','zprog',$lcod,'zcod','lcod','zstat','zcod','Codice','Immagine zoomabile');
				   $arg->select_label();
				break;
case 'space':
				$arg = new DB_sel_l('spz','rprog',$lcod,'rcod','lcod','rstat','rcod','Codice','Spaziature');
					$arg->select_label();
				break;
case 'pag':
               $arg = new DB_sel_l('pag','jprog',$lcod,'jcod','lcod','jstat','jcod','Codice','Nome pagina');
          		$arg->select_label();
               break;
default:
	          echo	"Codice errato=".$ltipo;
	break;
}
				$f4 = new input(array($ldesc,'ldesc',50,'Descrizione','Descrizione modulo','i'));
				$f4->field();
          	$f3 = new input(array($ltipo,'ltipo',30,'Tipo','Codice per comporre la pagina','r'));
               	$f3->field();
	break;	
	default:
	          echo	"Azione errata=".$azione;
	break;	
}
// =======================================================================================
	echo  "</fieldset>";
	echo  "</form>";
	echo "</body>";
	?>