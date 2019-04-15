<?php
// pulisce navigatore scelto    
require_once('moduli/path_a.php'); 
	$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
	$PDO = new PDO($con,DB::$user,DB::$pw);
	$PDO->beginTransaction();      
	$sql = "UPDATE ".DB::$pref."nav 
			SET nselect=0 
			WHERE nmenu='".TMP::$ttdesc."' ";     
     $PDO->exec($sql);    
     $PDO->commit(); 
	$con = NULL;

// legge la prima voce se manca 
if($forma=='')    
{
	$sql = "SELECT * FROM `".DB::$pref."nav` 
			ORDER BY `nprog` limit 1";   
	$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
	$PDO = new PDO($con,DB::$user,DB::$pw);
	$PDO->beginTransaction(); 
	foreach($PDO->query($sql) as $row)
	{
     $forma    =$row['nli'];
     $sub      =$row['ndesc'];
     }
}
$con = NULL;

// memorizza navigatore corrispondente		    
		$sql = "UPDATE  ".DB::$pref."nav  
				SET  nselect =1 
				WHERE nli='$forma' and nmenu='".TMP::$ttdesc."' ";
          $con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
          $PDO = new PDO($con,DB::$user,DB::$pw);
          $PDO->beginTransaction(); 
          $PDO->exec($sql);    
	          $PDO->commit(); 
		$con = NULL;

?>