<?php
?>

<!DOCTYPE HTML>
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title></title>
  <link rel="stylesheet" href="../css/style.css"  type="text/css" >
  <link rel="stylesheet" href="../css/stili-custom.css"  type="text/css" >
  </head>
  
  <body>
<?php
include_once '../libFB-1.1.1/DB_PDO.php';
include_once '../libFB-1.1.1/FB.field.php';
include_once("../bootstrap_link.php");
<style>
label	{
		width: 160px;
}
</style>
<?php
	echo "<br />";

     echo     "<div class='col-md-6'>";  
     echo  "<fieldset><legend>Campi di input per forms </legend>";
	 
$app = new input(array(0,'input','','Radio button','Campo di tipo Radio button SI-NO','sn'));
	$input = $app->field();
$app = new input(array('input','input','','Input','Campo di tipo input text','i'));
	$input = $app->field();	
$app = new input(array('faubre','input','','Password','Campo di tipo password','pw'));
	$input = $app->field();	
$app = new input(array('01-04-2019','input','','Calendario','Campo di tipo calendario per gestire le date','d1'));
	$input = $app->field();	
     echo  "</fieldset>"; 
     echo "</div>";   // col	

?>