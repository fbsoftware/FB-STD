<?php 
//   toolbar
$param = array('ritorno');
$btx   = new bottoni_str_par('Informazioni su PHP','config','index.php?urla=widget.php&pag=',$param);     
     $btx->btn();
// zona messaggi
$M = new msg($_SESSION['esito']); $M->msg(); 
 
phpinfo(); 
?>