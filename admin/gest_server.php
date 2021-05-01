<?php
require_once('../loadLibraries.php');

//   bottoni gestione
$param = array('ritorno');
$btx   = new bottoni_str_par('Dati del server','config','admin.php?urla=widget.php&pag=',$param);     
     $btx->btn();
// zona messaggi
$M = new msg($_SESSION['esito']); $M->msg();     

echo "<div class='table fb-h80'>"; 

echo "<div class='th'>"; 
echo "<div class='td'>Variabile</div>";
echo "<div class='td'>Valore</div>";
echo "</div>";
echo "<div class='tr'>";  
echo "<div class='td'>FILE</div><div class='td'>".$_SERVER['PHP_SELF']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>PHP_SELF</div><div class='td'>".$_SERVER['PHP_SELF']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>GATEWAY_INTERFACE</div><div class='td'>".$_SERVER['GATEWAY_INTERFACE']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>SERVER_ADDR</div><div class='td'>".$_SERVER['SERVER_ADDR']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>SERVER_NAME</div><div class='td'>".$_SERVER['SERVER_NAME']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>SERVER_SOFTWARE</div><div class='td'>".$_SERVER['SERVER_SOFTWARE']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>SERVER_PROTOCOL</div><div class='td'>".$_SERVER['SERVER_PROTOCOL']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>REQUEST_TIME</div><div class='td'>".$_SERVER['REQUEST_TIME']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>QUERY_STRING</div><div class='td'>".$_SERVER['QUERY_STRING']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>DOCUMENT_ROOT</div><div class='td'>".$_SERVER['DOCUMENT_ROOT']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>HTTP_ACCEPT</div><div class='td'>".$_SERVER['HTTP_ACCEPT']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>HTTP_ACCEPT_ENCODING</div><div class='td'>".$_SERVER['HTTP_ACCEPT_ENCODING']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>HTTP_ACCEPT_LANGUAGE</div><div class='td'>".$_SERVER['HTTP_ACCEPT_LANGUAGE']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>HTTP_CONNECTION</div><div class='td'>".$_SERVER['HTTP_CONNECTION']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>HTTP_HOST</div><div class='td'>".$_SERVER['HTTP_HOST']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>REMOTE_ADDR</div><div class='td'>".$_SERVER['REMOTE_ADDR']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>HTTP_USER_AGENT</div><div class='td'>".$_SERVER['HTTP_USER_AGENT']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>SCRIPT_FILENAME</div><div class='td'>".$_SERVER['SCRIPT_FILENAME']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>SERVER_ADMIN</div><div class='td'>".$_SERVER['SERVER_ADMIN']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>SERVER_PORT</div><div class='td'>".$_SERVER['SERVER_PORT']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>SERVER_SIGNATURE</div><div class='td'>".$_SERVER['SERVER_SIGNATURE']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>SCRIPT_NAME</div><div class='td'>".$_SERVER['SCRIPT_NAME']."</div></div>";
echo "<div class='tr'>";
echo "<div class='td'>REQUEST_URI</div><div class='td'>".$_SERVER['REQUEST_URI']."</div></div>";
echo "</div>";
	 ?>