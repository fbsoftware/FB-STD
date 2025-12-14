<?php
$conn = new PDO("mysql:host=localhost;dbname=my_database;charset=utf8", "root", "");
console.log("preview-widget-POST".var_dump($_POST));
$lid = intval($_POST['lid']);

$stmt = $conn->prepare("SELECT linclude FROM prefix_lay WHERE lid=?");
$stmt->execute([$lid]);

$file = $stmt->fetchColumn();

$files = array_map('basename', glob(__DIR__ . "/widgets/*.php"));

if (!in_array($file, $files)) {
    echo "Anteprima non disponibile";
    exit;
}

ob_start();
include __DIR__ . "/widgets/$file";
echo ob_get_clean();
