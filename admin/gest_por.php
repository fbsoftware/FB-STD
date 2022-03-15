<?php  session_start();
/*** -------------------------------------------------------------------------
   * Gestione della tabella 'por' portafoglio.
   15/03/2022	aggiunta copia, nuove include in "write"
=============================================================================  */

//   bottoni gestione
$param    = array('nuovo','modifica','copia','cancella','chiudi');
$btx      = new bottoni_str_par('Portfolio','por','upd_por.php',$param);
$btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];
$_SESSION['tab'] = "por";

// zona messaggi
$parm = $_SESSION['esito'];
$m = new msg($parm);
$m->msg();

// mostra la tabella filtrata --------------------------------------------------
echo "<div class='table fb-hv80'>";

echo "<div class='th'>";
echo "<div class='td'>Scelta</div>";
echo "<div class='td'>Stato</div>";
echo "<div class='td'>Progr.</div>";
echo "<div class='td'> Template</div>";
echo "<div class='td'>Codice</div>";
echo "<div class='td'>Descrizione</div>";
echo "</div>";

    $sql2 = "  SELECT *
               FROM `".DB::$pref."por`
               ORDER BY pprog";
// transazione
$con = "mysql:host=".DB::$host.";dbname=".DB::$db."";
$PDO = new PDO($con,DB::$user,DB::$pw);
$PDO->beginTransaction();

            foreach($PDO->query($sql2) as $row)
  {  require('fields_por.php');

     echo "<div class='tr'>";
  $f1 = new fieldi($pid,'pid',2,'');
  echo "<div class='td'>";
    $f1->field_ck(); echo "</div>";
  $st = new fieldi($pstat,'pstat',2,'');
  echo "<div class='td'>";
    $st->field_st(); echo "</div>";
  ?>
  <div class='td'><?php echo $pprog ?></div>
  <div class='td'><?php echo $ptmp ?></div>
  <div class='td'><?php echo $pcod ?></div>
  <div class='td'><?php echo $pdes ?></div>
  <?php
     echo "</div>";
     }

     echo "</form>";
     echo "</div>";
?>
