<?php
require_once('loadLibraries.php');
require_once('loadTemplateSito.php');
$app = new Head('Sito MonoPage');
$app->openHead();
require_once("jquery_link.php");
require_once("include_head.php");
$app->closeHead();
// database
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();
?>
