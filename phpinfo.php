<?php 
//   toolbar
$param = array('ritorno');
$btx   = new bottoni_str_par('Dati del server','config','index.php?urla=widget.php&pag=',$param);     
     $btx->btn();
// zona messaggi
include_once 'msg.php'; 
 
phpinfo(); 
?>