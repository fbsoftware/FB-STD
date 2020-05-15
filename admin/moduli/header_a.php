<link rel="stylesheet" type="text/css" href="css/styles-flexo.css" />
<?php
echo "<header>"; 
echo "<div class='flex row'>";

echo "<div class='item j-start'>";
echo "<img class='marchio' src='images/logo/logo.png' alt='logo.png' title='logo' >";
echo "</div>";

echo "<div class='item j-end'>";
echo "<p>Amministrazione&nbsp;-&nbsp;".DB::$page_title."</p>"; 
echo "</div>";

echo "<div class='item j-end'>";
echo "<img class='img-utente' src='images/".$_COOKIE['admin'].".png' alt='".$_COOKIE['admin'].".png' title='".$_COOKIE['admin']."' >";
echo "</div>";

echo "<div class='item j-end'>";
echo "<p class='little'>Versione ".DB::$livello.".".DB::$rilascio.".".DB::$modify."</p>";
echo "</div>";

echo "</div>";		// row
echo "</header>";
?>                             
   
