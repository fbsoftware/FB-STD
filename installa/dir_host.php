<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title></title>
  <style type="text/css">
  body       {font-family:verdana;}
  table      {border:1;
              border-collapse:collapse;
              font-size:80%;}
  td         {padding: 0 5px;}
  .riga       {font-style:italic;
             /*   font-weight:bolder;  */
                color:blue;}
  </style>
  </head>
  <body>
  
  <?php
/* Connessione al server ftp */
$ftp_host = 'localhost';
$connect = ftp_connect($ftp_host) or die("Si è verificato un errore durante la connessione al server ftp");
/* login al server ftp */
$username = 'root';
$pwd = '';
$login = ftp_login($connect, $username, $pwd) 
  or die("Si è verificao un errore durante l'accesso al server ftp");
rawlist_dump();  
  
function rawlist_dump() {
  global $connect;
  $ftp_rawlist = ftp_rawlist($connect,"/");
  foreach ($ftp_rawlist as $v) {
    $info = array();
    $vinfo = preg_split("/[\s]+/", $v, 9);
    if ($vinfo[0] !== "total") {
      $info['chmod'] = $vinfo[0];
      $info['num'] = $vinfo[1];
      $info['owner'] = $vinfo[2];
      $info['group'] = $vinfo[3];
      $info['size'] = $vinfo[4];
      $info['month'] = $vinfo[5];
      $info['day'] = $vinfo[6];
      $info['time'] = $vinfo[7];
      $info['name'] = $vinfo[8];
      $rawlist[$info['name']] = $info;
    }
  }
  $dir = array();
  $file = array();
  foreach ($rawlist as $k => $v) {
    if ($v['chmod']{0} == "d") {
      $dir[$k] = $v;
    } elseif ($v['chmod']{0} == "-") {
      $file[$k] = $v;
    }
  }
  echo "<table border='1'>
  <tr><th>Files di localhost</th>
    <th>Ampiezza</th>
    <th>Data</th>
  </tr>
  ";
  
  
  foreach ($dir as $dirname => $dirinfo) {
      echo " <tr class='riga'>
      <td>".$dirname."</td>
      <td>&nbsp;</td> 
      <td> ".$dirinfo['day']." ".$dirinfo['month']." ".$dirinfo['time']."</td>
      </tr>";
  }
  foreach ($file as $filename => $fileinfo) {
      echo " <tr>
            <td>".$filename."</td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $fileinfo['size'] . " Byte&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>" . $fileinfo['day'] . " " . $fileinfo['month'] . " " . $fileinfo['time'] . "</td></tr>";
  }
  echo "</table>";
}

?>
  </body>
</html>
