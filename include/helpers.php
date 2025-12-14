<?php
// Per vedere i valori direttamente nella console del browser, anche array e oggetti:
function console_log($data) {
    echo '<script>console.log('.json_encode($data, JSON_PRETTY_PRINT).');</script>';
}
// Uso:
// console_log($_POST);       // vedi tutti i dati del POST
// console_log($rows);        // vedi l’array risultato della query
// console_log("TEMA=".$tema); // stringhe semplici
//----------------------------------------------------------------------------------
// Per stampare a video debug rapido in modo elegante:
function dbg($data, $exit=false) {
    echo '<pre>'; 
    print_r($data); 
    echo '</pre>';
    if($exit) exit;
}
// Uso:
// dbg($rows);        // stampa l’array in modo leggibile
// dbg($_POST, true); // stampa e blocca l’esecuzione
//----------------------------------------------------------------------------------
// Per leggere un campo POST in modo sicuro, senza errori “undefined index”:
function safe_post($key, $default='') {
    return $_POST[$key] ?? $default;
}
// Uso:
// $tema = safe_post('tema');
//----------------------------------------------------------------------------------
// Per rendere le query PDO più brevi e sicure, puoi usare:
function pdo_fetch_all($conn, $sql, $params=[]) {
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Uso:
// $sql = "SELECT * FROM `".DB::$pref."lay` WHERE TRIM(lstat)='' AND ltmp=?";
// $rows = pdo_fetch_all($conn, $sql, [$tema]);


 ?>