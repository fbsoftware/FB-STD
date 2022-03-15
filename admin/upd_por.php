<?php session_start();     ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package            FB open template
   * versione 3.1
   * copyright  Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license            GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'por' - CONTROL
   15/03/2022	aggiunta copia, nuove include in "write"
============================================================================*/
require_once('init_admin.php');
require_once("post_".$_SESSION['tab'].".php");
$azione=$_POST['submit'];          //print_r($_POST); //debug

/// test scelta effettuata sul pgm chiamante
             $scelta = new testSiScelta($pid,$azione);
               $scelta->alert_s();

echo "<body class='admin' data-theme='".TMP::$tcolor."'>";
switch ($azione)
{
case NULL:
          array_push($_SESSION['esito'],'1');
          $loc = "location:admin.php?".$_SESSION['location']."";
          header($loc);
      break;

case 'nuovo':
          $param    = array('nuovo','ritorno');
          $bti      = new bottoni_str_par('Portfolio - nuovo','por','write_por.php',$param);
                $bti->btn();
// dati di base
echo  "<fieldset>";
     $PDO = new DB_ins('por','pprog');
     $nr=$PDO->insert();
        $f  =    new input(array($nr,'pprog',5,'Progressivo','Per serializzare','i'));
                $f->field();
        $ts = new DB_tip_i('stato','pstat','','Stato record','Attivo-sospeso');
                $ts->select();
        $f  =    new input(array('','pcod',30,'Codice portfolio','Codice da assegnare','i'));
                $f->field();
        $f  =    new input(array('','pdes',30,'Descrizione ','Descrizione portfolio','i'));
                $f->field();
        $t = new getTmp('','ptmp','Template','Template che visualizza la slide');
        $t->getTemplate();
        $tw = new select_file('images/','','pimg','Immagine ','Path immagine portfolio');
                $tw->image();
        $f  = new input(array('','palt',30,'Testo alternativo','Testo alternativo immagine','i'));
                $f->field();
        $f  = new input(array('','pcapt',50,'Titolo','Titolo','i'));
                $f->field();
        $f  = new input(array('','pmheader',50,'Testata-modal','Testata della mappa modal','i'));
                $f->field();
        $f  = new input(array('','pmtext',30,'Testo-modal','Testo della mappa modal','i'));
                $f->field();
        $f  = new input(array('','pmlink',50,'Link','URL del link del portfolio','i'));
                $f->field();
      echo  "</fieldset>";
      break;

case 'modifica':
          $param    = array('modifica','ritorno');
          $btm      = new bottoni_str_par('Portfolio - modifica','por','write_por.php',$param);
               $btm->btn();

       $sql = "SELECT *
               FROM `".DB::$pref."por`
               WHERE `pid` = '$pid' ";
     // transazione
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction();
     foreach($PDO->query($sql) as $row)
     {
      require('fields_por.php');
echo  "<fieldset>";
     $f0 = new input(array($pid,'pid',1,'','','h'));
        $f0->field();
        $campo  =    array($pprog,'pprog',5,'Progressivo','Per serializzare','i');
        $f  =    new input($campo);
                $f->field();
        $ts = new DB_tip_i('stato','pstat',$pstat,'Stato record','Attivo-sospeso');
                $ts->select();
        $campo  =    array($pcod,'pcod',30,'Codice portfolio','Codice da assegnare','i');
                $f  =    new input($campo);
                        $f->field();
        $campo  =    array($pdes,'pdes',30,'Descrizione ','Descrizione portfolio','i');
                $f  =    new input($campo);
                        $f->field();
        $t = new getTmp($ptmp,'ptmp','Template','Template che visualizza la slide');
        $t->getTemplate();

        $tw = new select_file('images/',$pimg,'pimg','Immagine ','Path immagine portfolio');
                $tw->image();
        $campo  =    array($palt,'palt',30,'Testo alternativo','Testo alternativo immagine','i');
                $f  =    new input($campo);
                        $f->field();
        $campo  =    array($pcapt,'pcapt',50,'Titolo','Titolo','i');
                $f  =    new input($campo);
                        $f->field();
        $campo  =    array($pmheader,'pmheader',50,'Testata-modal','Testata della mappa modal','i');
                $f  =    new input($campo);
                        $f->field();
        $campo  =    array($pmtext,'pmtext',30,'Testo-modal','Testo della mappa modal','i');
                $f  =    new input($campo);
                        $f->field();
        $campo  =    array($pmlink,'pmlink',50,'Link','URL del link del portfolio','i');
                $f  =    new input($campo);
                        $f->field();
      echo  "</fieldset>";
           }
     break;

     case 'copia':
               $param    = array('copia','ritorno');
               $btm      = new bottoni_str_par('Portfolio - copia','por','write_por.php',$param);
                    $btm->btn();

            $sql = "SELECT *
                    FROM `".DB::$pref."por`
                    WHERE `pid` = '$pid' ";
          // transazione
          $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
          $PDO = new PDO($con,DB::$user,DB::$pw);
          $PDO->beginTransaction();
          foreach($PDO->query($sql) as $row)
          {
           require('fields_por.php');
     echo  "<fieldset>";
          $f0 = new input(array($pid,'pid',1,'','','h'));
             $f0->field();
             $PDO = new DB_ins('por','pprog');
             $nr=$PDO->insert();
                $f  =    new input(array($nr,'pprog',5,'Progressivo','Per serializzare','i'));
                        $f->field();
             $ts = new DB_tip_i('stato','pstat',$pstat,'Stato record','Attivo-sospeso');
                     $ts->select();
             $campo  =    array($pcod,'pcod',30,'Codice portfolio','Codice da assegnare','i');
                     $f  =    new input($campo);
                             $f->field();
             $campo  =    array($pdes,'pdes',30,'Descrizione ','Descrizione portfolio','i');
                     $f  =    new input($campo);
                             $f->field();
             $t = new getTmp($ptmp,'ptmp','Template','Template che visualizza la slide');
             $t->getTemplate();

             $tw = new select_file('images/',$pimg,'pimg','Immagine ','Path immagine portfolio');
                     $tw->image();
             $campo  =    array($palt,'palt',30,'Testo alternativo','Testo alternativo immagine','i');
                     $f  =    new input($campo);
                             $f->field();
             $campo  =    array($pcapt,'pcapt',50,'Titolo','Titolo','i');
                     $f  =    new input($campo);
                             $f->field();
             $campo  =    array($pmheader,'pmheader',50,'Testata-modal','Testata della mappa modal','i');
                     $f  =    new input($campo);
                             $f->field();
             $campo  =    array($pmtext,'pmtext',30,'Testo-modal','Testo della mappa modal','i');
                     $f  =    new input($campo);
                             $f->field();
             $campo  =    array($pmlink,'pmlink',50,'Link','URL del link del portfolio','i');
                     $f  =    new input($campo);
                             $f->field();
           echo  "</fieldset>";
          }
          break;
case 'cancella':
          $param    = array('cancella','ritorno');
          $btm      = new bottoni_str_par('Portfolio - conferma cancellazione','por','write_por.php',$param);
               $btm->btn();

      $sql = "SELECT *
               FROM `".DB::$pref."por`
               WHERE `pid` = '$pid' ";
        // transazione
        $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
        $PDO = new PDO($con,DB::$user,DB::$pw);
        $PDO->beginTransaction();
        foreach($PDO->query($sql) as $row)
     {
     require('fields_por.php');
     echo  "<fieldset>";
     $f0 = new input(array($pid,'pid',5,'ID record','','h'));
                $f0->field();
     $f1 = new input(array($pprog,'pprog',3,'Progressivo','','r'));
                $f1->field();
     $ts = new input(array($pstat,'pstat',1,'Stato record','','r'));
                $ts->field();
     $ts = new input(array($pcod,'pcod',30,'Codice','','r'));
                $ts->field();
     $ts = new input(array($pdes,'pdes',30,'descrizione','','r'));
                $ts->field();
     echo  "</fieldset>";
     }
      break;

case 'chiudi' :
       $loc = "location:admin.php?urla=widget.php&pag=";
            header($loc);
       break;
}
echo "</body>";
ob_end_flush();
?>
