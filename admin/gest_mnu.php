<?php  session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
   * package		FB open template
   * versione 2.0.1
   * copyright	Copyright (C) 2022 - 2023 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
=============================================================================
	07.03.21	tolto bootstrap sostituito da flex
	09/02/22	action=include()
=============================================================================*/
// toolbar
	$param  = array('nuovo','modifica','copia','cancella','chiudi');
	$btx    = new bottoni_str_par('Menù','mnu','upd_mnu.php',$param);
		$btx->btn();

// memorizza location iniziale
	$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
$parm = $_SESSION['esito'];
$m = new msg($parm);
$m->msg();

//   testata
echo "<section id='mnu'>";

echo "<div class='table fb-hv80'>";

echo "<div class='th'>";
echo "<div class='td'>Scelta</div>";
echo "<div class='td'>Stato</div>";
echo "<div class='td'>Progr.</div>";
echo "<div class='td'>Nome</div>";
echo "<div class='td'>Tipo</div>";
echo "<div class='td'>Descrizione</div>";
echo "<div class='td'>Selezionato</div>";
echo "</div>";


$sql = "SELECT * FROM ".DB::$pref."mnu
		ORDER BY bprog";
	foreach($PDO->query($sql) as $row)
      {
		require('fields_mnu.php');
		echo "<div class='tr'>";
		echo "<div class='td'>";
		$f2 = new input(array($bid,'bid',2,'','Scelta','ck-n'));
			$f2->field_n(); echo "</div>";
		echo "<div class='td'>";
		$ff = new input(array($bstat,'bstat',2,'','','st-n'));
			$ff->field_n(); echo "</div>";
  ?>
		<div class='td'><?= $bprog ?></div>
		<div class='td'><?= $bmenu ?></div>
		<div class='td'><?= $btipo ?></div>
		<div class='td'><?= $btesto ?></div>
		<div class='td'><?= $bselect ?></div>
<?php
     echo "</div>";
          }
	echo "</div>";
	echo "</section>";
	echo "</form>";
?>
