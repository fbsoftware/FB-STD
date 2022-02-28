<?php
/**
Effettua la modifica di un record in una tabella di database.
Il database è già connesso e la transazione pronta.
--------------------------------------------------------------*/
// lettura campi della tabella e composizione stringa SQL
  if (isset($_POST['tab']))
       {
  $sql = "SHOW FULL COLUMNS FROM ".DB::$pref.$_POST['tab']." ";

// compone stringhe per SQL
$valori = "";
  $i   = 0;
  			foreach($PDO->query($sql) as $row)
          {
// compone WHERE per ID record
if ($i == 0) {   $chiave = "".$row[0]." = ".$_POST[$row[0]]." ";
$i++;
}
// valorialtri campi
else {
    $test1 = strpos($row[1],"text");
    $test2 = strpos($row[1],"varchar");
        if (($test1 >= 0) || ($test2 >= 0 ))
        {    $valori .="".$row[0]."='".addslashes($_POST[$row[0]])."',";    }
        else {    $valori .="".$row[0]."='".$_POST[$row[0]]."',"; }
      }
        } // foreach

// valori
$l = strlen($valori);
$valori = substr($valori,0,($l-1));
}  // isset

// esecuzione SQL
        $sql = "UPDATE `".DB::$pref.$_POST['tab']."` SET ".$valori."    WHERE ".$chiave." ";
        $PDO->exec($sql);
        $PDO->commit();
        array_push($_SESSION['esito'],'55');
 ?>
