<?php
require_once("loadLibraries.php");
require_once("loadTemplateAdmin.php");
require_once("libFB_1_2_0/DB_tip_i.php");
$st	= new DB_tip_i('stato','xcod',' ','Stato','Tooltip');
	$st->select();
?>