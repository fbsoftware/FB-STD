<?php
class ComboBox {
    private $pdo;
    private $table;
    private $idField;
    private $displayField;

    public function __construct($dsn, $username, $password, $table, $idField, $displayField) {
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->table = $table;
            $this->idField = $idField;
            $this->displayField = $displayField;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getOptions() {
        $query = "SELECT {$this->idField}, {$this->displayField} FROM {$this->table}";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function renderComboBox($name) {
        $options = $this->getOptions();
        echo "<select name='$name'>";
        foreach ($options as $option) {
            echo "<option value='{$option[$this->idField]}'>{$option[$this->displayField]}</option>";
        }
        echo "</select>";
    }

    public function getSelectedValue($name) {
        return isset($_POST[$name]) ? $_POST[$name] : null;
    }
}
// Esempio di utilizzo
$comboBox = new ComboBox(
    'mysql:host=localhost;dbname=my_database', // DSN
    'root', // Username
    '', // Password
    'prefix_cap', // Nome tabella
    'ccod', // Campo ID
    'cdesc' // Campo da visualizzare
);
?>

<!-- Nel file HTML -->
<form method="post">
    <?php $comboBox->renderComboBox('mycombo'); ?>
    <input type="submit" value="Invia">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo $selectedValue = $comboBox->getSelectedValue('mycombo');
    echo "Hai selezionato il valore: " . $selectedValue;
}
?>