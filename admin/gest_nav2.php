<?php   session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
   * package		FB open template
   * versione 3.0   
   * copyright	Copyright (C) 2019 - 2020 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta 
   * all'uso anche improprio di FB open template.
=============================================================================  
   * Gestione della tabella 'nav' voci di menu e sottovoci.
   * Aggiunto "nhead" per gestire header per ogni voce menu (Max.9).
   * 1.0.0	nuovo head breve
=============================================================================  */
require_once('init_admin.php');

 if ($_POST['submit'] == 'chiudi') 
               header('location:admin.php?urla=widget.php&pag=');        
echo "<body class='admin' data-theme='".TMP::$tcolor."'>";     

  //   toolbar
	$param  = array($NEW.'|nuovo',$MOD.'|modifica',$DEL.'|cancella',$RET.'|ritorno');    
	$btx    = new bottoni_str_par($VOCI_MENU,'nav','upd_nav.php',$param);  
		$btx->btn();
  
     // mostra la tabella filtrata 
echo "<section id='nav'>"; 

echo "<div class='table fb-h80'>"; 

echo "<div class='th'>"; 
echo "<div class='td'>$SCEL</div>";
echo "<div class='td'>$ST</div>";
echo "<div class='td'>$PROG</div>";  
echo "<div class='td'>$MENU</div>";
echo "<div class='td'>$VOCE</div>";
echo "<div class='td'>$SVOCE</div>";
echo "<div class='td'>$DESC</div>";
echo "<div class='td'>$TIPO</div>";             
echo "<div class='td'>$CONT</div>";
echo "<div class='td'>$ACC</div>";
echo "<div class='td'>$PARAM</div>";
echo "</div>";
 // lettura database
if ($_POST['menu'] == 'tutti') 
	{    
     $sql = "  SELECT * 
               FROM `".DB::$pref."nav` 
               ORDER BY nprog,nli ";} 
else {
     $sql = "  SELECT * 
               FROM `".DB::$pref."nav` 
			   WHERE nmenu = '".$_POST['menu']."'
               ORDER BY nprog,nli";}    
			   
            foreach($PDO->query($sql) as $row)             
  {  require('fields_nav.php');

		echo "<div class='tr'>";
		$f2 = new input(array($nid,'nid',2,'',$TT_SCEL,'ck-n'));     
		echo "<div class='td'>"; $f2->field_n(); echo "</div>";
		$st = new input(array($nstat,'nstat',2,'','','st-n'));        
		echo "<div class='td'>"; $st->field_n(); echo "</div>";
       ?>
     <div class='td'><?php echo $nprog ?></div> 
     <div class='td'><?php echo $nmenu ?></div>
     <div class='td'><?php echo $nli ?></div>
     <div class='td'><?php echo $ndesc ?></div>
     <div class='td'><?php echo $ntesto ?></div>
     <div class='td'><?php echo $ntipo ?></div>
     <div class='td'><?php echo $nsotvo ?></div>
     <div class='td'><?php echo $naccesso ?></div>  
	 <div class='td'><?php echo $npag ?></div> 
	 
<?php 
     echo "</div>";               
          }
	echo "</div>";
	echo "</section>";
	echo "</form>";
	echo "</body>";
?> 