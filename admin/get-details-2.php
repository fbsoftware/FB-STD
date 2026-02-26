<?php
header('Content-Type: application/json; charset=utf-8');
//require_once('init_admin.php');
require_once('errorOn.php');//debug
try {
    $lid = $_POST['lid'] ?? null;
    $lid = 100; //debug
    if (!$lid) {
        echo json_encode(['error' => 'ID mancante']);
        exit;
    }

    $conn = new PDO(
        "mysql:host=localhost;dbname=my_database;charset=utf8",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $stmt = $conn->prepare("
        SELECT lid, lstat, ltmp, lpage, lcod, ltipo, ldesc, linclude
        FROM `".DB::$pref."lay`
        WHERE lid = ? AND lstat <> 'A'
    ");

    $stmt->execute([$lid]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result ?: new stdClass());

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
exit;

?>
