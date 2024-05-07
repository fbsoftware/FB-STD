<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php  
 //echo "<h1>CACCA  sito</h1>";
 require_once('init_site.php');
 echo "<body>";
 require_once 'request.php';
 $nav	= new setNav(TMP::$ambiente);
 $nav->setNav(); 
 echo	"<a name='inizio'></a>";
 require 'layout.php';
 echo "</body>"; 
echo "</html>";   
ob_end_flush();  
 ?>