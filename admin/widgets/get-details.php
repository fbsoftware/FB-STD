<?php
$conn = new PDO("mysql:host=localhost;dbname=my_database;charset=utf8", "root", "");

$lid = intval($_GET['lid']);

$stmt = $conn->prepare("
    SELECT lid, lstat, ltmp, lpage, lcod, ltipo, ldesc, linclude
    FROM prefix_lay
    WHERE lid=?
");
$stmt->execute([$lid]);

echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
