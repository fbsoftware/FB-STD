<?php
/* * Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
   * package		FB open template
   * versione 1.4   
   * copyright	Copyright (C) 2013 - 2014 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
==============================================================================*/ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>title</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="index,follow" />
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
<?php
require_once("../jquery_link.php");
echo "<link rel='stylesheet' href='../css/stili-custom.css' type='text/css' media='screen'>";
echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css'>";
require_once("../libFB_1_2_0/field.php");       

?>	
</head>

<body>
<?php
// definizione variabili
$host="localhost"; 
$user="";  
$pw="";  
$db="my_database";  
$pref="prefix_";  
$sep="/";
$e_mail="fbsoftware@xxxxxx.it"; 
$page_title="Installazione";  
$site="Libreria standard FB";  
$dir_imm="images/";  
$author="fbsoftware";
$keywords=""; 
$root="/FB-STD/";
$lib="libFB_1_2_0"; 
$url="http://fbsoftware.xxxxxxxxx.org"; 
$incr=5;

// testata
echo "<div class='row'>";
echo "<div class='col-md-7'> 
     <fieldset >
     <h3>Creazione del database con le tabelle del sito</h3>"; 
echo "</fieldset>";
echo "</div>";
echo "</div>";

// dati del database
echo "<div class='row'>";
echo "<div class='col-md-7'>
     <form action='database.php' method='post'>
     <fieldset><legend>Dati del database</legend> ";
	$f1 = new field($host,'host',20,'Host');   
		$f1->field_i();   
	$f2 = new field($user,'user',20,'Utente');   
		$f2->field_i();   
	$f3 = new field($pw,'pw',20,'Password'); 
		$f3->field_pw();  
	$f4 = new field($db,'db',20,'Database'); 
		$f4->field_i();   
	$f5 = new field($pref,'pref',20,'Prefisso');
		$f5->field_i();   
echo "</fieldset>";
echo "</div>";
echo "</div>";

// dati di configurazione 
echo "<div class='col-md-7'>
 	 <fieldset><legend>Dati di configurazione</legend>";
	$f6 = new field($site,'site',20,'Nome del sito');   
		$f6->field_i();   
	$f7 = new field($page_title,'page_title',20,'Titolo home page');   
		$f7->field_i();   
	$f8 = new field($root,'root',20,'Root sito');   
		$f8->field_i();   
	$f9 = new field($dir_imm,'p_imm',20,'Path immagini');   
		$f9->field_i();   
	$f0 = new field($author,'author',20,'Autore');   
		$f0->field_i();   
	$fa = new field($keywords,'keywords',40,'Keywords');
		$fa->field_i();              
	$fc = new field($sep,'sep',20,'Separatore dei path');
		$fc->field_i();             
	$fd = new field($incr,'incr',20,'Incremento record DB');
		$fd->field_i();              
	$fe = new field($e_mail,'e_mail',20,'E-mail del sito');
		$fe->field_i();	   
	$fb = new field($lib,'lib',20,'Libreria classi std.');
		$fb->field_i();            
	$ff = new field($url,'url',20,'Sito dell\'autore');
		$ff->field_i();             
echo "</fieldset>";     
echo "</div>";

//  avvio creazione 
echo "<div class='col-md-7'>";
echo "<fieldset>
     <label for='subm-crea'>Avvia la creazione</label> 
          <button  class='btn btn-primary' type='submit' id='subm-crea' value='OK' >OK</button>";
echo "</fieldset>";    
echo "</form>";
echo "</div>";
?>
</body>
</html>
