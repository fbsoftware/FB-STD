<?php
declare(strict_types=1);
ob_start();
ob_get_clean();
    
    // get-details.php - versione robusta di debug/prod

// Forza sempre JSON e UTF-8
header('Content-Type: application/json; charset=utf-8');

// Se vuoi, disattiva display errors in produzione
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Cattura qualsiasi output accidentale (notice/html) in buffer

try {
    // Log POST per debug (temporaneo)
    error_log('DEBUG $_POST: ' . json_encode($_POST));
echo "LID=".$lid;// Debug temporaneo
    // Leggi lid in modo robusto
    $lid = $_POST['lid'] ?? null;
    if ($lid === null || $lid === '') {
        // svuota buffer e log
        $buf = ob_get_clean();
        if ($buf !== '') error_log("OUTPUT ACCIDENTALE (prima del JSON):\n" . $buf);
        echo json_encode(['error' => 'ID mancante']);
        exit;
    }

    // cast/sanitizzazione base
    $lid = filter_var($lid, FILTER_VALIDATE_INT);
    if ($lid === false) {
        $buf = ob_get_clean();
        if ($buf !== '') error_log("OUTPUT ACCIDENTALE (prima del JSON):\n" . $buf);
        echo json_encode(['error' => 'ID non valido']);
        exit;
    }

    // Connessione PDO (adatta credenziali)
    $conn = new PDO(
        "mysql:host=localhost;dbname=my_database;charset=utf8mb4",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    /* // Se DB::$pref non esiste, definisci fallback (evita fatal se DB non definita)
    $pref = '';
    if (class_exists('DB') && defined('DB::$pref')) {
        // se possegui la classe DB e la costante
        $pref = DB::$pref;
    } elseif (defined('DB_PREF')) {
        $pref = DB_PREF;
    } else {
        // se non hai un pref, lascia vuoto o imposta manualmente:
        $pref = ''; // oppure 'myprefix_'
    }
*/
    // Prepara query (usa nome tabella reale se pref non necessario)
    $table = 'prefix_lay';
    $sql = "SELECT lid, lstat, ltmp, lpage, lcod, ltipo, ldesc, linclude
            FROM `" . $table . "`
            WHERE lid = ? AND lstat <> 'A'
            LIMIT 1";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$lid]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Pulizia del buffer di eventuali warning non voluti
    $buf = ob_get_clean();
    if ($buf !== '') {
        error_log("OUTPUT ACCIDENTALE (prima del JSON):\n" . $buf);
    }

    // Se non è stato trovato nulla, torna oggetto vuoto (compatibile con JS)
    if (!$result) {
        echo json_encode(new stdClass());
    } else {
        // Normalizza eventuali valori null in stringhe vuote o lascia così
        echo json_encode($result);
    }

}  catch (Throwable $e) {
    // log sul server
    error_log('Errore in get-details.php: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
    http_response_code(500);
    // ATTENZIONE: mostrare $e->getMessage() al client è solo per debug locale!
    if (isset($_GET['debug']) && $_GET['debug'] === '1') {
        echo json_encode(['error' => 'server_error', 'message' => $e->getMessage()]);
    } else {
        echo json_encode(['error' => 'server_error']);
    }
}
exit;