<?php
/**
==================================================
    Mini Elementor - Load Layout
==================================================
 */
//require_once '../admin/errorOn.php';
//require_once 'init_min.php';
error_reporting(0);
ini_set('display_errors', 0);

$tema = $_GET['tema'] ?? null;
$page = $_GET['page'] ?? null;

if (!$tema || !$page) {
  echo json_encode(['error'=>'parametri mancanti']);
  exit;
}

$file = __DIR__ . "/siti/$tema/$page.json";

if (!file_exists($file)) {
  echo json_encode(['empty'=>true]);
  exit;
}
header('Content-Type: application/json');
echo file_get_contents($file);

/*
$X = file_get_contents($file);
echo"<br>SX=".$X;*/
exit;
