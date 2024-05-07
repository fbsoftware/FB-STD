<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php  
 echo "<h1>CACCA  sito</h1>";
 require_once('init_site.php');
// tema
echo "<body>";
// parametri passati con l'url e memorizzati 
require_once 'request.php';		
//var_dump($_SESSION);//debug

//  index del template   
require_once(TMP::$tfolder.'index.php'); 
 ?>
 </body>
</html>