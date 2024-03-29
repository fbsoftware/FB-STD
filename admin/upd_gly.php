<?php session_start();      ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------
   * gestione tabella glifi
   15/03/2022	aggiunta copia, nuove include in "write"
============================================================================= */
require_once('init_admin.php');
require_once("editor.php");			// scelta editor
require_once("post_".$_SESSION['tab'].".php");
$azione  =$_POST['submit'];     // print_r($_POST);//debug

// test scelta effettuata sul pgm chiamante
             $scelta = new testSiScelta($gid,$azione);
               $scelta->alert_s();

echo "<body class='admin' data-theme='".TMP::$tcolor."'>";
echo "<section id='upd' class='container-fluid'>";

switch ($azione)
{
// inserimento ======================================================================
    case 'nuovo':
     $btx = new bottoni_str_par('Icone - nuovo','gly','write_gly.php',array('nuovo','ritorno'));
          $btx->btn();
echo	"<fieldset class='row'>";
     $gly = new DB_ins('gly','gprog');
     $f1 = new input(array($gly->insert(),'gprog',3,'Progressivo','Per ordinamento','i'));
          $f1->field();
     $ts = new DB_tip_i('stato','gstat','','Stato record','Attivo/sospeso');
          $ts->select();
      $t = new getTmp('','gtmp','Template','Scelta del template che utilizza il glifo');
          $t->getTemplate();
     $f3 = new input(array('','gcod',20,'Codice','Codice glifo','ia'));
          $f3->field();
     $f4 = new input(array('','gdes',30,'Descrizione','Descrizione glifo','i'));
          $f4->field();

     $ts = new DB_tip_i('dim','gdim','','Dimensione','Dimensione glifo');
          $ts->select();
     $ts = new DB_tip_i('color','gcolor','','Colore','');
          $ts->select();
     $f3 = new input(array('','gtitle',50,'Titolo','Titolo glifo','i'));
          $f3->field();
?>
<div>
	<label for="gfa" data-toggle="tooltip" title="Codice glifo fa-...">Glifo</label>
     <input type="text" id="gfa" name="gfa" value="" size="30">
	<button type="button" class="fb-secondary fb-p05 fb-rad7 fb-m05" style="float:none; margin-top:0px !important;"><a href="https://www.w3schools.com/icons/icons_reference.asp" target="_new">Visualizza Glifi</a></button>
</div>
<?php
     $f5 = new input(array('','glink',50,'Link','Link per il titolo','i'));
          $f5->field();

     $f4 = new input(array('','gtext',50,'Testo','Testo del glifo','tx'));
          $f4->field();
if (TMP::$teditor == 'ckeditor')
	{  echo "<script type='text/javascript'>CKEDITOR.replace('gtext');</script>"; }
echo "</fieldset>";
echo  "</form>";
      break;

      // modifica  =========================================================================
          case 'modifica':
           $btx = new bottoni_str_par('Icone - modifica','gly','write_gly.php',array('modifica','ritorno'));
           $btx->btn();
           $sql = "SELECT * FROM `".DB::$pref."gly`
                     WHERE `gid` = $gid ";
      	echo	"<fieldset class='row'>";
           foreach($PDO->query($sql) as $row)
      	require('fields_gly.php');

           $f1 = new input(array($gid,'gid',0,'','','h'));
                $f1->field();
           $f1 = new input(array($gprog,'gprog',3,'Progressivo','Per ordinamento','i'));
                $f1->field();
           $ts = new DB_tip_i('stato','gstat',$gstat,'Stato record','Attivo/sospeso');
                $ts->select();
            $t = new getTmp($gtmp,'gtmp','Template','Scelta del template che utilizza il glifo');
                $t->getTemplate();
           $f3 = new input(array($gcod,'gcod',20,'Codice','Codice glifo','ia'));
                $f3->field();
           $f4 = new input(array($gdes,'gdes',30,'Descrizione','Descrizione glifo','i'));
                $f4->field();

           $tb = new DB_tip_i('dim','gdim',$gdim,'Dimensione','Dimensione glifo');
                $tb->select();
           $tc = new DB_tip_i('color','gcolor',$gcolor,'Colore','');
                $tc->select();
           $f3 = new input(array($gtitle,'gtitle',50,'Titolo','Titolo glifo','i'));
                $f3->field();
      ?>
      <div>
      	<label for="gfa" data-toggle="tooltip" title="Codice glifo fa-...">Glifo</label>
           <input type="text" id="gfa" name="gfa" value="<?php echo $gfa ?>" size="30">
      	<button type="button" class="fb-secondary fb-p05 fb-rad7 fb-m05" style="float:none; margin-top:0px !important;"><a href="https://www.w3schools.com/icons/icons_reference.asp" target="_new">Glifi</a></button>
      </div>
      <?php
      	$f5 = new input(array($glink,'glink',50,'Link','Link per il titolo','i'));
                $f5->field();

           $f3 = new input(array($gtext,'gtext',50,'Testo','Testo del glifo','tx'));
                $f3->field();
      if (TMP::$teditor == 'ckeditor')
      	{  echo "<script type='text/javascript'>CKEDITOR.replace('gtext');</script>"; }
      	echo "</fieldset>";
           echo    "</form>";
           break;

           // copia  =========================================================================
               case 'copia':
                $btx = new bottoni_str_par('Icone - copia','gly','write_gly.php',array('copia','ritorno'));
                $btx->btn();
                $sql = "SELECT * FROM `".DB::$pref."gly`
                          WHERE `gid` = $gid ";
           	echo	"<fieldset class='row'>";
                foreach($PDO->query($sql) as $row)
           	require('fields_gly.php');

                $f1 = new input(array($gid,'gid',0,'','','h'));
                     $f1->field();
                     $gly = new DB_ins('gly','gprog');
                     $f1 = new input(array($gly->insert(),'gprog',3,'Progressivo','Per ordinamento','i'));
                          $f1->field();
                $ts = new DB_tip_i('stato','gstat',$gstat,'Stato record','Attivo/sospeso');
                     $ts->select();
                 $t = new getTmp($gtmp,'gtmp','Template','Scelta del template che utilizza il glifo');
                     $t->getTemplate();
                $f3 = new input(array($gcod,'gcod',20,'Codice','Codice glifo','ia'));
                     $f3->field();
                $f4 = new input(array($gdes,'gdes',30,'Descrizione','Descrizione glifo','i'));
                     $f4->field();

                $tb = new DB_tip_i('dim','gdim',$gdim,'Dimensione','Dimensione glifo');
                     $tb->select();
                $tc = new DB_tip_i('color','gcolor',$gcolor,'Colore','');
                     $tc->select();
                $f3 = new input(array($gtitle,'gtitle',50,'Titolo','Titolo glifo','i'));
                     $f3->field();
           ?>
           <div>
           	<label for="gfa" data-toggle="tooltip" title="Codice glifo fa-...">Glifo</label>
                <input type="text" id="gfa" name="gfa" value="<?php echo $gfa ?>" size="30">
           	<button type="button" class="fb-secondary fb-p05 fb-rad7 fb-m05" style="float:none; margin-top:0px !important;"><a href="https://www.w3schools.com/icons/icons_reference.asp" target="_new">Glifi</a></button>
           </div>
           <?php
           	$f5 = new input(array($glink,'glink',50,'Link','Link per il titolo','i'));
                     $f5->field();

                $f3 = new input(array($gtext,'gtext',50,'Testo','Testo del glifo','tx'));
                     $f3->field();
           if (TMP::$teditor == 'ckeditor')
           	{  echo "<script type='text/javascript'>CKEDITOR.replace('gtext');</script>"; }
           	echo "</fieldset>";
                echo    "</form>";
                break;

// cancellazione  ===================================================================
    case 'cancella' :
$btg = new bottoni_str_par('Icone - conferma cancellazione','gly','write_gly.php',array('cancella','ritorno'));
     $btg->btn();
      $sql = "SELECT * FROM `".DB::$pref."gly`
               WHERE `gid` = $gid  ";
	echo	"<fieldset class='row'>";
     foreach($PDO->query($sql) as $row)
	require('fields_gly.php');
      $f0 = new input(array($gid,'gid',0,'','','h'));
	 	$f0->field();
      $f1 = new input(array($gprog,'gprog',3,'Progressivo','','r'));
	 	$f1->field();
      $ts = new input(array($gstat,'gstat',1,'Stato record','','r'));
	 	$ts->field();
      $f2 = new input(array($gtmp,'gtmp',20,'Template','','r'));
	 	$f2->field();
      $f3 = new input(array($gcod,'gcod',20,'Codice','','r'));
	 	$f3->field();
      $f4 = new input(array(htmlspecialchars($gdes, ENT_QUOTES),'gdes',30,'Descrizione','','r'));
      	$f4->field();
	 echo "</fieldset>";
      echo    "</form>";
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
