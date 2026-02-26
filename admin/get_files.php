<?php
if (isset($_POST['cartella'])) {
echo    $folder = '../editor/siti/' . basename($_POST['cartella']); // Percorso cartella padre + scelta utente

    $result = [];

    if (is_dir($folder)) {
        $files = array_diff(scandir($folder), array('.', '..'));
        foreach ($files as $file) {
            if (is_file($folder . '/' . $file)) {
                $result[] = pathinfo($file, PATHINFO_FILENAME); // Nome senza estensione
            }
        }
    }
echo "ESITO-RAGGIUNTO".$result;
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}
?>
