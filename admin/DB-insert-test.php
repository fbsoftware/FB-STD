<!DOCTYPE html>
<html lang="it">
<head>

<meta charset="UTF-8">
<title>Insert Automatico</title>
</head>
<body>

<h1>Inserimento automatico nella tabella: <?= $tabella ?></h1>

<form method="post">

<?php foreach ($colonne as $c): ?>
    <?= ucfirst($c) ?>:<br>
    <input type="text" name="<?= $c ?>" required><br><br>
<?php endforeach; ?>

<button type="submit">Salva</button>

</form>

</body>
</html>
