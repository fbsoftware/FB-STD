<?php
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!$data) {
  http_response_code(400);
  echo json_encode(['error' => 'JSON non valido']);
  exit;
}

// ===== SANITIZE PARAMS =====
$tema = $data['meta']['tema'] ?? 'default';
$page = $data['meta']['page'] ?? 'home';

// sicurezza base (no ../)
$tema = preg_replace('/[^a-z0-9_-]/i', '', $tema);
$page = preg_replace('/[^a-z0-9_-]/i', '', $page);

// ===== PATH DINAMICO =====
$baseDir = __DIR__ . "/siti/$tema";
if (!is_dir($baseDir)) {
  mkdir($baseDir, 0775, true);
}

$file = "$baseDir/$page.json";

// ===== SAVE =====
file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

echo json_encode([
  'status' => 'ok',
  'file' => $file
]);
