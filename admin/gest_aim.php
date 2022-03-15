<?php   session_start();
/*** -------------------------------------------------------------------------
   * Gestione della tabella 'aim' articolo con immagine
   15/03/2022	aggiunta copia, nuove include in "write"
=============================================================================  */

//   bottoni gestione
$param    = array('nuovo','modifica','copia','cancella','chiudi');
$btx      = new bottoni_str_par('Articoli con immagine','aim','upd_aim.php',$param);
          $btx->btn();

// memorizza location iniziale
$_SESSION['location'] = $_SERVER['QUERY_STRING'];
$_SESSION['tab'] = "aim";
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
echo "<div class='td'>Tmp.</div>";
echo "<div class='td'>Codice</div>";
echo "<div class='td'>Descrizione</div>";
echo "<div class='td'>Articolo</div>";
echo "</div>";

    $sql = "  SELECT *
               FROM `".DB::$pref."aim`
               ORDER BY iprog";

     foreach($PDO->query($sql) as $row)
  {  require('fields_aim.php');
     echo "<div class='tr'>";
     echo "<div class='td'>";
     $f1 = new fieldi($iid,'iid',5,'');
     $f1->field_ck(); echo "</div>";
     echo "<div class='td'>";
     $st = new fieldi($istat,'istat',2,'');
         $st->field_st(); echo "</div>";

  ?>
  <div class='td'><?php echo $iprog ?></div>
  <div class='td'><?php echo $itmp  ?></div>
  <div class='td'><?php echo $icod  ?></div>
  <div class='td'><?php echo $ides  ?></div>
  <div class='td'><?php echo $iart  ?></div>
  <?php
     echo "</div>";	// tr
     }
     echo "</form>";
     echo "</div>";
?>
