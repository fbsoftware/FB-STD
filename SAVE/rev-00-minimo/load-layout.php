<?php
error_reporting(0);
ini_set('display_errors', 0);

$tema = $_GET['tema'] ?? null;
$page = $_GET['page'] ?? null;

$file = __DIR__ . "siti/$tema/$page.json";

if (!file_exists($file)) {
  http_response_code(404);
  echo json_encode(['error' => 'Layout non trovato']);
  exit;
}

echo file_get_contents($file);