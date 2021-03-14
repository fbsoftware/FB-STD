<?php    session_start();       ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 1.3    
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'xdb' sipologie codificate. 
   * 28/5/2019	aggiunta copia
============================================================================= */ 
require_once('init_admin.php');

 //   toolbar
$param = array($NEW."|nuovo",$MOD."|modifica",$COPY."|copia",$DEL."|cancella",$RET."|ritorno");
$btx   = new bottoni_str_par($TIP,'xdb','upd_xdb.php',$param);     
     $btx->btn();

     // mostra la tabella filtrata 
   
echo "<section id='xdb'>";

echo "<div class='table fb-h80'>"; 

echo "<div class='th'>"; 
echo "<div class='td'>$SCEL</div>";
echo "<div class='td'>$ST</div>";
echo "<div class='td'>$PROG</div>"; 
echo "<div class='td'>$TIPO</div>";
echo "<div class='td'>$COD</div>";
echo "<div class='td'>$DESC</div>";
echo "</div>"; 

 // lettura database
if ($_POST['settori'] == 'tutti') 
	{     $sql = "SELECT * 
               FROM ".DB::$pref."xdb 
               ORDER BY xtipo,xcod";	} 
else {
	     $sql = "SELECT * 
               FROM ".DB::$pref."xdb 
			   WHERE xtipo = '".$_POST['settori']."'
               ORDER BY xtipo,xdes";	
}
 
// transazione    
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction(); 
      foreach($PDO->query($sql) as $row)
          {   
          require('fields_xdb.php');
          echo "<div class='tr'>";
		$f2 = new input(array($xid,'xid',2,'',$TT_SCEL,'ck-n'));     
		echo "<div class='td'>"; $f2->field_n(); echo "</div>";
		$st = new input(array($xstat,'xstat',2,'','','st-n'));        
		echo "<div class='td'>"; $st->field_n(); echo "</div>";
                    ?>
          <div class='td'><?php echo $xprog ?></div> 
          <div class='td'><?php echo $xtipo ?></div> 
          <div class='td'><?php echo $xcod ?></div> 
          <div class='td'><?php echo $xdes ?></div>      
          <?php
     echo "</div>";               
          }
	echo "</div>";
	echo "</section>";
	echo "</form>";
?> 
