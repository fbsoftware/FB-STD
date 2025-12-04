<?php  session_start();
/*** Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
   * package		FB open template
   * versione 3.1
   * copyright	Copyright (C) 2025 - 2026 FB. All rights reserved.
   * license		GNU/GPL
   * Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
   * all'uso anche improprio di FB open template.
============================================================================= */
?>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
<?php
require_once('init_admin.php');
//print_r($_POST);//debug

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];
echo "<body class='admin'>";

 //   bottoni gestione
$param = array('upload','chiudi');
$btx   = new bottoni_str_par('Gestione dei media','img','upd_media.php',$param);
     $btx->btn();

// zona messaggi
$parm = $_SESSION['esito'];
$m = new msg($parm);
$m->msg();

// emette tabella con immagini
     $im = new imgUpdTable($_POST['pcol'],120,50,7,'upd_media.php?path='.$_POST['pcol'].'');
     $im->putUpdTable();
     // memorizza il path scelto
       echo "<input type='hidden' name='img_path' value='".$_POST['pcol']."' />";
    echo "</form>";
	 echo "</body>";
?>
