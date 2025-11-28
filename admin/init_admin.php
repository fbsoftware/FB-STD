<?php
// init_admin.php - inizializzazione centrale (modifica i parametri DB)
session_start();
ob_start();

// Impostazioni base PHP
ini_set('default_charset', '<UTF8mb4_unicode_520_ci>');
header('Content-Type: text/html; UTF8mb4_unicode_520_ci');

require_once('../loadLibraries.php');
require_once('loadTemplateAdmin.php');
$app = new Head('Amministratore');
$app->openHead();
require_once("../jquery_linkAdmin.php");
require_once("../include_head.php");
$app->closeHead();
 
// Creazione connessione PDO centrale con utf8mb4
try {
    $dsn = "mysql:host=" . DB::$host . ";dbname=" . DB::$db . ";charset=UTF8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];   
   
       $PDO = new PDO($dsn, DB::$user, DB::$pw, $options);

    // Assicuriamoci che la connessione usi utf8mb4 anche a livello SQL
    $PDO->exec("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'");
  } 
catch (PDOException $e) 
{
    // In produzione non mostrare messaggi sensibili
    error_log("DB connection failed: " . $e->getMessage());
    die("<br>Errore connessione al database.");
}
$PDO->beginTransaction();
?>