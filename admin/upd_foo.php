
<?php session_start();      ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------
   * control di tabella
	17/8/19	scelta editor
	15/03/2022	aggiunta copia, nuove include in "write"
============================================================================= */
require_once('init_admin.php');
require_once("editor.php");				// scelta editor
?>
<style>
.cke_reset	{
	width:1000px !important;
	}
</style>
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>

<?php
require_once("post_".$_SESSION['tab'].".php");			// nome tabella
$azione  =$_POST['submit'];

// test scelta effettuata sul pgm chiamante
             $scelta = new testSiScelta($fid,$azione);
               $scelta->alert_s();

echo "<body class='admin' data-theme='".TMP::$tcolor."'>";
echo "<section id='upd' class='container-fluid'>";
 //==================================================================================

switch ($azione)
{
case 'chiudi':
     $loc = "location:admin.php?urla=widget.php&pag=";
     header($loc);
     	break;
case 'nuovo':    // scelta tipo footer, prosegue su: upd2_foo.php
    {
	$param  = array('nuovo','ritorno');
	$btx    = new bottoni_str_par('Scelta tipo footer','foo','upd2_foo.php',$param);
		$btx->btn($param);
	echo  "<fieldset >";
	$tmod = new DB_tip_i('tifoo','ftipo','','Tipo footer','');
		$tmod->select();
	echo  "</fieldset></form>";
	break;
     }

// modifica
    case 'modifica':

     $btx = new bottoni_str_par('Footer - modifica','foo','write_foo.php',array('modifica','ritorno'));
     $btx->btn();
	 echo "<div  id='tabs'>";
	echo "<ul>
	<li><a href='#tab1' >Dati base</a></li>
	<li><a href='#tab2' >Testo</a></li>
	</ul>";
     $sql = "SELECT * FROM `".DB::$pref."foo`
               WHERE `fid` = $fid ";

	echo "<fieldset id='tab1'>";
     foreach($PDO->query($sql) as $row)
	require('fields_foo.php');
     $f1 = new input(array($fid,'fid',0,'','','h'));
          $f1->field();
     $f1 = new input(array($fprog,'fprog',3,'Progressivo','Per ordinamento','i'));
          $f1->field();
     $ts = new DB_tip_i('stato','fstat',$fstat,'Stato record','Attivo/sospeso');
          $ts->select();
     $f3 = new input(array($fcod,'fcod',20,'Codice','','ia'));
          $f3->field();
     $f4 = new input(array($fdes,'fdes',20,'Descrizione','','i'));
          $f4->field();
     $ti = new input(array($ftitolo,'ftitolo',20,'Titolo','','i'));
          $ti->field();
	 $te = new getTmp($ftmp,'ftmp','Template','Template che visualizza il footer');
		$te->getTemplate();

	$input = new input(array($ftipo,'ftipo',20,'Tipo','Tipo elemento di footer','r'));
     $input->field();
//==================================================================================
switch ($ftipo)
	{
case 'img' :
      $tw = new select_file('images/',$felemento,'felemento','Immagine ','Path immagine');
          $tw->image();
		 break;
case 'cnt' :
      $f4 =    new DB_sel_lt('ctt','eprog',$felemento,'ecod','felemento','estat','edes','Contatto','Scegliere il contatto da mostrare');
          $f4->select_lt();
		 break;
	}

     $f3 = new input(array($flink,'flink',20,'Link','Link se cliccato','i'));
          $f3->field();
	echo "</fieldset>";
//==================================================================================

	// per textarea
	echo	"<fieldset id='tab2'>";
     $f3 = new input(array($ftext,'ftext',50,'Testo','','tx'));
          $f3->field();
if (TMP::$teditor == 'ckeditor')
	{  echo "<script type='text/javascript'>CKEDITOR.replace('ftext');</script>"; }
	echo "</fieldset>";
	echo "</div>";
    echo "</form>";
     break;
 //==================================================================================

 // copia
     case 'copia':

      $btx = new bottoni_str_par('Footer - copia','foo','write_foo.php',array('copia','ritorno'));
      $btx->btn();
 	 echo "<div  id='tabs'>";
 	echo "<ul>
 	<li><a href='#tab1' >Dati base</a></li>
 	<li><a href='#tab2' >Testo</a></li>
 	</ul>";
      $sql = "SELECT * FROM `".DB::$pref."foo`
                WHERE `fid` = $fid ";

 	echo "<fieldset id='tab1'>";
      foreach($PDO->query($sql) as $row)
 	require('fields_foo.php');
      $f1 = new input(array($fid,'fid',0,'','','h'));
           $f1->field();
					 $ins = new DB_ins('foo','fprog');
			     $f1 = new input(array($ins->insert(),'fprog',3,'Progressivo','Per ordinamento','i'));
			          $f1->field();
      $ts = new DB_tip_i('stato','fstat',$fstat,'Stato record','Attivo/sospeso');
           $ts->select();
      $f3 = new input(array($fcod,'fcod',20,'Codice','','ia'));
           $f3->field();
      $f4 = new input(array($fdes,'fdes',20,'Descrizione','','i'));
           $f4->field();
      $ti = new input(array($ftitolo,'ftitolo',20,'Titolo','','i'));
           $ti->field();
 	 $te = new getTmp($ftmp,'ftmp','Template','Template che visualizza il footer');
 		$te->getTemplate();

 	$input = new input(array($ftipo,'ftipo',20,'Tipo','Tipo elemento di footer','r'));
      $input->field();
 //==================================================================================
 switch ($ftipo)
 	{
 case 'img' :
       $tw = new select_file('images/',$felemento,'felemento','Immagine ','Path immagine');
           $tw->image();
 		 break;
 case 'cnt' :
       $f4 =    new DB_sel_lt('ctt','eprog',$felemento,'ecod','felemento','estat','edes','Contatto','Scegliere il contatto da mostrare');
           $f4->select_lt();
 		 break;
 	}

      $f3 = new input(array($flink,'flink',20,'Link','Link se cliccato','i'));
           $f3->field();
 	echo "</fieldset>";
 //==================================================================================

 	// per textarea
 	echo	"<fieldset id='tab2'>";
      $f3 = new input(array($ftext,'ftext',50,'Testo','','tx'));
           $f3->field();
 if (TMP::$teditor == 'ckeditor')
 	{  echo "<script type='text/javascript'>CKEDITOR.replace('ftext');</script>"; }
 	echo "</fieldset>";
 	echo "</div>";
     echo "</form>";
      break;
  //==================================================================================
// cancellazione
    case 'cancella' :
$btg = new bottoni_str_par('Footer - conferma cancellazione','foo','write_foo.php',array('cancella','ritorno'));
     $btg->btn();
      $sql = "SELECT * FROM `".DB::$pref."foo`
               WHERE `fid` = $fid  ";
	echo	"<fieldset>";
     foreach($PDO->query($sql) as $row)
	require('fields_foo.php');
      $f0 = new input(array($fid,'fid',0,'','','h'));
	 	$f0->field();
      $f1 = new input(array($fprog,'fprog',3,'Progressivo','','r'));
	 	$f1->field();
      $ts = new input(array($fstat,'fstat',1,'Stato record','','r'));
	 	$ts->field();
	//-----------------------------------------------------------------
     $f3 = new input(array($fcod,'fcod',20,'Codice','','r'));
          $f3->field();
     $f4 = new input(array($fdes,'fdes',20,'Descrizione','','r'));
          $f4->field();
     $f3 = new input(array($ftipo,'ftipo',20,'Tipo','','r'));
          $f3->field();
	 echo "</fieldset>";
	// per textarea
	echo	"<fieldset>";
     $f3 = new input(array($ftext,'ftext',50,'Testo','','tx'));
          $f3->field();
	echo "</fieldset>";
      echo    "</form>";
      break;

    default:
          echo "Operazione invalida";
    }
     echo "</section>";
	 echo "</body>";
ob_end_flush();
?>
