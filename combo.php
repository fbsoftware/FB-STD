<?php
class ComboBox {
    private $pdo;
    private $table;

    public function __construct(PDO $pdo, $table) {
        $this->pdo = $pdo;
        $this->table = $table;
    }

    public function getOptions() {
        // Query per ottenere i dati dalla tabella
        $stmt = $this->pdo->query("SELECT rcod, rdesc FROM {$this->table}");
        $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $options;
    }

    public function renderComboBox($name, $selectedValue = null) {
        $options = $this->getOptions();
        echo "<select rdesc=\"$name\">";
        foreach ($options as $option) {
            $selected = ($option['rdesc'] == $selectedValue) ? 'selected' : '';
            echo "<option value=\"{$option['rdesc']}\" $selected>{$option['rcod']}</option>";
        }
        echo "</select>";
    }
}

// Esempio di utilizzo
require_once('init_site.php');
try {
    // Connessione al database
    $pdo = new PDO("mysql:host=".DB::$host.";dbname=".DB::$db."",DB::$user,DB::$pw);
    $comboBox = new ComboBox($pdo, 'prefix_arg');

    // Visualizzazione della casella combo
    $comboBox->renderComboBox('rdesc','rcod');
echo "<br>Valore=".$selectedValue;
} catch (PDOException $e) {
    echo "Errore di connessione: " . $e->getMessage();
}

/*

 Spiegazione del Codice

1. **Costruttore della Classe (`__construct`):**
   - Accetta un oggetto `PDO` per la connessione al database e il nome della tabella.

2. **Metodo `getOptions`:**
   - Esegue una query per recuperare i dati dalla tabella e li restituisce come array associativo.

3. **Metodo `renderComboBox`:**
   - Accetta il nome del campo (`name`) e un valore selezionato opzionale (`selectedValue`).
   - Genera l'HTML per la casella combo, selezionando l'opzione corretta se `selectedValue` è fornito.

 Utilizzo

1. **Connessione al Database:**
   - Creiamo un oggetto `PDO` per connetterci al database.

2. **Creazione dell'Oggetto `ComboBox`:**
   - Inizializziamo la classe `ComboBox` con l'oggetto `PDO` e il nome della tabella.

3. **Rendering della Casella Combo:**
   - Utilizziamo il metodo `renderComboBox` per generare l'HTML della casella combo.

Puoi adattare questo esempio per soddisfare le tue esigenze specifiche, come la gestione di diverse tabelle o l'aggiunta di ulteriori funzionalità.
*/
?>