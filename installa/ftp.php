<!DOCTYPE HTML>
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title></title>
  </head>
  <body>
<?php
/* Connessione al server ftp */
$ftp_host = 'localhost';
$connect = ftp_connect($ftp_host) or die("Si è verificato un errore durante la connessione al server ftp");
/* login al server ftp */
$username = 'fbsoftware';
$pwd = 'faubre';
$login = ftp_login($connect, $username, $pwd) 
  or die("Si è verificao un errore durante l'accesso al server ftp");
/* chiusura connessione al server ftp */
echo  "Connessione attiva";
// operazioni sul server
$file = "/config.css";
$size = ftp_size($connect, $file);
echo  "<br />L'ampiezza di ".$file."= : ".$size;
$file = "/config.css";
$date = ftp_mdtm($connect, $file);
if ($date == -1) echo "<br />Nessuna modifica per ".$file ;
 else echo  "<br />Ultima modifica di ".$file."= : ".$date."<br >";
 

?>

  </body>
</html>
