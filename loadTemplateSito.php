<?php
$db  = new DB();
$tmp = new TMP('sito');
$tmp->read_tmp() ;		// quì nasce DB::$ROOT
$dbsel = new DB_SEL();
/* uso DB_SEL
$sql = "SELECT * FROM tabella WHERE lstat IS NULL OR TRIM(lstat) = ''";
$rows = DB::select($sql);
foreach ($rows as $row) {
    // mostra a video
}
*/
?>
