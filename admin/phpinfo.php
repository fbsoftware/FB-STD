<?php 
//   toolbar
$param = array('ritorno');
$btx   = new bottoni_str_par('Informazioni su PHP','config','admin.php?urla=widget.php&pag=',$param);     
     $btx->btn();
// zona messaggi
$M = new msg($_SESSION['esito']); $M->msg(); 
 
phpinfo(); 
?>