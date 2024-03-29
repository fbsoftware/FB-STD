<?php session_start();      ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   *-------------------------------------------------------------------------
   * 2.0 aggiunto argomento del capitolo.
============================================================================= */
require_once('init_admin.php');
require_once("editor.php");			// scelta editor
$_SESSION['tab'] = "cap";
require_once("post_".$_SESSION['tab'].".php");   //print_r($_POST);//debug
$azione  =$_POST['submit'];
$content ='Inserire qui il testo';
echo "<body class='admin' data-theme='".TMP::$tcolor."'>";

// test scelta effettuata sul pgm chiamante
$scelta = new testSiScelta($cid,$azione);
$scelta->alert_s();

switch ($azione)
{
// inserimento
    case 'nuovo':
          $bti = new bottoni_str_par('Capitoli - nuovo','cap','write_cap.php',array('nuovo','ritorno'));
               $bti->btn();
          echo  "<fieldset class='row'>";
          $cap = new DB_ins('cap','cprog');
          $f3 = new input(array($cap->insert(),'cprog',03,'Progressivo','Per ordinamento','i'));
               $f3->field();
          $ts = new DB_tip_i('stato','cstat','','Stato record','Attivo-sospeso');
               $ts->select();
          $f4 = new input(array('','ccod',10,'Codice capitolo','Codice da assegnare al capitolo','ia'));
               $f4->field();
          $f5 = new input(array('','cdesc',50,'Descrizione','Descrizione da assegnare al capitolo','i'));
               $f5->field();
          $f6 = new input(array('','cmostra',1,'Mostra il testo','SI = mostra il titolo','sn'));
               $f6->field();
          $arg = new DB_sel_lt('arg','rprog','','rcod','carg','rstat','rdesc','Argomento','Argomento del capitolo');
             echo  $arg->select_lt();
          $f3 = new input(array(htmlspecialchars($content, ENT_QUOTES),'ctext',100,'Testo','Inserire il testo per il capitolo','tx'));
               $f3->field();
		echo "<script type='text/javascript'>CKEDITOR.replace('ctext');	</script>";

          echo  "</form>";
          echo  "</fieldset>";
      break;

// modifica
    case 'modifica':
          $bti = new bottoni_str_par('Capitoli - modifica','cap','write_cap.php',array('modifica','ritorno'));
               $bti->btn();

      echo  "<fieldset class='row'>";
	$sql = "SELECT * FROM `".DB::$pref."cap` where `cid` = $cid ";
// transazione
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();

     foreach($PDO->query($sql) as $row)
     {
     require('fields_cap.php');
     $f0 = new input(array($cid,'cid',1,'','','h'));
          $f0->field();
          $f3 = new input(array($cprog,'cprog',03,'Progressivo','Per ordinamento','i'));
               $f3->field();
          $ts = new DB_tip_i('stato','cstat',$cstat,'Stato record','Attivo-sospeso');
               $ts->select();
          $f4 = new input(array($ccod,'ccod',10,'Codice capitolo','Codice da assegnare al capitolo','ia'));
               $f4->field();
          $f5 = new input(array($cdesc,'cdesc',50,'Descrizione','Descrizione da assegnare al capitolo','i'));
               $f5->field();
          $f6 = new input(array($cmostra,'cmostra',1,'Mostra il testo','SI = mostra il titolo','sn'));
               $f6->field();
          $arg = new DB_sel_lt('arg','rprog',$carg,'rcod','carg','rstat','rdesc','Argomento','Argomento del capitolo');
             echo  $arg->select_lt();
          $f3 = new input(array(htmlspecialchars($ctext, ENT_QUOTES),'ctext',100,'Testo','Inserire il testo per il capitolo','tx'));
               $f3->field();
		echo "<script type='text/javascript'>CKEDITOR.replace('ctext');	</script>";

          echo "</fieldset>";
          echo "</form>";
     }
     break;

     // copia
         case 'copia':
               $bti = new bottoni_str_par('Capitoli - copia','cap','write_cap.php',array('copia','ritorno'));
                    $bti->btn();

           echo  "<fieldset class='row'>";
     	$sql = "SELECT * FROM `".DB::$pref."cap` where `cid` = $cid ";
     // transazione
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction();

          foreach($PDO->query($sql) as $row)
          {
          require('fields_cap.php');
          $f0 = new input(array($cid,'cid',1,'','','h'));
               $f0->field();
               $cap = new DB_ins('cap','cprog');
               $f3 = new input(array($cap->insert(),'cprog',03,'Progressivo','Per ordinamento','i'));
                    $f3->field();
               $ts = new DB_tip_i('stato','cstat',$cstat,'Stato record','Attivo-sospeso');
                    $ts->select();
               $f4 = new input(array($ccod,'ccod',10,'Codice capitolo','Codice da assegnare al capitolo','ia'));
                    $f4->field();
               $f5 = new input(array($cdesc,'cdesc',50,'Descrizione','Descrizione da assegnare al capitolo','i'));
                    $f5->field();
               $f6 = new input(array($cmostra,'cmostra',1,'Mostra il testo','SI = mostra il titolo','sn'));
                    $f6->field();
               $arg = new DB_sel_lt('arg','rprog',$carg,'rcod','carg','rstat','rdesc','Argomento','Argomento del capitolo');
                  echo  $arg->select_lt();
               $f3 = new input(array(htmlspecialchars($ctext, ENT_QUOTES),'ctext',100,'Testo','Inserire il testo per il capitolo','tx'));
                    $f3->field();
     		echo "<script type='text/javascript'>CKEDITOR.replace('ctext');	</script>";

               echo "</fieldset>";
               echo "</form>";
          }
          break;
// cancellazione
    case 'cancella' :
          $bti = new bottoni_str_par('Capitoli - conferma cancellazione','cap','write_cap.php',array('cancella','ritorno'));
               $bti->btn();

      echo  "<fieldset class='row'>";
      $sql = "SELECT *
              FROM `".DB::$pref."cap`
              WHERE `cid` = $cid  ";
     // transazione
          $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
          $PDO = new PDO($con,DB::$user,DB::$pw);
          $PDO->beginTransaction();
     foreach($PDO->query($sql) as $row)
             {
             require('fields_cap.php');
             $f0 = new input(array($cid,'cid',1,'ID record','','h'));
               $f0->field();
             $f1 = new input(array($cprog,'cprog',3,'Progressivo','','r'));
               $f1->field();
             $f2 = new input(array($cstat,'cstat',1,'Stato record','','r'));
               $f2->field();
             $f3 = new input(array($ccod,'ccod',10,'Codice argomento','','r'));
               $f3->field();
             $f4 = new input(array(htmlspecialchars($cdesc, ENT_QUOTES),'cdesc',50,'Descrizione','','r'));
               $f4->field();
             $f5 = new input(array($cmostra,'cmostra',1,'Mostra il testo','','r'));
               $f5->field();
             $f6 = new input(array($carg,'carg',1,'Argomento','','r'));
               $f6->field();
             $f7 = new input(array(htmlspecialchars($ctext, ENT_QUOTES),'ctext',33,'Capitolo','','r'));
               $f7->field();
             echo  "</fieldset>";
             echo  "</form>";
             }
      break;

    case 'chiudi' :
    {
         $loc = "location:admin.php?urla=widget.php&pag=";
         header($loc);
        break;
    }

    default:
  echo "Operazione invalida";
     }
	 echo "</body>";
ob_end_flush();
?>
