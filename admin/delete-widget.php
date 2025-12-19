<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "POST=" print_r($_POST);//debug

$conn = new PDO("mysql:host=localhost;dbname=my_database;charset=utf8", "root", "");
$lid = intval($_POST["lid"]);

echo $conn->query("DELETE FROM `".DB::$pref."lay` WHERE lid=" . $lid");

echo "OK";