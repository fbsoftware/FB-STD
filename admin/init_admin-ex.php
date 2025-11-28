<?php
require_once('../loadLibraries.php');
require_once('loadTemplateAdmin.php');
$app = new Head('Amministratore');
$app->openHead();
require_once("../jquery_linkAdmin.php");
require_once("../include_head.php");
$app->closeHead();
// database
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();
?>
