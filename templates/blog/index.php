<?php 
/** ===============================================================
	* 30/4/2019	require invece di class
===================================================================*/
// prima voce menù
$nav	= new setNav($_SESSION['ambito']);
	$nav->setNav(); 
//require_once("set_nav.php"); 
echo	"<body>";
//-- CONTENUTO DELLA PAGINA ...
echo	"<div class='container-fluid well'>";
include 'layout.php';  
include 'goBack.php';  
echo	"</div>";
echo	"</body>";
echo	"</html>";
?>