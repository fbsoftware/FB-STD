<?php 
require_once('../loadLibraries.php');
require_once('../loadTemplateSito.php');
// database
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();
?>