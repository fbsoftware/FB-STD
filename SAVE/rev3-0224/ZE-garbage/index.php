<?php
// utile in sviluppo per vedere gli errori
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$tema  = $_GET['tema'] ?? 'default';
$page  = $_GET['page'] ?? 'default';
echo "Tema: $tema, Page: $page";//debug
?>
<!DOCTYPE html>
<html>
<body>
<div id="canvas"></div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script>
window.TEMA="<?= $tema ?>";
window.PAGE="<?= $page ?>";
</script>

<script src="editor.js"></script>
<script src="viewer.js"></script>


</body>
</html>