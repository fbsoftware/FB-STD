<?php
/**
Effettua la cancellazione di un record in una tabella di database.
Il database è già connesso e la transazione pronta.
--------------------------------------------------------------*/
// lettura campi della tabella e composizione stringa SQL
  if (isset($_SESSION['tab']))
      {
  $sql = "SHOW FULL COLUMNS FROM ".DB::$pref.$_SESSION['tab']." ";

// compone stringhe per SQL
$valori = "";
  $i   = 0;
  			foreach($PDO->query($sql) as $row)
        {
          // compone WHERE per ID record
          if ($i == 0) {   $chiave = "".$row[0]." = ".$_POST[$row[0]]." "; }
          $i++;
        }
      }  // isset

// esecuzione SQL
        $sql = "DELETE FROM `".DB::$pref.$_SESSION['tab']."` WHERE ".$chiave." ";
        $PDO->exec($sql);
        $PDO->commit();
        array_push($_SESSION['esito'],'53');
 ?>
