<?php
require_once('init_admin.php');

// Connessione al database
$conn = new PDO("mysql:host=localhost;dbname=my_database;charset=utf8", "root", "");

// Leggi layout in ordine di posizione
$stmt = $conn->prepare("SELECT * 
                        FROM `".DB::$pref."lay`  
                        WHERE lstat IS NULL OR TRIM(lstat) = ''
                        AND ltmp = ?                                     
                        ORDER BY lprog ASC");                 
        $stmt->execute([$_POST['tema']]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Leggi tutti i widget presenti nella cartella /widgets
$widgetFiles = glob(__DIR__ . "/widgets/*.php");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Mini Builder</h2>
<div class="builder-container">
<div id="widgets-panel">
    <h2>Widget disponibili</h2>
    <?php foreach ($widgetFiles as $file): 
        $name = basename($file);
        $label = ucwords(str_replace(['.php','_'],['',' '], $name));
    ?>
        <div class="add-widget" data-widget="<?= $name ?>">
            + <?= $label ?>
        </div>
    <?php endforeach; ?>
</div>

<!-- Widgets del tema -->
<div id="canvas">
    <h2>Layout attuale del tema <?= $_POST['tema'] ?></h2>

    <ul id="sortable">
        <?php foreach($rows as $r): ?>
            <li class="canvas-item" draggable="true" data-lid="<?= $r['lid'] ?>">
                <?= htmlspecialchars($r['ltipo']) ?>
                <span class="del">✖</span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>


<!-- Dettagli widget -->
<div id="right">
        <h2>Dettagli widget</h2>
  <form id="details-form" method="post">
        
        <input type="hidden" name="lid" id="lid">
        <label>Tipo widget</label>
        <input type="text" name="ltipo" id="ltipo"><br />
        <label>Stato</label>
        <select name="lstat" id="lstat">
            <option value=" ">Attivo</option>
            <option value="A">Annullato</option>
            <option value="S">Sospeso</option>
        </select><br />

        <label>Template</label>
        <input type="text" name="ltmp" id="ltmp"><br />


        <label>Pagina</label>
        <input type="text" name="lpage" id="lpage"><br />


        <label>Codice widget</label>
        <input type="text" name="lcod" id="lcod"><br />





        <label>Descrizione</label>
        <textarea name="ldesc" id="ldesc"></textarea><br />


        <button type="button" id="save-details">SALVA</button>
    </form>

    <h2>Anteprima</h2>
 <!--  <div id="preview-box" style="border:1px solid #ccc;padding:10px;min-height:80px;">
       <?php  
    //    include_once("../widget/promo.php");
       ?>
    </div>   -->
</div>
</div>
<script src="script.js"></script>
</body>
</html>
