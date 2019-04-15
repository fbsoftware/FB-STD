<?php
//   bottoni gestione
$param = array('ritorno');
$btx   = new bottoni_str_par('Dati del server','config','index.php?urla=widget.php&pag=',$param);     
     $btx->btn();
// zona messaggi
include_once 'msg.php';     
?>
<div class="center">
<br>
<table cellpadding="0" cellspacing="0" >
<tbody>
<tr><th>Variabile</th><th>Valore</th></tr>
<tr><td class="fc">FILE</td>                 <td><?php echo $_SERVER['PHP_SELF']?></td></tr>
<tr><td class="fc">PHP_SELF</td>             <td><?php echo $_SERVER['PHP_SELF']?></td></tr>
<tr><td class="fc">GATEWAY_INTERFACE</td>    <td><?php echo $_SERVER['GATEWAY_INTERFACE']?></td></tr>
<tr><td class="fc">SERVER_ADDR</td>          <td><?php echo $_SERVER['SERVER_ADDR']?></td></tr>
<tr><td class="fc">SERVER_NAME</td>          <td><?php echo $_SERVER['SERVER_NAME']?></td></tr> 
<tr><td class="fc">SERVER_SOFTWARE</td>      <td><?php echo $_SERVER['SERVER_SOFTWARE']?></td></tr>
<tr><td class="fc">SERVER_PROTOCOL</td>      <td><?php echo $_SERVER['SERVER_PROTOCOL']?></td></tr>
<tr><td class="fc">REQUEST_TIME</td>         <td><?php echo $_SERVER['REQUEST_TIME']?></td></tr>
<tr><td class="fc">QUERY_STRING</td>         <td><?php echo $_SERVER['QUERY_STRING']?></td></tr>
<tr><td class="fc">DOCUMENT_ROOT</td>        <td><?php echo $_SERVER['DOCUMENT_ROOT']?></td></tr> 
<tr><td class="fc">HTTP_ACCEPT</td>          <td><?php echo $_SERVER['HTTP_ACCEPT']?></td></tr>
<tr><td class="fc">HTTP_ACCEPT_ENCODING</td> <td><?php echo $_SERVER['HTTP_ACCEPT_ENCODING']?></td></tr>
<tr><td class="fc">HTTP_ACCEPT_LANGUAGE</td> <td><?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE']?></td></tr>
<tr><td class="fc">HTTP_CONNECTION</td>      <td><?php echo $_SERVER['HTTP_CONNECTION']?></td></tr>
<tr><td class="fc">HTTP_HOST</td>            <td><?php echo $_SERVER['HTTP_HOST']?></td></tr> 
<tr><td class="fc">REMOTE_ADDR</td>          <td><?php echo $_SERVER['REMOTE_ADDR']?></td></tr>
<tr><td class="fc">HTTP_USER_AGENT</td>      <td><?php echo $_SERVER['HTTP_USER_AGENT']?></td></tr>
<tr><td class="fc">SCRIPT_FILENAME</td>      <td><?php echo $_SERVER['SCRIPT_FILENAME']?></td></tr>
<tr><td class="fc">SERVER_ADMIN</td>         <td><?php echo $_SERVER['SERVER_ADMIN']?></td></tr> 
<tr><td class="fc">SERVER_PORT</td>          <td><?php echo $_SERVER['SERVER_PORT']?></td></tr>
<tr><td class="fc">SERVER_SIGNATURE</td>     <td><?php echo $_SERVER['SERVER_SIGNATURE']?></td></tr>
<tr><td class="fc">SCRIPT_NAME</td>          <td><?php echo $_SERVER['SCRIPT_NAME']?></td></tr>
<tr><td class="fc">REQUEST_URI</td>          <td><?php echo $_SERVER['REQUEST_URI']?></td></tr>
</table></tbody>