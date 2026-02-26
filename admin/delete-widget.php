<?php
// delete-widget.php (versione robusta)
// Riceve POST { lid } e ritorna "OK" in caso di successo, altrimenti un messaggio di errore.

session_start();
require_once('init_admin.php');
// non mostrare errori nell'output, loggarli invece
ini_set('display_errors', 0);
error_reporting(E_ALL);
ob_start();

header('Content-Type: text/plain; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Method not allowed';
    exit;
}

$lid = isset($_POST['lid']) ? intval($_POST['lid']) : 0;
if ($lid <= 0) {
    http_response_code(400);
    echo 'Parametro lid mancante o non valido';
    exit;
}

// recupera prefisso tabella se disponibile (fallback = '')
$pref = '';
if (class_exists('DB') && isset(DB::$pref)) {
    $pref = DB::$pref;
}

// DB connection - adattare se usi init_admin.php
$host = 'localhost';
$db   = 'my_database';
$user = 'root';
$pass = '';
$charset = 'utf8';

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    echo "TABELLA-LAY=".$table = $pref . 'lay';//DEBUG

    // Opzionale: verifica che il record esista prima di cancellare
    $stmt = $pdo->prepare("SELECT * FROM `$table` WHERE lid = ?");
    $stmt->execute([$lid]);
    $row = $stmt->fetch();
    if (!$row) {
        http_response_code(404);
        echo 'Record non trovato';
        exit;
    }

    // Esegui la cancellazione (se hai vincoli o logiche particolari, adattare qui)
    $del = $pdo->prepare("DELETE FROM `$table` WHERE lid = ?");
    $del->execute([$lid]);

    // Controlla che sia stato rimosso
    if ($del->rowCount() > 0) {
        if (ob_get_length() !== false) ob_clean();
        echo 'OK';
        exit;
    } else {
        http_response_code(500);
        echo 'Nessuna riga rimossa';
        exit;
    }

} catch (PDOException $e) {
    // log dell'errore sul server
    error_log("delete-widget.php PDO error: " . $e->getMessage());
    if (ob_get_length() !== false) ob_clean();
    http_response_code(500);
    // non esporre dettagli in produzione
    echo 'Errore server';
    exit;
} catch (Exception $ex) {
    error_log("delete-widget.php error: " . $ex->getMessage());
    if (ob_get_length() !== false) ob_clean();
    http_response_code(500);
    echo 'Errore server';
    exit;
}
?>