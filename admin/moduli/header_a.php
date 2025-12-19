<?php
/**
18/04/22  flex
*/
echo "<header>";
echo "<div class='f-flex fd-row jc-between ai-center'>";

echo "<div>";
echo "<img class='marchio' src='images/logo/logo.png' alt='logo.png' title='logo' >";
echo "</div>";

//echo "<div>";
//echo "<p>".DB::$page_title."</p>";
//echo "</div>";

echo "<div class='f-4'>";
require_once('nav2a.php');
echo "</div>";

echo "<div>";
echo "<p class='little'>Versione ".DB::$livello.".".DB::$rilascio.".".DB::$modify.":&nbsp;<img class='img-utente' src='images/archivi/".$_COOKIE['admin'].".png' alt='".$_COOKIE['user'].".png' title='".$_COOKIE['user']."' ></p>";
echo "</div>";

//  bottone logout
echo "<div>";
echo "<form class='bottoni' method='post' action='login.php'>";
echo "<button class='fb-accent fb-p025 fb-rad7 fb-m05' type='submit' name='submit' value='chiudi'> ";
echo "<img src='".DB::$dir_imm."uscita.png' alt='uscita' height='25'>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;Uscita";
echo "</button>";
echo "</form>";
echo "</div>";

echo "</div>";		// flex
echo "</header>";
?>
