<?php
/*==========================================================
 * 15/5/2020	struttura FLEX
===========================================================*/
echo "<header  style='margin-top :10px ;'>"; 
echo "<div class='f-flex fd-row jc-between'>";

echo "<div class='f-item'>";
echo "<img class='marchio' src='images/logo/logo.png' alt='logo.png' title='logo' >";
echo "</div>";

echo "<div class='f-item'>";
echo "<h3>Amministrazione&nbsp;-&nbsp;".DB::$page_title."</h3>"; 
echo "</div>";

echo "<div class='f-item'>";
echo "<img class='marchio' src='images/".$_COOKIE['admin'].".png' alt='".$_COOKIE['admin'].".png' title='".$_COOKIE['admin']."' >";
echo "</div>";

echo "<div class='f-item'>";
echo "<h3>V-".DB::$livello.".".DB::$rilascio.".".DB::$modify."</h3>";
echo "</div>";

echo "</div>";		// flex
echo "</header>";
?>                             
   
