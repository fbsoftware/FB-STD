<?php
class DatabaseManager {
    private $pdo;
    private $table;

    public function __construct($dsn, $username, $password, $table) {
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->table = $table;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function renderInputField($name, $type = 'text', $value = '') {
        echo "<input type='$type' name='$name' value='$value'>";
    }

    public function insertData($data) {
        $fields = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $query = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
        $stmt = $this->pdo->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        if ($stmt->execute()) {
            echo "Dati inseriti correttamente.";
        } else {
            echo "Errore nell'inserimento dei dati.";
        }
    }

    public function updateData($data, $idField, $idValue) {
        $fields = "";
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");
        $query = "UPDATE {$this->table} SET $fields WHERE $idField = :id";
        $stmt = $this->pdo->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(":id", $idValue);

        if ($stmt->execute()) {
            echo "Dati aggiornati correttamente.";
        } else {
            echo "Errore nell'aggiornamento dei dati.";
        }
    }

    public function deleteData($idField, $idValue) {
        $query = "DELETE FROM {$this->table} WHERE $idField = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $idValue);

        if ($stmt->execute()) {
            echo "Dati cancellati correttamente.";
        } else {
            echo "Errore nella cancellazione dei dati.";
        }
    }
}

// Esempio di utilizzo
$dbManager = new DatabaseManager(
    'mysql:host=localhost;dbname=my_database', // DSN
    'root', // Username
    '', // Password
    'prefix_cap', // Nome tabella
);
?>

<!-- Nel file HTML -->
<form method="post">
    <?php $dbManager->renderInputField('ccod'); ?>
    <?php $dbManager->renderInputField('cdesc'); ?>
    <input type="submit" name="azione" value="Inserisci">
    <input type="submit" name="azione" value="Modifica">
    <input type="submit" name="azione" value="Cancella">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'ccod' => $_POST['ccod'],
        'cdesc' => $_POST['cdesc']
    ];
    $azione = $_POST['azione'];

    switch ($azione) {
        case 'Inserisci':
            $dbManager->insertData($data);
            break;
        case 'Modifica':
            $idValue = 1; // Sostituisci con l'ID corretto
            $dbManager->updateData($data, 'ccod', $idValue);
            break;
        case 'Cancella':
            $idValue = 1; // Sostituisci con l'ID corretto
            $dbManager->deleteData('ccod', $idValue);
            break;
    }
}
?>