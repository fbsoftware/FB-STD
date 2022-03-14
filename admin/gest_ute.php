<?php  session_start();
/**
    Fausto Bresciani   fbsoftware@libero.it  www.fbsoftware.altervista.org
    package		FB open template
    versione 1.02
    copyright	Copyright (C) 2022 - 2023 FB. All rights reserved.
    license		GNU/GPL
    Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
    all'uso anche improprio di FB open template.
------------------------------------------------------------------------------
01/03/2022	aggiunta copia nuove include in "write"
============================================================================= */

//   bottoni gestione
	$param = array('nuovo','modifica','copia','cancella','chiudi');
	$btx   = new bottoni_str_par('Utenti','ute','upd_ute.php',$param);
		$btx->btn();

// memorizza location iniziale
	$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
$parm = $_SESSION['esito'];
$m = new msg($parm);
$m->msg();

//   testate
echo "<section id='ute'>";

echo "<div class='table fb-hv80'>";

echo "<div class='th'>";
echo "<div class='td'>Scelta</div>";
echo "<div class='td'>Stato</div>";
echo "<div class='td'>Progr.</div>";
echo "<div class='td'>Utente</div>";
echo "<div class='td'>Livello accesso</div>";
echo "</div>";

// transazione
     $sql = "SELECT * FROM `".DB::$pref."ute`
          ORDER BY username";
     foreach($PDO->query($sql) as $row)
     {
     require('fields_ute.php');
     echo "<div class='tr'>";
		$f2 = new input(array($uid,'uid',2,'','Spuntare per scegliere l elemento','ck-n'));
		echo "<div class='td'>"; $f2->field_n(); echo "</div>";
		$f = new input(array($ustat,'ustat',2,'','','st-n'));
		echo "<div class='td'>"; $f->field_n(); echo "</div>";
?>
     <div class='td'><?php echo $uprog ?></div>
     <div class='td'><?php echo $username ?></div>
     <div class='td'><?php echo $uaccesso ?></div>
<?php
     echo "</div>";
          }
	echo "</div>";
	echo "</section>";
	echo "</form>";
?>
