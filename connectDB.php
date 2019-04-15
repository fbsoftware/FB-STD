<?php
$app = new DB();
try 
	{
	 $PDO = new PDO("mysql:host=".DB::$host.";dbname=".DB::$db."",DB::$user,DB::$pw);
    } 
catch(PDOException $e) 
	{ 
	 echo $e->getMessage();  
	}
$PDO->beginTransaction();
?>
