<?php
$tema = $_GET['tema'] ?? null;
$base = __DIR__ . '/siti';

if (!$tema || !is_dir("$base/$tema")) {
  echo json_encode([]);
  exit;
}

$files = glob("$base/$tema/*.json");

$pages = array_map(function ($file) {
  return basename($file, '.json');
}, $files);

echo json_encode($pages);
