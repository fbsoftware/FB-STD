<?php

header('Content-Type: application/json');

// 1️⃣ leggi JSON puro
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!$data) {
  http_response_code(400);
  echo json_encode(['error' => 'JSON non valido']);
  exit;
}

// 2️⃣ recupera meta
$tema  = $data['meta']['tema']  ?? 'default';
$pagina = $data['meta']['page'] ?? 'page';

// 3️⃣ salva
$filename = "siti/{$tema}/{$pagina}.json";

file_put_contents(
  $filename,
  json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

echo json_encode([
  'status' => 'ok',
  'file' => $filename
]);
