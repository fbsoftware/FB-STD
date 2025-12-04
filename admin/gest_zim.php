<?php    session_start();       ob_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
   * package		FB open template
   * versione 1.3
   * copyright	Copyright (C) 2025 - 2026 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
   * ------------------------------------------------------------------------
   * gestione tabella 'zim' immagine zoomabile
============================================================================= */


 //   toolbar
$param = array("nuovo","modifica","copia","cancella","ritorno");
$btx   = new bottoni_str_par('Immagine zoomabile','zim','upd_zim.php',$param);
     $btx->btn();
// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];
     // mostra la tabella filtrata

echo "<section id='xzim'>";

echo "<div class='table fb-hv80'>";

echo "<div class='th'>";
echo "<div class='td'>Scelta</div>";
echo "<div class='td'>Stato</div>";
echo "<div class='td'>Progr.</div>";
echo "<div class='td'>Template</div>";
echo "<div class='td'>Pagina</div>";
echo "<div class='td'>Codice</div>";
echo "<div class='td'>Path immagine</div>";
echo "<div class='td'>Immagine</div>";
echo "</div>";

 // lettura database
	     $sql = "SELECT *
               FROM ".DB::$pref."zim
			ORDER BY zcod";

// transazione
     $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
     $PDO = new PDO($con,DB::$user,DB::$pw);
     $PDO->beginTransaction();
      foreach($PDO->query($sql) as $row)
          {
          require('fields_zim.php');
          echo "<div class='tr'>";
		$f2 = new input(array($zid,'zid',2,'','','ck-n'));
		echo "<div class='td'>";
      $f2->field_n(); echo "</div>";
		$f = new input(array($zstat,'xstat',2,'','','st-n'));
		echo "<div class='td'>";
      $f->field_n(); echo "</div>";
                    ?>
          <div class='td'><?php echo $zprog ?></div>
          <div class='td'><?php echo $ztmp ?></div>
          <div class='td'><?php echo $zpage ?></div>
          <div class='td'><?php echo $zcod ?></div>
          <div class='td'><?php echo $zimg ?></div>
          <div class='td'><img src="<?php echo $zimg ?>"! alt="img" width="100" /></div>
          <?php
     echo "</div>";
          }
	echo "</div>";
	echo "</section>";
	echo "</form>";
	echo "</body>";
?>