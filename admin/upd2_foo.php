<?php session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2025 - 2026 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------
   * Inserimento in base al tipo footer
============================================================================= */
require_once('init_admin.php');
require_once("editor.php");				// scelta editor
?>
<style>
.cke_reset	{
	width:1000px !important;
	}
</style>
<?php
require('post_foo.php');
$azione=$_POST['submit'];
echo "<body class='admin' data-theme='".TMP::$tcolor."'>";

// mostra stringa bottoni
switch ($azione)
{
case 'uscita':
     $loc = "location:admin.php?urla=widget.php&pag=";
     header($loc);
     break;

//==================================================================================

// inserimento
    case 'nuovo':
     $btx = new bottoni_str_par('Nuovo Footer di pagina','foo','write_foo.php',array('nuovo','ritorno'));
          $btx->btn();
echo	"<fieldset class='row'>";
     $ins = new DB_ins('foo','fprog');
     $f1 = new input(array($ins->insert(),'fprog',3,'Progressivo','Per ordinamento','i'));
          $f1->field();
     $ts = new DB_tip_i('stato','fstat','','Stato record','Attivo/sospeso');
          $ts->select();
	//-----------------------------------------------------------------
     $f3 = new input(array('','fcod',20,'Codice','£tooltip','ia'));
          $f3->field();
     $f4 = new input(array('','fdes',20,'Descrizione','£tooltip','i'));
          $f4->field();
     $ti = new input(array('','ftitolo',20,'Titolo','£tooltip','i'));
          $ti->field();
	 $te = new getTmp('','ftmp','Template','Template che visualizza il footer');
		$te->getTemplate();

     $ti = new input(array($ftipo,'ftipo',20,'Tipo','Tipo elemento di footer','r'));
          $ti->field();

 //==================================================================================
switch ($ftipo)
	{
case 'img' :
      $tw = new select_file('images/','','felemento','Immagine ','Path immagine');
          $tw->image();
		 break;
case 'cnt' :
      $f4 =    new DB_sel_lt('ctt','eprog','','ecod','felemento','estat','edes','Contatto','Scegliere il contatto da mostrare');
          $f4->select_lt();
		 break;
	}
//==================================================================================

 $f3 = new input(array('','flink',20,'Link','Link se cliccato','i'));
          $f3->field();
	// per textarea
     $f4 = new input(array('','ftext',50,'Testo','£tooltip','tx'));
          $f4->field();
if (TMP::$teditor == 'ckeditor')
	{  echo "<script type='text/javascript'>CKEDITOR.replace('ftext');</script>"; }

echo "</fieldset>";
echo  "</form>";
      break;
 //==================================================================================

}
echo "</body>";
?>
