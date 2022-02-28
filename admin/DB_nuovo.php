<?php
/**
Effettua la scrittura di un record in una tabella di database.
Il database è già connesso e la transazione pronta.
--------------------------------------------------------------*/
// lettura campi della tabella
  if (isset($_POST['tab']))
       {
  $sql = "SHOW FULL COLUMNS FROM ".DB::$pref.$_POST['tab']." ";
  $campi = "(";
  $valori = "VALUES(";
  $i   = 0;
  			foreach($PDO->query($sql) as $row)
          {
  				$i++;
  				$campi .= "".$row[0].",";
  				if ($i == 1)
          {
  					$valori .= "NULL,";
  				}
  				else
          {

        $test1 = strpos($row[1],"text");
        $test2 = strpos($row[1],"varchar");
            if (($test1 >= 0) || ($test2 >= 0 ))
            {   $valori .="'".addslashes($_POST[$row[0]])."',";    }
            else {   $valori .="'".$_POST[$row[0]]."',"; }
  				}
        } // foreach

// nomi
$l = strlen($campi);
$campi = substr($campi,0,($l-1));
$campi .= ")";

// valori
$l = strlen($valori);
$valori = substr($valori,0,($l-1));
$valori .= ")";
}  // isset
        $sql = "INSERT INTO `".DB::$pref.$_POST['tab']."` $campi $valori ";
        $PDO->exec($sql);
        $PDO->commit();
        array_push($_SESSION['esito'],'54');
 ?>
