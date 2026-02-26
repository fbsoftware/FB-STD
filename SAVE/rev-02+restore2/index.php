<?php

require 'renderer/Renderer.php';

$tema   = $_GET['tema']   ?? 'sito';
$pagina = $_GET['pagina'] ?? 'home';

// 🔹 recupero layout da DB
$layoutJson = getLayoutFromDB($tema, $pagina);
$layout = json_decode($layoutJson, true);

// 🔹 render
$renderer = new Renderer($tema);
$html = $renderer->render($layout);

// 🔹 output
echo $html;
