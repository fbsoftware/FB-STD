<?php
/**
==================================================
    Mini Elementor - Dati del widget (by type)
==================================================
 */
// require_once '../admin/errorOn.php';
require_once 'init_min.php';

$tema = $_GET['tema'] ?? '';
$type = $_GET['type'] ?? '';

if (!$type) {
    echo json_encode([]);
    exit;
}


// mappa dei tipi di widget alle rispettive tabelle del database
$widgetTables = [
    'slide'     => DB::$pref . 'sld',
    'promo'     => DB::$pref . 'prm',
    'article'   => DB::$pref . 'art',
    'artimg'    => DB::$pref . 'aim',
    'arttab'    => DB::$pref . 'asl',
    'artacc'    => DB::$pref . 'asl',
    'artcol'    => DB::$pref . 'arc',
    'glyph'     => DB::$pref . 'gly',
    'footer'    => DB::$pref . 'foo',
    'izoom'     => DB::$pref . 'zim',
    'portfolio' => DB::$pref . 'por'
    ];

$widgetIniz = [
    'slide'     => 'sl',
    'promo'     => 'o',
    'article'   => 'a',
    'artimg'    => 'i',
    'arttab'    => 'd',
    'artacc'    => 'd',
    'artcol'    => 'h',
    'glyph'     => 'g',
    'footer'    => 'f',
    'izoom'     => 'z',
    'portfolio' => 'p'
    ]; 

$table = $widgetTables[$type];
$inizio = $widgetIniz[$type];

if (!isset($widgetTables[$type], $widgetIniz[$type])) {
    echo json_encode([]);
    exit;
}

  $sql = "
    SELECT {$inizio}cod, {$inizio}des
    FROM {$table}
    WHERE {$inizio}stat IS NULL OR {$inizio}stat <> 'A'   
    ORDER BY {$inizio}des
    ";

$stmt = $PDO->prepare($sql);
$stmt->execute();

//echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode($rows);

//var_dump($rows);//* per debug */