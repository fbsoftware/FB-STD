<?php
$db  = new DB();
$tmp = new TMP('sito');
$tmp->read_tmp() ;		// quì nasce DB::$ROOT
require_once("connectDB.php");
?> 