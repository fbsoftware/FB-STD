<?php
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.4 (beta)   
   * copyright	Copyright (C) 2012 - 2013 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
============================================================================= 
  Legge le variabili relative al template in uso.
=============================================================================== */
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();  
$sql = "select * FROM `".DB::$pref."tmp` WHERE ttdesc='admin' ";
foreach($PDO->query($sql) as $row)  
   	if ( $row['tfolder'] != "") 
{ 
  $tipo   = $row['ttipo'] ;
  $desc   = $row['ttdesc'] ;
  $path   = $row['tfolder'] ;
  $col1   = $row['tcol1'] ;
  $col2   = $row['tcol2'] ;
  $col3   = $row['tcol3'] ;
  $menu   = $row['tmenu'] ;
}
?> 