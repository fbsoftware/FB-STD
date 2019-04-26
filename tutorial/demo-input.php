<?php
require_once('../loadLibraries.php');
require_once('../loadTemplateAdmin.php');
require_once("../connectDB.php");
// DOCTYPE & head
$app = new Head('Gestione menu');
$app->openHead();
require_once("../jquery_link.php");
require_once("../bootstrap_link.php");
require_once("../include_head.php");
require_once('../lingua.php'); 
$app->closeHead();
	  ?>
<style>
label	{
		width: 160px;
}
</style>
<?php
    echo     "<div class='row container well'>";
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
	 echo "</div>";   // container	

?>