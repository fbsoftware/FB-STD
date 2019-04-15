<?php
echo "<header>"; 
echo "<img class='marchio' src='images/logo/logo.png' alt='logo.png' title='logo' >";
echo "<p>Amministrazione&nbsp;-&nbsp;".DB::$page_title." 
          <img class='marchio' src='images/".$_COOKIE['admin'].".png' alt='".$_COOKIE['admin'].".png' title='".$_COOKIE['admin']."' >
          <span class='right little'>Versione ".DB::$livello.".".DB::$rilascio.".".DB::$modifica."</span></p>";
echo "</header>";
?>                             
   
