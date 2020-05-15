<?php
/*==========================================================
 * 15/5/2020	struttura FLEX
===========================================================*/
echo "<link rel='stylesheet' type='text/css' href='../templates/admin/css/styles-flexo.css' />";

echo "<header>"; 
echo "<div class='flex  j-between'>";

echo "<div class='item'>";
echo "<img class='marchio' src='images/logo/logo.png' alt='logo.png' title='logo' >";
echo "</div>";

echo "<div class='item'>";
echo "<p>Amministrazione&nbsp;-&nbsp;".DB::$page_title."</p>"; 
echo "</div>";

echo "<div class='item'>";
echo "<img class='img-utente' src='images/".$_COOKIE['admin'].".png' alt='".$_COOKIE['admin'].".png' title='".$_COOKIE['admin']."' >";
echo "</div>";

echo "<div class='item'>";
echo "<p class='little'>Versione ".DB::$livello.".".DB::$rilascio.".".DB::$modify."</p>";
echo "</div>";

echo "</div>";		// flex
echo "</header>";
?>                             
   
