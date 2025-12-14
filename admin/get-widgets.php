<?php
$conn = new PDO("mysql:host=localhost;dbname=my_database;charset=utf8", "root", "");

$widget = $_POST["name"];

// ultima posizione
$last = $conn->query("SELECT COALESCE(MAX(lprog),0)+DB::$incr FROM `".DB::$pref."lay`")->fetchColumn();
dbg($last,false); 
// inserisci nuovo widget
$stmt = $conn->prepare("INSERT INTO `".DB::$pref."lay` (linclude, lprog) VALUES (?,?)");
$stmt->execute([$widget, $last]);

echo "OK";
