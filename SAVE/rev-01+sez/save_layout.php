<?php
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!$data) {
  http_response_code(400);
  echo json_encode(['error' => 'JSON non valido']);
  exit;
}

// qui puoi:
// - salvare in DB (json column)
// - salvare file
// - versionare

file_put_contents(
  'siti/blog/home.json',
  json_encode($data, JSON_PRETTY_PRINT)
);

echo json_encode(['status' => 'ok']);