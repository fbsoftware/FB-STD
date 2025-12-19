<?php
header('Content-Type: application/json');

try {
    $conn = new PDO("mysql:host=localhost;dbname=my_database;charset=utf8", "root", "");

    $lid = intval($_POST['lid']);

    $stmt = $conn->prepare("SELECT lid, lstat, ltmp, lpage, lcod, ltipo, ldesc, linclude
                            FROM `".DB::$pref."lay`
                            WHERE lid=? AND lstat <> 'A'");
    $stmt->execute([$lid]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Se non trovi niente, restituisci un oggetto vuoto
    if (!$result) {
        $result = new stdClass();  // {} in JSON
    }
print_r($result);//debug    
    echo json_encode($result);

} catch (Exception $e) {
    // Restituisci errore in JSON
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
?>
