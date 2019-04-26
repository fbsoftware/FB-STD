<?php
/* * Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.4   
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
==============================================================================
   * creazione config.ini e database con dati minimi necessari per iniziare
==============================================================================*/
?>
<!DOCTYPE HTML>
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title></title>
  <link rel="stylesheet" href="config.css"  type="text/css" >
  </head>
  
  <body>
<?php
// acquisizione e creazione config.ini
require '../libFB-1.1.1/FileIni.class.php';  
require '../libFB-1.1.1/DB_PDO.php';              
$options=array('autoSave'=>true, 'readOnly'=>false);  
$file=new FileIni("../config.ini", $options);
  
$file->setValue('DB', 'root', $_POST['root']);
$file->setValue('DB', 'host', $_POST['host']);
$file->setValue('DB', 'user', $_POST['user']);
$file->setValue('DB', 'pw'  , $_POST['pw']);
$file->setValue('DB', 'db'  , $_POST['db']);
$file->setValue('DB', 'pref', $_POST['pref']);

$file->setValue('config', 'site'     , $_POST['site']);
$file->setValue('config', 'dir_cont' , $_POST['p_txt']);
$file->setValue('config', 'dir_help' , $_POST['p_hlp']);
$file->setValue('config', 'dir_imm'  , $_POST['p_imm']);
$file->setValue('config', 'incr',      $_POST['incr']);
$file->setValue('config', 'sep',       $_POST['sep']);
$file->setValue('config', 'page_title',$_POST['home']);
$file->setValue('config', 'content',   $_POST['cont']);
$file->setValue('config', 'e_mail',    $_POST['mail']);

// creazione database vuoto
    try {
        $dbh = new PDO("mysql:host=".$_POST['host']."", $_POST['user'], $_POST['pw']);

        $dbh->exec("CREATE DATABASE `".$_POST['db']."`;
                CREATE USER '".$_POST['user']."'@'".$_POST['host']."' IDENTIFIED BY '".$_POST['pw']."';
                GRANT ALL ON '".$_POST['db']."'.* TO '".$_POST['user']."'@'".$_POST['host']."';
                FLUSH PRIVILEGES;") 
        or die(print_r($dbh->errorInfo(), true));

    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }
// connessione
try { $PDO = new PDO("mysql:host=".$_POST['host'].";dbname=".$_POST['db']."",$_POST['user'],$_POST['pw']); } 
catch(PDOException $e) { echo $e->getMessage(); }
$PDO->beginTransaction();

 //==================================================================================     
$PDO->exec("CREATE TABLE `".$_POST['pref']."arg` (
  `rid` int(3) NOT NULL COMMENT 'id record',
  `rstat` varchar(1) NOT NULL COMMENT 'stato',
  `rprog` int(3) NOT NULL COMMENT 'progressivo',
  `rcod` varchar(10) NOT NULL COMMENT 'codice',
  `rdesc` varchar(50) NOT NULL COMMENT 'descrizione ',
  `rtext` text NOT NULL COMMENT 'Testo',
  `rmostra` tinyint(1) NOT NULL COMMENT 'Mostra testo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

$PDO->exec("INSERT INTO `".$_POST['pref']."arg` (`rid`, `rstat`, `rprog`, `rcod`, `rdesc`, `rtext`, `rmostra`) VALUES
(4, '', 6, 'Arg. test', 'Argomento di test', '<h1>Argomento di test.</h1>', 1),
(5, '', 0, '', '', '<p>Intenzionalmente vuoto</p>', 0)");
echo "Creata tabella ARG";

 //==================================================================================     
$PDO->exec("CREATE TABLE `".$_POST['pref']."art` (
  `aid` int(3) NOT NULL COMMENT 'id record',
  `astat` varchar(1) NOT NULL COMMENT 'stato',
  `aprog` int(3) NOT NULL COMMENT 'progressivo',
  `atit` varchar(50) NOT NULL COMMENT 'titolo articolo',
  `aalias` varchar(50) NOT NULL COMMENT 'alias titolo',
  `atext` mediumtext NOT NULL COMMENT 'testo articolo',
  `aarg` varchar(10) NOT NULL COMMENT 'argomento',
  `acap` varchar(10) NOT NULL COMMENT 'capitolo',
  `amostra` tinyint(1) NOT NULL COMMENT 'Mostra titolo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

$PDO->exec("INSERT INTO `".$_POST['pref']."art` (`aid`, `astat`, `aprog`, `atit`, `aalias`, `atext`, `aarg`, `acap`, `amostra`) VALUES
(51, '', 141, 'Test', '', '<h3>Articolo di test.</h3>', '', '', 0)");
echo "<br />Creata tabella ART";

 //==================================================================================     
$PDO->exec("CREATE TABLE `".$_POST['pref']."cap` (
  `cid` int(3) NOT NULL COMMENT 'id record',
  `cstat` varchar(1) NOT NULL COMMENT 'stato',
  `cprog` int(3) NOT NULL COMMENT 'progressivo',
  `ccod` varchar(10) NOT NULL COMMENT 'codice capitoli',
  `cdesc` varchar(50) NOT NULL COMMENT 'descrizione capitoli',
  `ctext` text NOT NULL COMMENT 'Testo',
  `cmostra` tinyint(1) NOT NULL COMMENT 'Mostra testo',
  `carg` varchar(10) NOT NULL COMMENT 'Argomento del capitolo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

$PDO->exec("INSERT INTO `".$_POST['pref']."cap` (`cid`, `cstat`, `cprog`, `ccod`, `cdesc`, `ctext`, `cmostra`, `carg`) VALUES
(5, '', 6, 'Cap. di te', 'Capitolo di test', '<h2>Il capitolo per il test.</h2>', 1, ''),
(11, '', 11, '', '', '<p>Intenzionalmente vuoto</p>', 0, '')");
echo "<br />Creata tabella CAP";

 //==================================================================================     
$PDO->exec("CREATE TABLE `".$_POST['pref']."mnu` (
  `bid` int(4) NOT NULL,
  `bprog` int(2) DEFAULT NULL COMMENT 'Progressivo',
  `bstat` varchar(1) DEFAULT NULL COMMENT 'A=annullato',
  `bmenu` varchar(20) DEFAULT NULL COMMENT 'Nome',
  `btipo` varchar(20) DEFAULT NULL COMMENT 'Aspetto',
  `btesto` varchar(100) DEFAULT NULL COMMENT 'Titolo',
  `bselect` int(1) DEFAULT NULL COMMENT 'Voce corrente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

$PDO->exec("INSERT INTO `".$_POST['pref']."mnu` (`bid`, `bprog`, `bstat`, `bmenu`, `btipo`, `btesto`, `bselect`) VALUES
(16, 57, '', 'admin', 'ul2', 'Amministrazione sito', 1)");
echo "<br />Creata tabella MNU";

 //==================================================================================     
$PDO->exec("CREATE TABLE `".$_POST['pref']."nav` (
  `nid` int(4) NOT NULL COMMENT 'chiave unica',
  `nprog` int(3) NOT NULL COMMENT 'Progressivo',
  `nstat` varchar(1) DEFAULT NULL COMMENT 'A=annullato',
  `nmenu` varchar(20) NOT NULL COMMENT 'Nome menu',
  `nli` varchar(50) NOT NULL COMMENT 'Voce di menu',
  `ntesto` varchar(100) NOT NULL COMMENT 'Descrizione',
  `ndesc` varchar(50) DEFAULT NULL COMMENT 'Sottovoce',
  `ntarget` varchar(30) DEFAULT NULL COMMENT 'Target',
  `nselect` int(1) NOT NULL COMMENT 'Voce corrente',
  `ntipo` varchar(30) NOT NULL COMMENT 'tipo voce',
  `npag` varchar(1) NOT NULL COMMENT 'pagina voce',
  `nsotvo` varchar(30) NOT NULL COMMENT 'Comando',
  `nhead` int(1) NOT NULL COMMENT 'Header specifico',
  `ntitle` int(1) NOT NULL COMMENT 'Titolo pagina',
  `naccesso` int(1) NOT NULL COMMENT 'Liv.accesso',
  `nmetakey` varchar(50) NOT NULL COMMENT 'Meta keywords'
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

$PDO->exec("INSERT INTO `".$_POST['pref']."nav` (`nid`, `nprog`, `nstat`, `nmenu`, `nli`, `ntesto`, `ndesc`, `ntarget`, `nselect`, `ntipo`, `npag`, `nsotvo`, `nhead`, `ntitle`, `naccesso`, `nmetakey`) VALUES
(7, 123, '', 'admin', 'Backoffice', 'Voci di menu', 'Voci_menu', '', 1, 'ifr', ' ', 'gest_nav.php', 0, 0, 0, ''),
(12, 140, '', 'admin', 'Backoffice', 'Gestione utenti', 'Utenti', '', 1, 'ifr', ' ', 'gest_ute.php', 0, 0, 0, ''),
(19, 106, '', 'admin', 'Backoffice', 'Menu', 'Menu', '', 1, 'ifr', ' ', 'gest_mnu.php', 0, 0, 0, ''),
(59, 250, '', 'admin', 'Backoffice', 'Configurazione', 'Configurazione', '', 1, 'ifr', ' ', 'gest_config.php', 0, 0, 0, ''),
(106, 220, '', 'admin', 'Utility', 'Dati per debug', 'Debug ', '', 0, 'ifr', ' ', 'dsp_session.php', 0, 0, 0, ''),
(109, 150, '', 'admin', 'Backoffice', 'Tipologie codificate', 'Tipologie', '', 1, 'ifr', ' ', 'gest_xdb.php', 0, 0, 0, ''),
(155, 200, '', 'admin', 'Utility', 'Utility amministratore', '', '', 0, 'ifr', ' ', 'widget.php', 0, 0, 9, ''),
(159, 288, '', 'admin', 'Utility', 'Struttura tabelle DB', 'Struttura_DB', '', 0, 'ifr', ' ', 'struct_db.php', 0, 0, 0, ''),
(169, 290, '', 'admin', 'Utility', 'Dati del server (__FILE__ e $_SERVER)', 'Server', '', 0, 'ifr', ' ', 'gest_server.php', 0, 0, 0, ''),
(176, 103, '', 'admin', 'Backoffice', 'Amministrazione ', '', '', 1, 'ifr', ' ', 'widget.php', 0, 0, 9, ''),
(187, 328, '', 'admin', 'Backoffice', 'Gestione template', 'Template', '', 1, 'ifr', '', 'gest_tmp.php', 0, 0, 0, ''),
(189, 100, '', 'admin', '---------------', 'Separatore', '', '', 0, 'lnk', '', '#', 0, 0, 9, 'Meta keys.'),
(211, 350, '', 'admin', 'Backoffice', 'Gestione articoli', 'Articoli', '', 1, 'ifr', '', 'gest_art.php', 0, 0, 0, ''),
(230, 365, '', 'admin', 'help', 'Modifiche al progetto', 'Changelog', '', 0, 'art', '', 'changelog', 0, 0, 0, ''),
(231, 370, '', 'admin', 'Utility', 'Informazioni PHP', 'phpinfo()', '', 0, 'ifr', '0', 'phpinfo.php', 0, 0, 0, ''),
(232, 375, '', 'admin', 'Backoffice', 'Capitoli di argomento', 'Capitoli', '', 0, 'ifr', '0', 'gest_cap.php', 0, 0, 0, 'capitoli'),
(233, 380, '', 'admin', 'Backoffice', 'Argomento di capitoli e articoli', 'Argomenti', '', 0, 'ifr', '0', 'gest_arg.php', 0, 0, 0, 'argomenti,capitoli,articoli'),
(234, 385, '', 'admin', 'Backoffice', 'Lingue per traduzioni', 'Lingue', '', 0, 'ifr', '0', 'gest_lang.php', 0, 0, 0, 'lingue'),
(235, 390, '', 'admin', 'Backoffice', 'Gestione dei template', 'Cambio template', '', 0, 'ifr', '0', 'change_tmp.php', 0, 0, 0, 'template')");
echo "<br />Creata tabella NAV";

 //==================================================================================     
$PDO->exec("CREATE TABLE `".$_POST['pref']."tmp` (
  `tid` int(4) NOT NULL,
  `tprog` int(2) NOT NULL COMMENT 'Progressivo',
  `tstat` varchar(1) NOT NULL COMMENT 'Stato record',
  `tcod` varchar(20) NOT NULL COMMENT 'codice',
  `tsel` varchar(1) NOT NULL COMMENT '* = attivato',
  `ttipo` varchar(5) NOT NULL COMMENT 'Tipo',
  `ttdesc` varchar(50) NOT NULL COMMENT 'Nome template',
  `tfolder` varchar(50) NOT NULL COMMENT 'Percorso template',
  `tdesc` varchar(50) NOT NULL COMMENT 'Descrizione',
  `tmenu` varchar(20) NOT NULL COMMENT 'Men� base',
  `tlang` varchar(5) NOT NULL COMMENT 'Lingua',
  `tcolor` varchar(20) NOT NULL COMMENT 'Colore',
  `tslidebutt` int(1) NOT NULL COMMENT 'Bottoni navigazione',
  `tslidetime` int(6) NOT NULL COMMENT 'Tempo permanenza img',
  `tportitle` int(1) NOT NULL COMMENT 'titolo portfolio',
  `tgliftitle` varchar(50) NOT NULL COMMENT 'glifi-titolo',
  `tgliftext` tinytext NOT NULL COMMENT 'glifi-testo',
  `tglyforma` varchar(20) NOT NULL COMMENT 'forma',
  `tglyreverse` int(1) NOT NULL COMMENT 'In reverse',
  `tpromotitle` int(1) NOT NULL COMMENT 'titolo promo s/n',
  `tpromotit` varchar(50) NOT NULL COMMENT 'titolo promo',
  `tpromotext` tinytext NOT NULL COMMENT 'testo promo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1");

$PDO->exec("INSERT INTO `".$_POST['pref']."tmp` (`tid`, `tprog`, `tstat`, `tcod`, `tsel`, `ttipo`, `ttdesc`, `tfolder`, `tdesc`, `tmenu`, `tlang`, `tcolor`, `tslidebutt`, `tslidetime`, `tportitle`, `tgliftitle`, `tgliftext`, `tglyforma`, `tglyreverse`, `tpromotitle`, `tpromotit`, `tpromotext`) VALUES
(6, 60, '', 'blog', '*', 'sito', 'Blog', 'templates/blog/', 'Template per FBOT', 'blog', 'it', 'primary', 1, 5000, 1, 'Servizi', 'Servizi offerti dalla società.', 'circle', 1, 0, 'Veicoli', 'Veicoli in promozione'),
(10, 70, '', 'admin', '*', 'admin', 'Amministratore', 'templates/admin/', 'Template amministratore', 'admin', 'it', 'info', 0, 0, 0, '', '', 'circle', 0, 0, '', '')");
echo "<br />Creata tabella TMP";

 //==================================================================================     
$PDO->exec("CREATE TABLE `".$_POST['pref']."ute` (
  `uid` int(2) NOT NULL,
  `ustat` varchar(1) NOT NULL COMMENT 'Stato record',
  `uprog` int(2) NOT NULL DEFAULT '0' COMMENT 'Progressivo',
  `username` varchar(20) DEFAULT NULL COMMENT 'Utente',
  `upassword` varchar(50) DEFAULT NULL COMMENT 'Password',
  `uaccesso` int(1) NOT NULL DEFAULT '0' COMMENT 'Liv. accesso',
  `uiscritto` int(1) NOT NULL COMMENT 'Nr.iscritto'
) ENGINE=InnoDB DEFAULT CHARSET=latin1");


$PDO->exec("INSERT INTO `".$_POST['pref']."ute` (`uid`, `ustat`, `uprog`, `username`, `upassword`, `uaccesso`, `uiscritto`) VALUES
(7, '', 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 9, 0),
(13, '', 0, 'test', '098f6bcd4621d373cade4e832627b4f6', 0, 0)");
echo "<br />Creata tabella UTE";

 //==================================================================================     

$PDO->exec("CREATE TABLE `".$_POST['pref']."xdb` (
  `xid` int(3) NOT NULL COMMENT 'chiave',
  `xstat` varchar(1) NOT NULL COMMENT 'stato record',
  `xprog` int(3) NOT NULL COMMENT 'progressivo',
  `xtipo` varchar(5) NOT NULL COMMENT 'tipo',
  `xcod` tinytext NOT NULL COMMENT 'codice',
  `xdes` text NOT NULL COMMENT 'descrizione'
) ENGINE=InnoDB DEFAULT CHARSET=latin1");


$PDO->exec("INSERT INTO `".$_POST['pref']."xdb` (`xid`, `xstat`, `xprog`, `xtipo`, `xcod`, `xdes`) VALUES
(7, '', 35, 'menu', 'txt', 'menu nel testo'),
(9, '', 40, 'menu', 'uli', 'tab '),
(10, '', 45, 'menu', 'ul1', 'tab una immagine'),
(11, '', 50, 'menu', 'ul2', 'tab 2 immagini'),
(12, '', 55, 'menu', 'lnk', 'link'),
(13, '', 60, 'menu', 'fld', 'fieldset'),
(20, '', 95, 'voce', 'art', 'voce tipo articolo'),
(21, '', 100, 'voce', 'cap', 'voce tipo capitolo'),
(22, '', 105, 'voce', 'arg', 'voce tipo argomento'),
(23, '', 110, 'voce', 'vid', 'voce tipo video YouTube'),
(24, '', 115, 'voce', 'gal', 'voce tipo gallery di Picasa'),
(25, '', 120, 'voce', 'lnk', 'voce tipo link interno'),
(32, '', 93, 'voce', '', 'Nessun tipo voce'),
(33, '', 140, 'trg', '_blank', 'Nuova finestra'),
(34, '', 145, 'trg', '', 'Nessun tipo trg'),
(35, '', 150, 'trg', '_parent', 'Nella stessa finestra'),
(36, '', 155, 'trg', '_scratch', 'Nuova finnestra'),
(37, '', 160, 'trg', '_self', 'Stesso frame'),
(38, '', 165, 'trg', '_top', 'Ricopre la stessa finestra'),
(41, '', 180, 'voce', 'ifr', 'voce tipo PHP/HTML in iframe'),
(42, '', 185, 'tab', 'n_arg', 'Argomenti'),
(43, '', 190, 'tab', 'n_art', 'Articoli'),
(44, '', 195, 'tab', 'n_cap', 'Capitoli'),
(45, '', 200, 'tab', 'n_gal', 'Galleria fotografica'),
(46, '', 205, 'tab', 'n_mnu', 'Menu'),
(47, '', 210, 'tab', 'n_mod', 'Moduli'),
(48, '', 215, 'tab', 'n_nav', 'Navigatore semplice'),
(50, '', 225, 'tab', 'n_tmp', 'Templates'),
(51, '', 230, 'tab', 'n_ute', 'Utenti'),
(53, '', 236, 'tab', 'n_xdb', 'Tipologie'),
(54, '', 126, 'voce', 'htm', 'voce tipo HTML custom'),
(94, '', 379, 'stato', ' ', 'Attivo'),
(95, '', 384, 'stato', 'A', 'Sospeso'),
(865, '', 609, 'msg', '0', 'Operazione abortita per errori'),
(866, '', 614, 'msg', ' ', ' '),
(867, '', 619, 'msg', '1', 'Operazione invalida'),
(868, '', 624, 'msg', '4', 'Effettuare una scelta'),
(869, '', 629, 'msg', '5', 'Pagamento già effettuato'),
(870, '', 634, 'msg', '2', 'Operazione annullata dall\' utente'),
(871, '', 639, 'msg', '53', 'Record cancellato'),
(872, '', 644, 'msg', '54', 'Record aggiunto'),
(873, '', 649, 'msg', '55', 'Record modificato'),
(874, '', 654, 'msg', '56', 'Immagine cancellata'),
(875, '', 659, 'msg', '57', 'Immagine caricata'),
(876, '', 664, 'msg', '58', 'Immagine scaricata'),
(877, '', 669, 'msg', '59', 'Record archiviato'),
(878, '', 674, 'msg', '60', 'Record ripristinato'),
(879, '', 679, 'msg', '101', 'Nota'),
(880, '', 684, 'msg', '151', 'Informazione'),
(882, '', 694, 'lin', 'it', 'Italiano'),
(883, '', 699, 'lin', 'fr', 'Francese'),
(884, '', 704, 'lin', 'en', 'Inglese'),
(885, '', 709, 'ttmp', 'admin', 'admin'),
(886, '', 714, 'ttmp', 'blog', 'sito'),
(887, '', 719, 's-n', '1', 'SI'),
(888, '', 724, 's-n', '0', 'NO'),
(889, '', 729, 'color', 'danger', 'Rosso'),
(890, '', 734, 'color', 'warning', 'Ocra'),
(891, '', 739, 'color', 'info', 'Azzurro'),
(892, '', 744, 'color', 'default', 'Bianco'),
(893, '', 749, 'color', 'primary', 'Blue'),
(894, '', 754, 'color', 'basic', 'Grigio'),
(895, '', 759, 'forma', 'square', 'Quadrata'),
(896, '', 764, 'forma', 'circle', 'Circolare'),
(897, '', 769, 'forma', 'square-arr', 'Quadrata arrotondata')";
echo "<br />Creata tabella XDB";

//==================================================================================     
$PDO->exec("ALTER TABLE `".$_POST['pref']."arg`
  ADD PRIMARY KEY (`rid`)");

$PDO->exec("ALTER TABLE `".$_POST['pref']."art`
  ADD PRIMARY KEY (`aid`)");

$PDO->exec("ALTER TABLE `".$_POST['pref']."cap`
  ADD PRIMARY KEY (`cid`)");

$PDO->exec("ALTER TABLE `".$_POST['pref']."mnu`
  ADD PRIMARY KEY (`bid`)");

$PDO->exec("ALTER TABLE `".$_POST['pref']."nav`
  ADD PRIMARY KEY (`nid`)");

$PDO->exec("ALTER TABLE `".$_POST['pref']."tmp`
  ADD PRIMARY KEY (`tid`)");

$PDO->exec("ALTER TABLE `".$_POST['pref']."ute`
  ADD PRIMARY KEY (`uid`)");

$PDO->exec("ALTER TABLE `".$_POST['pref']."xdb`
  ADD PRIMARY KEY (`xid`)");

$PDO->exec("ALTER TABLE `".$_POST['pref']."arg`
  MODIFY `rid` int(3) NOT NULL AUTO_INCREMENT COMMENT 'id record', AUTO_INCREMENT=6");

$PDO->exec("ALTER TABLE `".$_POST['pref']."art`
  MODIFY `aid` int(3) NOT NULL AUTO_INCREMENT COMMENT 'id record', AUTO_INCREMENT=78");

$PDO->exec("ALTER TABLE `".$_POST['pref']."cap`
  MODIFY `cid` int(3) NOT NULL AUTO_INCREMENT COMMENT 'id record', AUTO_INCREMENT=12");

$PDO->exec("ALTER TABLE `".$_POST['pref']."mnu`
  MODIFY `bid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17");

$PDO->exec("ALTER TABLE `".$_POST['pref']."nav`
  MODIFY `nid` int(4) NOT NULL AUTO_INCREMENT COMMENT 'chiave unica', AUTO_INCREMENT=236");

$PDO->exec("ALTER TABLE `".$_POST['pref']."tmp`
  MODIFY `tid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12");

$PDO->exec("ALTER TABLE `".$_POST['pref']."ute`
  MODIFY `uid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14");

$PDO->exec("ALTER TABLE `".$_POST['pref']."xdb`
  MODIFY `xid` int(3) NOT NULL AUTO_INCREMENT COMMENT 'chiave', AUTO_INCREMENT=885");
$PDO->exec("COMMIT");
echo "<br />Create chiavi primarie e autoincremento chiavi";


// chiusura database 
$PDO = NULL; 
echo "<br />Tutte le tabelle sono state create" ;
?>  
  </body>
</html>
