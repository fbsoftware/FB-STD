<?php
$conn = new PDO("mysql:host=localhost;dbname=my_database;charset=utf8", "root", "");
$data = json_decode(file_get_contents("php://input"), true);

foreach ($data as $row) {
    $stmt = $conn->prepare("UPDATE prefix_lay SET lprog=? WHERE lid=?");
    $stmt->execute([$row['lprog'], $row['lid']]);
}

echo "OK";
