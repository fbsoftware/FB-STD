<?php
console.log("upd-dettagli-POST".var_dump($_POST));

$conn = new PDO("mysql:host=localhost;dbname=my_database;charset=utf8", "root", "");

$lid    = intval($_POST['lid']);
$lstat  = $_POST['lstat'];
$ltmp   = $_POST['ltmp'];
$lpage  = $_POST['lpage'];
$lcod   = $_POST['lcod'];
$ltipo  = $_POST['ltipo'];
$ldesc  = $_POST['ldesc'];

$stmt = $conn->prepare("
    UPDATE `".DB::$pref."lay` SET
        lstat=?, 
        ltmp=?, 
        lpage=?, 
        lcod=?, 
        ltipo=?, 
        ldesc=?
    WHERE lid=?
");
$stmt->execute([$lstat,$ltmp,$lpage,$lcod,$ltipo,$ldesc,$lid]);

echo "OK";
