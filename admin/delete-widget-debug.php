<?php
// delete-widget-debug.php - versione di debug (restituisce l'errore completo)
// USARE SOLO IN SVILUPPO

session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
ob_start();

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

$lid = isset($_POST['lid']) ? intval($_POST['lid']) : 0;
if ($lid <= 0) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Parametro lid mancante o non valido']);
    exit;
}

// include init se lo usi (contiene DB::$pref e/o $pdo)
if (file_exists(__DIR__ . '/init_admin.php')) {
    require_once __DIR__ . '/init_admin.php';
}

// Se init_admin.php ha creato $pdo, usalo, altrimenti creane uno
if (isset($pdo) && $pdo instanceof PDO) {
    $db = $pdo;
} else {
    $host = 'localhost';
    $dbname = 'my_database';
    $user = 'root';
    $pass = '';
    $charset = 'utf8';
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}

// pref tabella
$pref = '';
if (class_exists('DB') && isset(DB::$pref)) $pref = DB::$pref;
$table = $pref . 'lay';

try {
    $stmt = $db->prepare("SELECT * FROM `$table` WHERE lid = ?");
    $stmt->execute([$lid]);
    $row = $stmt->fetch();
    if (!$row) {
        http_response_code(404);
        echo json_encode(['ok' => false, 'error' => 'Record non trovato']);
        exit;
    }

    $del = $db->prepare("DELETE FROM `$table` WHERE lid = ?");
    $del->execute([$lid]);

    if ($del->rowCount() > 0) {
        if (ob_get_length() !== false) ob_clean();
        echo json_encode(['ok' => true, 'msg' => 'OK', 'lid' => $lid]);
        exit;
    } else {
        http_response_code(500);
        echo json_encode(['ok' => false, 'error' => 'Nessuna riga rimossa']);
        exit;
    }

} catch (PDOException $e) {
    // Ritorna il messaggio d'errore PDO per debug
    if (ob_get_length() !== false) ob_clean();
    http_response_code(500);
    echo json_encode([
        'ok' => false,
        'error' => 'PDOException',
        'message' => $e->getMessage(),
        'code' => $e->getCode()
    ]);
    exit;
} catch (Exception $ex) {
    if (ob_get_length() !== false) ob_clean();
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => $ex->getMessage()]);
    exit;
}
?>