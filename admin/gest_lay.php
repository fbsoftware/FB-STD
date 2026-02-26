<?php  session_start();
/**
    Fausto Bresciani   fbsoftware@libero.it  www.faustobresciani.it
    package		FB open template
    versione 3.1
    copyright	Copyright (C) 2025 - 2026 FB. All rights reserved.
    license		GNU/GPL
    Si concede licenza gratuita e NON si risponde di qualsiasi cosa dovuta
    all'uso anche improprio di FB open template.
    ------------------------------------------------------------------------
     scelta del tema tabella 'lay' layout di pagina.
     15/03/2022	aggiunta, copia nuove include in "write"
============================================================================= */
?>

<style>
  table { border-collapse: collapse; width: 50%; margin-top: 20px; }
  th, td { border: 1px solid #333; padding: 8px; text-align: left; }
</style>

<?php
include_once('init_admin.php');
//include_once('errorOn.php');
// toolbar, scelta del tema
$param  = array('mostra','chiudi');
// $btx   = new bottoni_str_par('Scelta del tema','lay','gest_lay2.php',$param);
$btx   = new bottoni_str_par('Scelta del tema','lay','../editor/editor.php?tema=blog&page=homa',$param);
     $btx->btn();

// memorizza location iniziale
	$_SESSION['location'] = $_SERVER['QUERY_STRING'];

// zona messaggi
$parm = $_SESSION['esito'];
$m = new msg($parm);
$m->msg();
?>
<fieldset>
<!-- mini-builder -->
 <!-- cartelle dei temi(siti) ----------------------------------------------- -->
          <h3>Scelta del tema</h3>
          <div>
               <?php
               $parentFolder = '../editor/siti'; // Inserisci il percorso della cartella padre

               if (is_dir($parentFolder)) {
               $items = array_diff(scandir($parentFolder), array('.', '..'));

               echo '<select id="cartella" name="cartella">';
               foreach ($items as $item) {
                    if (is_dir($parentFolder . '/' . $item)) { // Assicura che sia una cartella
                         echo '<option value="' . htmlspecialchars($item) . '">' . htmlspecialchars($item) . '</option>';
                    }
               }
               echo '</select>';
               } else {
               echo "Cartella padre non trovata.";
               }
               ?>
          </div>
 <!-- widgets ----------------------------------------------- -->
        <h3>Scelta della pagina</h3>
           <table id="fileTable">
    <thead>
        <tr>
            <th>Pagine del tema <?= $item ?></th>
        </tr>
    </thead>
    <tbody>
        <!-- I file verranno inseriti qui -->
    </tbody>
</table>

<?php echo "</form>";?>

</fieldset>
<script>
 
$(document).ready(function() {
    $('#cartella').on('change', function() {
        var folder = $(this).val();
        if (folder === "") {
            $('#fileTable tbody').html(''); // Svuota la tabella se nulla selezionato
            return;
        }
console.log("Lancio ricerca pagine");
        $.ajax({
            url: 'get_files.php',  // Script PHP che legge i file
            type: 'POST',
            data: { cartella: folder },
            dataType: 'json',
            success: function(data) {
                var tbody = '';
                if (data.length > 0) {
                    console.log("DATI:", data);
                    $.each(data, function(i, file) {
                        tbody += '<tr><td>' + file + '</td></tr>';
                    });
                } else {
                    tbody = '<tr><td>Nessun file trovato</td></tr>';
                }
                $('#fileTable tbody').html(tbody);
            },
            error: function() {
                $('#fileTable tbody').html('<tr><td>Errore nella richiesta</td></tr>');
            }
        });
    });
});
</script>

</body>
</html>