<?php
include_once('errorOn.php');
// Connessione al database
$conn = new PDO("mysql:host=localhost;dbname=my_database;charset=utf8", "root", "");

// Recupera il nome del widget passato dalla richiesta POST
$widget = $_POST['name'] ?? 'default-widget'; // Se non viene passato, usa un valore predefinito

// Ottieni l'ultima posizione (lprog)
$last = $conn->query("SELECT COALESCE(MAX(lprog), 0) + 1 FROM `prefix_lay`")->fetchColumn();

// Inserisci il nuovo widget
$stmt = $conn->prepare("INSERT INTO `".DB::$pref."lay` (linclude, lprog) VALUES (?, ?)");
$stmt->execute([$widget, $last]);

// Recupera l'ID del nuovo widget inserito
$lid = $conn->lastInsertId();

// Prepara la risposta come un array associativo
$response = [
    'lid' => $lid,
    'lstat' => '',
    'ltmp' => '',
    'lpage' => '',
    'lcod' => '',
    'ltipo' => '',
    'ldesc' => ''
];

// Imposta l'intestazione della risposta come JSON
header('Content-Type: application/json');

// Restituisci la risposta in formato JSON
echo json_encode($response);

// Termina lo script
exit;
?>
