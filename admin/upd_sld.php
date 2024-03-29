<?php session_start();     ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'sld' - CONTROL
   15/03/2022	aggiunta copia, nuove include in "write"
============================================================================*/
require_once('init_admin.php');
require_once("post_".$_SESSION['tab'].".php");
$azione=$_POST['submit'];          //print_r($_POST); //debug

// test scelta effettuata sul pgm chiamante
             $scelta = new testSiScelta($slid,$azione);
               $scelta->alert_s();

echo "<body class='admin' data-theme='".TMP::$tcolor."'>";
echo "<section id='upd' class='container-fluid'>";

switch ($azione)
{
case NULL:
          array_push($_SESSION['esito'],'1');
    header('location:gest_sld.php');
      break;
case 'nuovo':
          $param = array('nuovo','ritorno');
          $bti   = new bottoni_str_par('Slide - nuovo','sld','write_sld.php',$param);
               $bti->btn();

// dati di base
echo  "<fieldset>";
$PDO = new DB_ins('sld','slprog');
$f  = new input(array($PDO->insert(),'slprog',5,'Progressivo','Per serializzare','i'));
     $f->field();
$ts = new DB_tip_i('stato','slstat','','Stato','Stato del record: Attivo/sospeso');
     $ts->select();
$f2 = new input(array('','slcod',20,'Codice','Codice della slide','ia'));
     $f2->field();
$f4 = new input(array('','slde',20,'Descrizione','Descrizione della slide','i'));
     $f4->field();
$t = new getTmp('','sltmp','Template','Template che visualizza la slide');
     $t->getTemplate();
$tw = new select_file('images/','','slimg','Immagine','Path immagine slide');
     $tw->image();
$f  =    new input(array('','slalt',30,'Titolo immagine','Titolo per mouseover','i'));
     $f->field();
$f  = new input(array('','slcaption',50,'Titolo','Titolo','i'));
     $f->field();
$f  = new input(array('','sldesc',50,'Descrizione','Descrizione dettagliata','i'));
     $f->field();
$f  = new input(array('','slinkcap',30,'Caption bottone','Descrizione bottone link','i'));
     $f->field();
$f  = new input(array('','slink',50,'Link bottone','URL del link se si clicca il bottone','i'));
     $f->field();
      echo  "</fieldset>";
      break;

case 'modifica':
          $param    = array('modifica','ritorno');
          $btm      = new bottoni_str_par('Slide - modifica','sld','write_sld.php',$param);
               $btm->btn();

       $sql = "SELECT *
               FROM `".DB::$pref."sld`
               WHERE `slid` = '$slid' ";
       echo  "<fieldset>";
     foreach($PDO->query($sql) as $row)
     {
      require('fields_sld.php');
$f0 = new input(array($slid,'slid',1,$ID,'','h'));
     $f0->field();
$f  = new input(array($slprog,'slprog','5','Progressivo','Per serializzare','i'));
     $f->field();
$ts = new DB_tip_i('stato','slstat',$slstat,'Stato','Stato del record: Attivo/sospeso');
     $ts->select();
$f2 = new input(array($slcod,'slcod',20,'Codice','Codice della slide','ia'));
     $f2->field();
$f4 = new input(array($slde,'slde',20,'Descrizione','Descrizione della slide','i'));
     $f4->field();
$t = new getTmp($sltmp,'sltmp','Template','Template che visualizza la slide');
     $t->getTemplate();
$tw = new select_file('images/',$slimg,'slimg','Immagine','Path immagine slide');
     $tw->image();
$f  =    new input(array($slalt,'slalt',30,'Titolo immagine','Titolo per mouseover','i'));
     $f->field();
$f  = new input(array($slcaption,'slcaption',50,'Titolo','Titolo','i'));
     $f->field();
$f  = new input(array($sldesc,'sldesc',50,'Descrizione','Descrizione dettagliata','i'));
     $f->field();
$f  = new input(array($slinkcap,'slinkcap',30,'Caption bottone','Descrizione bottone link','i'));
     $f->field();
$f  = new input(array($slink,'slink',50,'Link bottone','URL del link se si clicca il bottone','i'));
     $f->field();
     }
      echo  "</fieldset>";
     break;

     case 'copia':
               $param    = array('copia','ritorno');
               $btm      = new bottoni_str_par('Slide - copia','sld','write_sld.php',$param);
                    $btm->btn();

            $sql = "SELECT *
                    FROM `".DB::$pref."sld`
                    WHERE `slid` = '$slid' ";
            echo  "<fieldset>";
          foreach($PDO->query($sql) as $row)
          {
           require('fields_sld.php');
     $f0 = new input(array($slid,'slid',1,$ID,'','h'));
          $f0->field();
     $f  = new input(array($slprog,'slprog','5','Progressivo','Per serializzare','i'));
          $f->field();
          $PDO = new DB_ins('sld','slprog');
          $f  = new input(array($PDO->insert(),'slprog',5,'Progressivo','Per serializzare','i'));
               $f->field();
     $f2 = new input(array($slcod,'slcod',20,'Codice','Codice della slide','ia'));
          $f2->field();
     $f4 = new input(array($slde,'slde',20,'Descrizione','Descrizione della slide','i'));
          $f4->field();
     $t = new getTmp($sltmp,'sltmp','Template','Template che visualizza la slide');
          $t->getTemplate();
     $tw = new select_file('images/',$slimg,'slimg','Immagine','Path immagine slide');
          $tw->image();
     $f  =    new input(array($slalt,'slalt',30,'Titolo immagine','Titolo per mouseover','i'));
          $f->field();
     $f  = new input(array($slcaption,'slcaption',50,'Titolo','Titolo','i'));
          $f->field();
     $f  = new input(array($sldesc,'sldesc',50,'Descrizione','Descrizione dettagliata','i'));
          $f->field();
     $f  = new input(array($slinkcap,'slinkcap',30,'Caption bottone','Descrizione bottone link','i'));
          $f->field();
     $f  = new input(array($slink,'slink',50,'Link bottone','URL del link se si clicca il bottone','i'));
          $f->field();
          }
           echo  "</fieldset>";
          break;

case 'cancella':
          $param    = array('cancella','ritorno');
          $btc = new bottoni_str_par('Slide - conferma cancellazione','sld','write_sld.php',$param);
               $btc->btn();
     $sql = "SELECT *
               FROM `".DB::$pref."sld`
               WHERE `slid` = $slid ";
      echo  "<fieldset>";
foreach($PDO->query($sql) as $row)
     {
     require('fields_sld.php');

     $f0 = new input(array($slid,'slid',5,'ID record','','h'));
          $f0->field();
     $f1 = new input(array($slprog,'slprog',3,'Progressivo','','r'));
          $f1->field();
     $ts = new input(array($slstat,'slstat',1,'Stato record','','r'));
          $ts->field();
     $ts = new input(array($slcod,'slcod',30,'Codice','','r'));
          $ts->field();
     $ts = new input(array($slde,'slde',30,'Descrizione','','r'));
          $ts->field();
      echo  "</fieldset>";
     }
      break;

       case 'chiudi' :
       $loc = "location:admin.php?urla=widget.php&pag=";
            header($loc);
       break;
	echo	"</section>";
}
echo "</body>";
ob_end_flush();
?>
