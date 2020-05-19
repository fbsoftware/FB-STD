<?php
/*==========================================================
 * 15/5/2020	struttura FLEX
===========================================================*/
echo "<header>"; 
echo "<div class='f-flex  jc-between'>";

echo "<div class='f-item'>";
echo "<img class='marchio' src='images/logo/logo.png' alt='logo.png' title='logo' >";
echo "</div>";

echo "<div class='f-item'>";
echo "<p>Amministrazione&nbsp;-&nbsp;".DB::$page_title."</p>"; 
echo "</div>";

echo "<div class='f-item'>";
echo "<img class='img-utente' src='images/".$_COOKIE['admin'].".png' alt='".$_COOKIE['admin'].".png' title='".$_COOKIE['admin']."' >";
echo "</div>";

echo "<div class='f-item'>";
echo "<p class='little'>Versione ".DB::$livello.".".DB::$rilascio.".".DB::$modify."</p>";
echo "</div>";

echo "</div>";		// flex
echo "</header>";
?>                             
   
