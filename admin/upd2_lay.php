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
	$t = new getTmp('','ltmp','Template','Scelta del template');
          $t->getTemplate();
	$f1 = new input(array('','lpage',30,'Pagina','Pagina del sito','i'));
          $f1->field();
// scelta del file in base al tipo di modulo =============================================
switch ($ltipo) {
case 'artslide':
               $arg = new DB_sel_l('asl','dprog','','dcod','lcod','dstat','dcod','Tipo modulo','Articolo in slide');
          		$arg->select_label();
			break;
case 'arttab':
               $arg = new DB_sel_l('asl','dprog','','dcod','lcod','dstat','dcod','Tipo modulo','Articolo in tab');
          		$arg->select_label();
			break;
case 'artacc':
               $arg = new DB_sel_l('asl','dprog','','dcod','lcod','dstat','dcod','Tipo modulo','Articolo in accordion');
          		$arg->select_label();
			break;
case 'artsingle':  // da verificare, altrimenti usare -article-
               $arg = new DB_sel_l('art','aprog','','atit','lcod','astat','atit','Titolo articolo','Articolo semplice');
          		$arg->select_label();
			break;
case 'article':
               $arg = new DB_sel_l('art','aprog','','atit','lcod','astat','atit','Titolo articolo','Articolo semplice');
          		$arg->select_label();
			break;
case 'artimg':
               $arg = new DB_sel_l('aim','iprog','','icod','lcod','istat','icod','Tipo modulo','Articolo con immagine');
          		$arg->select_label();
			break;
case 'artcol':
               $arg = new DB_sel_l('arc','hprog','','hcod','lcod','hstat','hcod','Tipo modulo','Articolo in colonne');
          		$arg->select_label();
			break;
case 'glyph':
               $arg = new DB_sel_l('gly','gprog','','gcod','lcod','gstat','gcod','Tipo modulo','Modulo con glifi');
          		$arg->select_label();
			break;
case 'promo':
               $arg = new DB_sel_l('prm','oprog','','ocod','lcod','ostat','ocod','Tipo modulo','Modulo promo');
          		$arg->select_label();
			break;
case 'portfolio':
               $arg = new DB_sel_l('por','pprog','','pcod','lcod','pstat','pcod','Tipo modulo','Modulo portfolio');
          		$arg->select_label();
			break;
case 'slide':
               $arg = new DB_sel_l('sld','slprog','','slcod','lcod','slstat','slcod','Tipo modulo','Modulo slide di immagini');
          		$arg->select_label();
			break;
case 'header':
     		$f1 = new input(array('','lcod',30,'Codice','Header con navigatore','i'));
          		$f1->field();
               break;
case 'footer':
               $arg = new DB_sel_l('foo','fprog','','fcod','lcod','fstat','fcod','Tipo modulo','Modulo footer');
          		$arg->select_label();
               break;
case 'contatti':
               $arg = new DB_sel_l('ctt','eprog','','ecod','lcod','estat','ecod','Tipo modulo','Modulo contatti');
          		$arg->select_label();
               break;
case 'izoom':
				$arg = new DB_sel_l('zim','zprog','','zcod','lcod','zstat','zcod','Tipo modulo','Immagine zoomabile');
				   $arg->select_label();
				break;
case 'space':
				$arg = new DB_sel_l('spz','rprog','','rcod','lcod','rstat','rcod','Tipo modulo','Spaziature');
					$arg->select_label();
				break;
default:
	          echo	"Tipo modulo errato=".$ltipo;
	break;
}
		       $f4 = new input(array('','ldesc',50,'Descrizione','Descrizione modulo','i'));
          $f4->field();
          $f3 = new input(array($ltipo,'ltipo',30,'Tipo','Tipo modulo per comporre la pagina','r'));
               $f3->field();
 // scelta del programma in base al tipo di modulo =============================================
switch ($ltipo) {
case 'artslide':
               $f4 = new input(array('artslide.php','linclude',50,'Programma','Programma da eseguire','r'));
          		$f4->field();
			break;
case 'arttab':
               $f4 = new input(array('arttab.php','linclude',50,'Programma','Programma da eseguire','r'));
          		$f4->field();
			break;
case 'artacc':
               $f4 = new input(array('artacc.php','linclude',50,'Programma','Programma da eseguire','r'));
          		$f4->field();
			break;
case 'artsingle':  // da verificare, altrimenti usare -article-
               $f4 = new input(array('artsingle.php','linclude',50,'Programma','Programma da eseguire','r'));
          		$f4->field();
			break;
case 'article':
               $f4 = new input(array('article.php','linclude',50,'Programma','Programma da eseguire','r'));
          		$f4->field();
			break;
case 'artimg':
               $f4 = new input(array('artimg.php','linclude',50,'Programma','Programma da eseguire','r'));
          		$f4->field();
			break;
case 'artcol':
               $f4 = new input(array('artcol.php','linclude',50,'Programma','Programma da eseguire','r'));
          		$f4->field();
			break;
case 'glyph':
               $f4 = new input(array('glyph.php','linclude',50,'Programma','Programma da eseguire','r'));
          		$f4->field();
			break;
case 'promo':
               $f4 = new input(array('promo.php','linclude',50,'Programma','Programma da eseguire','r'));
          		$f4->field();
			break;
case 'portfolio':
               $f4 = new input(array('portfolio.php','linclude',50,'Programma','Programma da eseguire','r'));
          		$f4->field();
			break;
case 'slide':
               $f4 = new input(array('slide.php','linclude',50,'Programma','Programma da eseguire','r'));
          		$f4->field();
			break;
case 'header':
               $f4 = new input(array('header.php','linclude',50,'Programma','Programma da eseguire','r'));
          		$f4->field();
               break;
case 'footer':
               $f4 = new input(array('footer.php','linclude',50,'Programma','Programma da eseguire','r'));
          		$f4->field();
               break;
case 'contatti':
               $f4 = new input(array('contatti.php','linclude',50,'Programma','Programma da eseguire','r'));
          		$f4->field();
               break;
case 'izoom':
				$f4 = new input(array('imgzoom.php','linclude',50,'Programma','Programma da eseguire','r'));
				   $f4->field();
				break;
case 'space':
					$f4 = new input(array('space.php','linclude',50,'Programma','Programma da eseguire','r'));
					   $f4->field();
					break;
				default:
	          echo	"Tipo modulo errato=".$ltipo;
	break;
}
// =======================================================================================
	echo  "</fieldset>";
	echo  "</form>";
	}
	echo "</body>";
	?>
