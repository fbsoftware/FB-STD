<?php
// add-widget.php (versione robusta)
// Riceve POST { widget, tema } e ritorna l'HTML del <li class="canvas-item" data-lid="...">...</li>

session_start();
require_once('init_admin.php');
// disattiva output di errori in risposta (loggare su file se serve)
ini_set('display_errors', 0);
error_reporting(E_ALL);

// usa buffering per evitare output accidentale
ob_start();

header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo 'Method not allowed';
    exit;
}

$widget = isset($_POST['widget']) ? trim($_POST['widget']) : '';
$tema   = isset($_POST['tema']) ? trim($_POST['tema']) : '';

if ($widget === '' || $tema === '') {
    http_response_code(400);
    echo 'Missing parameters';
    exit;
}

// Normalizza il nome del file (solo basename)
$widgetFile = basename($widget);

// Verifica che il file esista nella cartella widgets
$widgetsDir = __DIR__ . '/widgets/';
if (!file_exists($widgetsDir . $widgetFile)) {
    http_response_code(400);
    echo 'Widget non trovato';
    exit;
}

// Determina il tipo di widget (senza .php)
$ltipo = preg_replace('/\.php$/i', '', $widgetFile);

// Recupera prefisso tabella se disponibile (fallback = '')
$pref = '';
if (class_exists('DB') && isset(DB::$pref)) {
    $pref = DB::$pref;
}
// Se usi una costante diversa, adattare qui:
// elseif (defined('DB_PREF')) $pref = DB_PREF;

try {
    // connessione DB - adattare parametri se usi init_admin.php
    $host = 'localhost';
    $db   = 'my_database';
    $user = 'root';
    $pass = '';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $table = $pref . 'lay';

    // Calcola la posizione successiva (lprog)
    $stmt = $pdo->prepare("SELECT COALESCE(MAX(lprog), 0) AS mx FROM `$table` WHERE ltmp = ?");
    $stmt->execute([$tema]);
    $row = $stmt->fetch();
    $nextProg = ($row && isset($row['mx'])) ? intval($row['mx']) + 1 : 1;

    // Inserisci il nuovo record (adatta i nomi dei campi se diversi)
    $insert = $pdo->prepare("INSERT INTO `$table` (ltipo, lcod, ldesc, ltmp, lprog, lstat, lpage) VALUES (?, '', '', ?, ?, '', '')");
    $insert->execute([$ltipo, $tema, $nextProg]);

    $lid = $pdo->lastInsertId();

    if (!$lid) {
        throw new Exception('Insert failed');
    }

    // Pulisce eventuale output precedente (warning ecc.)
    if (ob_get_length() !== false) {
        ob_clean();
    }

    // Ritorna l'HTML del <li> (solo questo)
    $ltipo_html = htmlspecialchars($ltipo, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    $li = '<li class="canvas-item" draggable="true" data-lid="' . $lid . '">' . $ltipo_html . ' <span class="del">✖</span></li>';

    echo $li;
    exit;

} catch (Exception $e) {
    // cattura errori ma non stampare stacktrace in risposta (solo per debug locale si può abilitare)
    if (ob_get_length() !== false) ob_clean();
    http_response_code(500);
    echo 'Errore server';
    // puoi loggare l'eccezione su file:
    error_log("add-widget.php error: " . $e->getMessage());
    exit;
}
?>