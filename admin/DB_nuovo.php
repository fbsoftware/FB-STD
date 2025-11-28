<?php
 /** 
 -------------------------------------------------------------- 
 Effettua la scrittura di un record in una tabella di database. 
 Il database è già connesso e la transazione pronta. 
 --------------------------------------------------------------*/ 
 echo "<br>// Inizio DB_nuovo.php con tabella=".$_SESSION['tab'];//debug
 if (!isset($_SESSION['tab'])) 
 { throw new Exception('Tabella non definita in sessione.'); } 
 // Assicuriamoci che esista una connessione PDO ($PDO). Se non esiste, 
 echo "<br>// la creiamo (con charset utf8mb4).";//debug 
 if (!isset($PDO) || !($PDO instanceof PDO)) 
 { $con = "mysql:host=" . DB::$host . ";dbname=" . DB::$db . ";"charset=utf8mb4"; 
   $options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
                PDO::ATTR_EMULATE_PREPARES => false, ]; 
                echo "prima di PD0";//debug
  $PDO = new PDO($con, DB::$user, DB::$pw, $options); 
  echo "<br>// NOTA: non facciamo beginTransaction qui perché il commento originale dice 'transazione pronta'";//debug
} 
   // Leggiamo la struttura della tabella 
   $sql = "SHOW FULL COLUMNS FROM `" . DB::$pref . $_SESSION['tab'] . "`"; 
          $columns = $PDO->query($sql)->fetchAll(PDO::FETCH_ASSOC); 
          $cols = []; 
          $placeholders = []; 
          $params = []; $i = 0; 
          
          foreach ($columns as $row) 
          { // il comportamento originale saltava il primo campo (chiave/autoincrement) inserendo NULL 
          if ($i === 0) { 
                // saltiamo l'inserimento esplicito della chiave (lasciamo che il DB gestisca autoincrement)
             $i++; 
             continue; 
             } 
             $field = $row['Field']; 
             $cols[] = "`$field`"; 
             $placeholders[] = "?"; // prendi il valore POST se presente, altrimenti NULL 
             $val = isset($_POST[$field]) ? $_POST[$field] : null; 
             $params[] = $val; 
             $i++; 
          } 
          if (count($cols) === 0) 
          { 
            throw new Exception('Nessun campo da inserire trovato per la tabella.'); 
          } 
          // Costruzione ed esecuzione prepared statement 
          $cols_str = implode(',', $cols); 
          $placeholders_str = implode(',', $placeholders); 
          $insert_sql = "INSERT INTO `" . DB::$pref . $_SESSION['tab'] . "` ($cols_str) 
          VALUES ($placeholders_str)";           
          try 
          { $stmt = $PDO->prepare($insert_sql); 
            $stmt->execute($params); 
            // Commit come nel comportamento originale 
            $PDO->commit(); 
            array_push($_SESSION['esito'], '54'); 
          } 
          catch (PDOException $e) 
          { 
            // In caso di errore, propaga o registra. 
            // Qui aggiungiamo un esito di errore e rilanciamo per debug. 
            array_push($_SESSION['esito'], 'ERR_INSERT'); 
            throw $e; 
          } 
?>