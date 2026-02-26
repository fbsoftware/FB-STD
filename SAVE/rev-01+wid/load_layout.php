<?php
/**
==================================================
    Mini Elementor - Load Layout
==================================================
 */
//require_once '../admin/errorOn.php';
require_once 'init_min.php';

$tema = $_GET['tema'] ?? '';
$page = $_GET['page'] ?? null;

$sql = "
    SELECT lid, lprog, ltipo, lcod, ldesc
    FROM ".DB::$pref."lay
    WHERE ltmp = ?
";

$params = [$tema];

if ($page) {
    $sql .= " AND lpage = ?";
    $params[] = $page;
}

$sql .= " ORDER BY lprog ASC";

$stmt = $PDO->prepare($sql);
$stmt->execute($params);

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($rows);
