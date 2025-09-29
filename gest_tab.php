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

    public function fetchAll() {
        $query = "SELECT * FROM {$this->table}";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function renderInputField($name, $type = 'text', $value = '') {
        echo "<label for='$name'>$name</label>";
        echo "<input type='$type' name='$name' value='$value'>";
        echo "<br>";
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
            echo "Dati inseriti correttamente.<br>";
        } else {
            echo "Errore nell'inserimento dei dati.<br>";
        }
    }

    public function getData($idField, $idValue) {
        $query = "SELECT * FROM {$this->table} WHERE $idField = :cid";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":cid", $idValue);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateData($data, $idField, $idValue) {
        $fields = "";
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");
        $query = "UPDATE {$this->table} SET $fields WHERE $idField = :cid";
        $stmt = $this->pdo->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(":cid", $cidValue);

        if ($stmt->execute()) {
            echo "Dati aggiornati correttamente.<br>";
        } else {
            echo "Errore nell'aggiornamento dei dati.<br>";
        }
    }

    public function deleteData($idField, $idValue) {
        $query = "DELETE FROM {$this->table} WHERE $idField = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":cid", $idValue);

        if ($stmt->execute()) {
            echo "Dati cancellati correttamente.<br>";
        } else {
            echo "Errore nella cancellazione dei dati.<br>";
        }
    }

    public function renderTable() {
        $data = $this->fetchAll();
        if (count($data) > 0) {
            echo "<table border='1'>";
            echo "<tr>";
            foreach ($data[0] as $key => $value) {
                echo "<th>$key</th>";
            }
            echo "<th>Actions</th>";
            echo "</tr>";
            foreach ($data as $row) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "<td>";
                echo "<form style='display:inline;' method='post'>";
                echo "<input type='hidden' name='cid' value='{$row['cid']}'>";
                echo "<input type='submit' name='azione' value='Modifica'>";
                echo "<input type='submit' name='azione' value='Cancella'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Nessun dato disponibile.<br>";
        }
    }
}

// Esempio di utilizzo
$dbManager = new DatabaseManager(
 /*   'mysql:host=localhost;dbname=tuo_database', // DSN
    'tuo_utente', // Username
    'tua_password', // Password
    'tuo_tabella' // Nome tabella*/
    'mysql:host=localhost;dbname=my_database', // DSN
    'root', // Username
    '', // Password
    'prefix_cap', // Nome tabella
);

// Gestione delle azioni del form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $azione = $_POST['azione'];
    $idValue = isset($_POST['cid']) ? $_POST['cid'] : null;

    if ($azione == 'Inserisci') {
        $data = [
            'ccod' => $_POST['ccod'],
            'cdesc' => $_POST['cdesc']
        ];
        $dbManager->insertData($data);
    } elseif ($azione == 'Modifica' && $idValue) {
        $data = [
            'ccod' => $_POST['ccod'],
            'cdesc' => $_POST['cdesc']
        ];
        $dbManager->updateData($data, 'cid', $idValue);
    } elseif ($azione == 'Cancella' && $idValue) {
        $dbManager->deleteData('cid', $idValue);
    }
}
?>

<!-- Visualizzazione della tabella e del form HTML -->
<!DOCTYPE html>
<html>
<head>
    <title>Gestione Tabella</title>
</head>
<body>

<h2>Gestione Tabella</h2>

<?php $dbManager->renderTable(); ?>

<h2>Aggiungi/Modifica Record</h2>
<form method="post">
    <?php
    if (isset($_POST['azione']) && $_POST['azione'] == 'Modifica' && isset($_POST['cid'])) {
        $idValue = $_POST['cid'];
        $data = $dbManager->getData('cid', $idValue);
        foreach ($data as $key => $value) {
            if ($key != 'cid') {
                $dbManager->renderInputField($key, 'text', $value);
            }
        }
        echo "<input type='hidden' name='cid' value='$idValue'>";
    } else {
        // Render empty fields for new data
        $dbManager->renderInputField('ccod');
        $dbManager->renderInputField('cdesc');
    }
    ?>
    <input type="submit" name="azione" value="Inserisci">
</form>

</body>
</html>