<?php
echo "<header>"; 
echo "<div class='row'>";

echo "<div class='col-md-1'>";
echo "<img class='marchio' src='images/logo/logo.png' alt='logo.png' title='logo' >";
echo "</div>";

echo "<div class='col-md-8'>";
echo "<p>Amministrazione&nbsp;-&nbsp;".DB::$page_title."</p>"; 
echo "</div>";

echo "<div class='col-md-1'>";
echo "<img class='img-utente' src='images/".$_COOKIE['admin'].".png' alt='".$_COOKIE['admin'].".png' title='".$_COOKIE['admin']."' >";
echo "</div>";

echo "<div class='col-md-2'>";
echo "<p class='little'>Versione ".DB::$livello.".".DB::$rilascio.".".DB::$modify."</p>";
echo "</div>";

echo "</div>";		// row
echo "</header>";
?>                             
   
