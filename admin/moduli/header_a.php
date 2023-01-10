<?php
/**
18/04/22  flex
*/
echo "<header>";
echo "<div class='f-flex fd-row jc-between ai-center'>";

echo "<div>";
echo "<img class='marchio' src='images/logo/logo.png' alt='logo.png' title='logo' >";
echo "</div>";

echo "<div>";
echo "<p>".DB::$page_title."</p>";
echo "</div>";

echo "<div>";
echo "<p class='little'>Utente:&nbsp;<img class='img-utente' src='images/".$_COOKIE['admin'].".png' alt='".$_COOKIE['user'].".png' title='".$_COOKIE['user']."' ></p>";
echo "</div>";

echo "<div>";
echo "<p class='little'>Versione ".DB::$livello.".".DB::$rilascio.".".DB::$modify."</p>";
echo "</div>";

echo "</div>";		// flex
echo "</header>";
?>
